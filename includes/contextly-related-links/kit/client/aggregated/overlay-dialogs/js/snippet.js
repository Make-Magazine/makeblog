(function($) {

  /**
   * Snippet editor.
   *
   * @class
   * @extends Contextly.overlayDialog.BaseWidget
   */
  Contextly.overlayDialog.Snippet = Contextly.createClass(/** @lends Contextly.overlayDialog.Snippet.prototype */ {

    extend: Contextly.overlayDialog.BaseWidget,

    getTemplateHandlers: function() {
      var handlers = Contextly.overlayDialog.BaseWidget.prototype.getTemplateHandlers.apply(this, arguments);

      handlers.editor = handlers.editor || [];
      handlers.editor.push(
        this.refreshDialogActions
      );

      handlers.section = handlers.section || [];
      handlers.section.push(
        this.initSection
      );

      return handlers;
    },

    findEditorElements: function() {
      Contextly.overlayDialog.BaseWidget.prototype.findEditorElements.apply(this, arguments);

      // Snippet result wrapper and sections.
      this.e.sections = this.e.sidebar.find('.sections');
      this.e.snippetResult = this.e.sidebar.find('.snippet-result');
    },

    initState: function() {
      Contextly.overlayDialog.BaseWidget.prototype.initState.apply(this, arguments);

      // Server side must care to at least return empty snippet with its
      // settings, because we need them to render sections.
      this.snippet = this.settings.snippet;
    },

    getWidgetLinkContainer: function(linkData) {
      var sectionName = this.chooseUrlSection(linkData.native_url);
      return this.getSectionLinksContainer(sectionName);
    },

    getSectionLinksContainer: function(sectionName) {
      var selector = '.section[data-section-name="' + this.escapeSizzleAttrValue(sectionName) + '"]';
      var section = this.e.sections.find(selector);

      if (!section.size()) {
        // No such section yet, build a new one.
        section = this.renderTemplate('section', {
          name: sectionName,
          title: this.snippet.settings[sectionName + '_subhead']
        }, this.e.sections);
      }

      return section.find('.section-links');
    },

    initSection: function() {
      // Show the widget result on rendering the section.
      this.e.snippetResult.show();
    },

    renderEditor: function() {
      Contextly.overlayDialog.BaseWidget.prototype.renderEditor.apply(this, arguments);

      // Render snippet sections with their links.
      for (var sectionName in this.snippet.links) {
        // Skip "interesting" section, it shouldn't be editable.
        if (sectionName === 'interesting') {
          continue;
        }

        var linksContainer = this.getSectionLinksContainer(sectionName);
        this.renderSectionLinks(linksContainer, this.snippet.links[sectionName]);
      }
    },

    removeWidgetLink: function(sectionLink) {
      var sectionLinksList = sectionLink.closest('.section-links');

      Contextly.overlayDialog.BaseWidget.prototype.removeWidgetLink.apply(this, arguments);

      // Cleanup section or re-init the drag & drop component depending on the
      // number of the links left in section.
      if (sectionLinksList.find('.section-link').size()) {
        sectionLinksList.contextlySortable('refresh');
      }
      else {
        // No links left, remove the section.
        sectionLinksList
          .contextlySortable('destroy')
          .closest('.section')
          .remove();

        if (!this.e.sections.find('.section').size()) {
          // No more sections left, hide snippet result and refresh buttons.
          this.e.snippetResult.hide();
          this.refreshDialogActions();
        }
      }
    },

    onDialogSave: function() {
      var data = {
        remove_links: [],
        save_links: []
      };

      // Set widget ID if any.
      if (this.snippet.id) {
        data.snippet_id = this.snippet.id;
      }

      // Build the list of links to remove.
      for (var id in this.state.removeLinks) {
        data.remove_links.push({
          id: id
        });
      }

      // Build the list of links to insert/update.
      var self = this;
      this.e.sections
        .find('.section')
        .each(function() {
          var section = $(this);
          var sectionName = section.attr('data-section-name');
          var pos = 1;
          section
            .find('.section-link')
            .each(function() {
              var linkData = self.extractSectionLinkData({
                type: sectionName,
                pos: pos++
              }, $(this));
              data.save_links.push(linkData);
            });
        });

      // Perform the request.
      this.showProgressIndicator();
      this.performAjaxRequest('save-snippet', {
        data: data,
        success: this.onDialogSaveSuccess,
        error: this.onDialogSaveError
      });

      return false;
    },

    onDialogSaveSuccess: function(data) {
      this.api.setSnippet(data.snippet);
      this.api.closeOverlay();
    },

    onDialogSaveError: function() {
      this.displayAlert('Unable to save the widget. Something went wrong.');
      this.hideProgressIndicator();
    },

    onDialogRemove: function() {
      // Replace with Bootstrap dialog.
      if (window.confirm('The widget will be completely removed. Are you sure?')) {
        if (this.snippet.id) {
          this.showProgressIndicator();
          this.performAjaxRequest('remove-snippet', {
            data: {
              snippet_id: this.snippet.id
            },
            success: this.onDialogRemoveSuccess,
            error: this.onDialogRemoveError
          });
        }
        else {
          // The widget is not yet created. Just call success function directly.
          this.onDialogRemoveSuccess();
        }
      }

      return false;
    },

    onDialogRemoveSuccess: function() {
      if (this.snippet.id) {
        this.api.removeSnippet(this.snippet.id);
      }

      this.api.closeOverlay();
    },

    onDialogRemoveError: function() {
      this.displayAlert('Unable to remove the widget. Something went wrong.');
      this.hideProgressIndicator();
    },

    refreshDialogActions: function() {
      // Remove action is available only if the snippet actually available.
      if (this.snippet.id) {
        this.e.dialogRemove.show();
      }
      else {
        this.e.dialogRemove.hide();
      }

      // Save action is available when there is at least 1 link.
      if (this.e.sections.filter(':has(.section-link)').size()) {
        this.e.dialogSave.show();
      }
      else {
        this.e.dialogSave.hide();
      }
    }

  });

  $(function() {
    var editor = new Contextly.overlayDialog.Snippet();
  });

})(jQuery);