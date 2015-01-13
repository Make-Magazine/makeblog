(function($) {

  /**
   * Base widget editor.
   *
   * @class
   * @extends Contextly.overlayDialog.Base
   */
  Contextly.overlayDialog.BaseWidget = Contextly.createClass(/** @lends Contextly.overlayDialog.BaseWidget.prototype */ {

    extend: Contextly.overlayDialog.Base,

    initState: function() {
      Contextly.overlayDialog.Base.prototype.initState.apply(this, arguments);

      this.state.removeLinks = {};
      this.state.previewWidgetLink = null;
      this.state.actionsLocked = 0;
      this.state.pendingWidgetLinks = {};
    },

    getTemplateHandlers: function() {
      var handlers = Contextly.overlayDialog.Base.prototype.getTemplateHandlers.apply(this, arguments);

      handlers.sectionLinks = handlers.sectionLinks || [];
      handlers.sectionLinks.push(
        this.initHidden,
        this.bindSectionLinksEvents,
        this.initSectionLinks,
        this.refreshDialogActions
      );

      return handlers;
    },

    findEditorElements: function() {
      Contextly.overlayDialog.Base.prototype.findEditorElements.apply(this, arguments);

      // Sidebar and dialog actions wrapper.
      this.e.sidebar = this.e.editor.find('.sidebar-right');
      this.e.dialogActions = this.e.sidebar.find('.dialog-action');

      // All widgets have the save dialog actions.
      this.e.dialogRemove = this.e.dialogActions.filter('.action-remove');
      this.e.dialogCancel = this.e.dialogActions.filter('.action-cancel');
      this.e.dialogSave = this.e.dialogActions.filter('.action-save');
    },

    bindEditorEvents: function() {
      Contextly.overlayDialog.Base.prototype.bindEditorEvents.apply(this, arguments);

      // Dialog actions.
      this.onDialogAction(this.e.dialogSave, this.onDialogSave);
      this.onDialogAction(this.e.dialogCancel, this.onDialogCancel);
      this.onDialogAction(this.e.dialogRemove, this.onDialogRemove);
    },

    bindSectionLinksEvents: function(container, elements) {
      // Links of the widget.
      this.onEnter(elements.find('.link-title-editor'), this.onTextareaEnter, true);
      this.onClick(elements.find('.remove-link'), this.onLinkRemove, true);
      this.onClick(elements.find('.test-link'), this.onWidgetLinkPreview, true);
    },

    initSectionLinks: function(container) {
      // Can't use the "refresh" method here, because the sortable component
      // can be not yet initialized. But it's safe to call "destroy" and then
      // init the component.
      container
        .contextlySortable('destroy')
        .contextlySortable(this.getSortableOptions());
    },

    /**
     * Binds click on dialog action to the specified callback.
     *
     * One more proxy layer to lock all dialog actions without taking care about
     * it on each callback.
     */
    onDialogAction: function(element, callback, passArguments) {
      this.onClick(element, function() {
        if (!this.state.actionsLocked) {
          return callback.apply(this, arguments);
        }
        else {
          return false;
        }
      }, passArguments);
    },

    lockDialogActions: function() {
      this.state.actionsLocked++;
      this.lockControls(this.e.dialogActions, 'dialog-actions');
    },

    unlockDialogActions: function() {
      this.state.actionsLocked--;
      if (this.state.actionsLocked < 0) {
        this.state.actionsLocked = 0;
      }

      if (this.state.actionsLocked == 0) {
        this.unlockControls(this.e.dialogActions, 'dialog-actions');
      }
    },

    performUrlInfoRequest: function(url) {
      // Make sure that the same URL can't be added once again, while previous
      // instance is still pending its title.
      if (this.state.pendingWidgetLinks[url]) {
        return false;
      }

      // Perform the request.
      var started = Contextly.overlayDialog.Base.prototype.performUrlInfoRequest.call(this, url);
      if (!started) {
        return false;
      }

      this.state.pendingWidgetLinks[url] = this.renderSectionLink({
        native_url: url,
        pending: true
      });
      this.lockDialogActions();

      return true;
    },

    onUrlInfoRequestSuccess: function(urlInfo) {
      if (!this.state.pendingWidgetLinks[urlInfo.url]) {
        // Maybe the link has been removed while we were trying to get its info.
        return;
      }

      var sectionLink = this.state.pendingWidgetLinks[urlInfo.url];
      this.updateSectionLink(sectionLink, {
        native_url: urlInfo.url,
        title: urlInfo.title
      });

      this.refreshDialogActions();
    },

    onUrlInfoRequestError: function(jqXHR) {
      this.displayAlert('Unable to get information about the URL. Something went wrong.');

      // Remove the widget link with failed request.
      var url = jqXHR.contextlyData.url;
      if (this.state.pendingWidgetLinks[url]) {
        var sectionLink = this.state.pendingWidgetLinks[url];
        this.removeWidgetLink(sectionLink);
      }
    },

    onUrlInfoRequestComplete: function(jqXHR) {
      // Remove URL from the list of pending.
      var url = jqXHR.contextlyData.url;
      if (this.state.pendingWidgetLinks[url]) {
        delete this.state.pendingWidgetLinks[url];
      }

      this.unlockDialogActions();
    },

    refreshDialogActions: Contextly.abstractMethod(),

    onDialogCancel: function() {
      this.api.closeOverlay();
    },

    onDialogSave: Contextly.abstractMethod(),

    onDialogRemove: Contextly.abstractMethod(),

    getSortableOptions: function() {
      return {
        handle: '.handle',
        placeholder: '<li class="sortable-placeholder" />'
      };
    },

    getWidgetLinkContainer: Contextly.abstractMethod(),

    renderSectionLinks: function(container, links) {
      return this.renderTemplate('sectionLinks', {
        links: links
      }, container);
    },

    renderSectionLink: function(linkData) {
      var container = this.getWidgetLinkContainer(linkData);
      return this.renderSectionLinks(container, [linkData]);
    },

    updateSectionLink: function(sectionLink, linkData) {
      var titleEditor = sectionLink.find('.link-title-editor');
      var progressIndicator = sectionLink.find('.link-progress-indicator');
      if (linkData.pending) {
        titleEditor.hide();
        progressIndicator.show();
      }
      else {
        progressIndicator.hide();
        titleEditor
          .show()
          .text(linkData.title);
        if (linkData.id) {
          sectionLink.attr('data-id', linkData.id);
        }
      }

      return sectionLink;
    },

    extractSectionLinkData: function(linkData, sectionLink) {
      var id = sectionLink.attr('data-id');
      if (id) {
        linkData.id = id;
      }

      linkData.url = sectionLink.attr('data-url');
      linkData.title = this.normalizeSpace(sectionLink.find('.link-title-editor').val());

      return linkData;
    },

    onLinkRemove: function(target) {
      var widgetLink = $(target).closest('.section-link');
      this.removeWidgetLink(widgetLink);
    },

    removeWidgetLink: function(sectionLink) {
      // If the link has ID it needs to be removed on the server side too.
      var id = sectionLink.attr('data-id');
      if (id) {
        this.state.removeLinks[id] = true;
      }

      // TODO Check if the section link is pending before removing it from there.
      var url = sectionLink.attr('data-url');
      if (this.state.pendingWidgetLinks[url]) {
        delete this.state.pendingWidgetLinks[url];
      }

      // Remove it from the DOM.
      sectionLink.remove();
    },

    onWidgetLinkPreview: function(target, e) {
      e.preventDefault();

      // Save reference to the widget link for future use.
      this.state.previewWidgetLink = $(target).closest('.section-link')

      // Show the preview.
      this.showUrlPreview($(target).attr('href'), {
        remove: this.onWidgetLinkPreviewRemove
      });
    },

    onWidgetLinkPreviewRemove: function() {
      // Get widget link now, because it will be removed by closeUrlPreview().
      var widgetLink = this.state.previewWidgetLink;

      this.closeUrlPreview();
      this.removeWidgetLink(widgetLink);
    },

    closeUrlPreview: function() {
      Contextly.overlayDialog.Base.prototype.closeUrlPreview.call(this);

      // Additionally cleanup reference to the widget link.
      this.state.previewWidgetLink = null;
    }

  });

})(jQuery);
