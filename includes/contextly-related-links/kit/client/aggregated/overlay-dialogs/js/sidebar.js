(function($) {

  /**
   * Sidebar editor.
   *
   * @class
   * @extends Contextly.overlayDialog.BaseWidget
   */
  Contextly.overlayDialog.Sidebar = Contextly.createClass(/** @lends Contextly.overlayDialog.Sidebar.prototype */ {

    extend: Contextly.overlayDialog.BaseWidget,

    initState: function() {
      Contextly.overlayDialog.BaseWidget.prototype.initState.call(this);

      var id = this.api.getSidebarId();
      if (id && this.settings.sidebars[id]) {
        this.state.id = id;
        this.state.sidebar = this.settings.sidebars[id];
        this.state.layout = this.state.sidebar.layout;
      }
      else {
        this.state.id = null;
        this.state.sidebar = {};
        this.state.layout = 'left';
      }

      this.state.previewTitle = null;

      // Register sidebars search type.
      this.searchTypes['sidebars'] = {
        template: 'searchResultsSidebars',
        search: this.proxy(this.performSidebarsSearchQuery, false, true),
        render: this.proxy(this.renderSidebarsSearchResults, false, true)
      };
    },

    getTemplateHandlers: function() {
      var handlers = Contextly.overlayDialog.BaseWidget.prototype.getTemplateHandlers.apply(this, arguments);

      handlers.editor = handlers.editor || [];
      handlers.editor.push(
        this.refreshLayoutSwitches
      );

      handlers.searchResultsSidebars = handlers.searchResultsSidebars || [];
      handlers.searchResultsSidebars.push(
        this.initHidden,
        this.bindSearchResultsSidebarsEvents,
        this.initSearchSidebarsResults
      );

      return handlers;
    },

    alterTemplateVariables: function(name, vars) {
      Contextly.overlayDialog.BaseWidget.prototype.alterTemplateVariables.apply(this, arguments);

      vars.editor.isSidebar = true;
    },

    getEditorVariables: function() {
      var vars = Contextly.overlayDialog.BaseWidget.prototype.getEditorVariables.apply(this, arguments);

      vars.sidebar = this.state.sidebar;

      return vars;
    },

    renderEditor: function() {
      Contextly.overlayDialog.BaseWidget.prototype.renderEditor.apply(this, arguments);

      // Render section links.
      if (this.state.sidebar.links && this.state.sidebar.links.previous) {
        var vars = {
          links: this.state.sidebar.links.previous
        };
        this.renderTemplate('sectionLinks', vars, this.e.sectionLinks);
      }
    },

    findEditorElements: function() {
      Contextly.overlayDialog.BaseWidget.prototype.findEditorElements.apply(this, arguments);

      // Sidebar settings.
      var sidebarSettings = this.e.sidebar.find('.sidebar-settings');
      this.e.sidebarTitle = sidebarSettings.find('.sidebar-title');
      this.e.sidebarDescription = sidebarSettings.find('.sidebar-description');
      this.e.sidebarLayoutSwitches = sidebarSettings.find('.sidebar-layout-switch');

      // Modal dialog and its confirmation button.
      this.e.sidebarModal = sidebarSettings.find('.sidebar-modal');
      this.e.sidebarModalConfirm = this.e.sidebarModal.find('.sidebar-modal-confirm');

      // Results wrapper.
      this.e.sidebarResult = this.e.sidebar.find('.sidebar-result');
      this.e.sectionLinks = this.e.sidebarResult.find('.section-links');
      this.e.sidebarAddToRelated = this.e.sidebarResult.find('.sidebar-add-to-related');
    },

    bindEditorEvents: function() {
      Contextly.overlayDialog.BaseWidget.prototype.bindEditorEvents.apply(this, arguments);

      // Layout switch buttons.
      this.onClick(this.e.sidebarLayoutSwitches, this.onLayoutChange, true);

      // Prevent enter on sidebar description.
      this.onEnter(this.e.sidebarDescription, this.onTextareaEnter, true);

      // Confirmation button on the modal.
      this.onClick(this.e.sidebarModalConfirm, this.onSidebarModalConfirm);
    },

    bindSearchResultsSidebarsEvents: function(container) {
      // Search sidebars result buttons, dropdown menu & links toggles.
      var addButtons = container.find('.search-sidebar-add-all');
      var overwriteButtons = container.find('.search-sidebar-overwrite');
      var collapseButtons = container.find('.search-sidebar-links-collapse');
      var expandButtons = container.find('.search-sidebar-links-expand');
      this.onClick(addButtons, this.onSearchSidebarAddAll, true);
      this.onClick(overwriteButtons, this.onSearchSidebarOverwrite, true);
      this.onClick(collapseButtons, this.onSearchSidebarLinksCollapse, true);
      this.onClick(expandButtons, this.onSearchSidebarLinksExpand, true);

      // Links inside found sidebars.
      var contentItems = container.find('.search-sidebar-content-item');
      var linkPreview = contentItems.find('.search-sidebar-link');
      var linkAdd = contentItems.find('.search-sidebar-add-single');
      this.onClick(linkPreview, this.onSearchSidebarLinkPreview, true);
      this.onClick(linkAdd, this.onSearchSidebarLinkAdd, true);
    },

    onLayoutChange: function(target) {
      this.state.layout = $(target).attr('data-layout');
      this.refreshLayoutSwitches();
    },

    refreshLayoutSwitches: function() {
      this.e.sidebarLayoutSwitches
        .filter('.active')
        .removeClass('active')
        .end()
        .filter('[data-layout="' + this.escapeSizzleAttrValue(this.state.layout) + '"]')
        .addClass('active');
    },

    initSectionLinks: function() {
      this.e.sidebarResult.show();

      Contextly.overlayDialog.BaseWidget.prototype.initSectionLinks.apply(this, arguments);
    },

    isAutoSidebar: function() {
      return this.state.sidebar.type && this.state.sidebar.type === 'auto-sidebar';
    },

    refreshDialogActions: function() {
      // Remove action is available only if the sidebar has been saved.
      if (this.state.id) {
        this.e.dialogRemove.show();
      }
      else {
        this.e.dialogRemove.hide();
      }

      // Save action is available for auto-sidebars or if there is at least 1 link.
      if (this.isAutoSidebar() || this.e.sectionLinks.filter(':has(.section-link)').size()) {
        this.e.dialogSave.show();
      }
      else {
        this.e.dialogSave.hide();
      }
    },

    removeWidgetLink: function(sectionLink) {
      Contextly.overlayDialog.BaseWidget.prototype.removeWidgetLink.call(this, sectionLink);

      // Cleanup results or re-init the drag & drop component depending on the
      // number of the links left.
      var sectionLinks = this.e.sectionLinks;
      if (sectionLinks.find('.section-link').size()) {
        sectionLinks.contextlySortable('refresh');
      }
      else {
        // No links left, hide the results.
        sectionLinks.contextlySortable('destroy');
        this.e.sidebarResult.hide();
        this.refreshDialogActions();
      }
    },

    removeAllWidgetLinks: function() {
      this.e.sectionLinks
        .contextlySortable('destroy');

      var sectionLinks = this.e.sectionLinks
        .find('.section-link');
      for (var i = 0; i < sectionLinks.length; i++) {
        var sectionLink = sectionLinks.eq(i);
        Contextly.overlayDialog.BaseWidget.prototype.removeWidgetLink.call(this, sectionLink);
      }
    },

    buildSidebarData: function() {
      return {
        name: this.normalizeSpace(this.e.sidebarTitle.val()),
        description: this.normalizeSpace(this.e.sidebarDescription.val())
      };
    },

    onSearchSidebarLinkPreview: function(target, e) {
      e.preventDefault();
      var $target = $(target);

      // Save link title.
      this.state.previewTitle = $target
        .find('.search-sidebar-link-title')
        .text();

      // Set up buttons state and attach event handlers.
      this.e.urlPreviewRemove.hide();
      this.e.urlPreviewConfirm
        .unbind('click')
        .show();
      this.onClick(this.e.urlPreviewConfirm, this.onSearchSidebarLinkPreviewConfirm);

      // Show the preview.
      this.previewUrl($(target).attr('href'));
    },

    onSearchSidebarLinkPreviewConfirm: function() {
      // Get URL and title now, because it will be reset by closeUrlPreview().
      var url = this.state.previewUrl;
      var title = this.state.previewTitle;

      this.closeUrlPreview();
      this.addSearchSidebarLink(title, url);
    },

    closeUrlPreview: function() {
      Contextly.overlayDialog.BaseWidget.prototype.closeUrlPreview.call(this);

      // Additionally cleanup search sidebar link title.
      this.state.previewTitle = null;
    },

    onSearchSidebarLinkAdd: function(target) {
      var link = $(target)
        .closest('.search-sidebar-content-item')
        .data('contextlyLink');
      this.addSearchSidebarLink(link.title, link.native_url);

      return false;
    },

    addSearchSidebarLink: function(title, url) {
      this.e.sidebarResult.show();

      this.renderSectionLink({
        title: title,
        native_url: url
      });
    },

    getWidgetLinkContainer: function(linkData) {
      // All links are in a single pre-rendered section.
      return this.e.sectionLinks;
    },

    addSearchSidebarLinks: function(sidebar) {
      this.e.sidebarResult.show();

      // Re-build the list of links to avoid "stealing" links from other
      // sidebars.
      var links = [];
      this.each(sidebar.links.previous, function(link) {
        links.push({
          native_url: link.native_url,
          title: link.title
        })
      });

      this.renderSectionLinks(this.e.sectionLinks, links);
    },

    onSearchSidebarAddAll: function(target) {
      var $target = $(target);

      var sidebar = $target
        .closest('.search-sidebars-result')
        .data('contextlySidebar');

      this.addSearchSidebarLinks(sidebar);
      this.refreshDialogActions();

      this.closeSearchSidebarDropdown($target);

      return false;
    },

    onSearchSidebarOverwrite: function(target) {
      var $target = $(target);

      // Fix links list height before making any changes to avoid scroll
      // position changes.
      this.e.sectionLinks.css('height', this.e.sectionLinks.height());

      var sidebar = $target
        .closest('.search-sidebars-result')
        .data('contextlySidebar');

      // Cleanup all links and add all links from the search result.
      this.removeAllWidgetLinks();
      this.addSearchSidebarLinks(sidebar);

      // Copy name, description and alignment.
      this.e.sidebarTitle.val(sidebar.name);
      this.e.sidebarDescription.val(sidebar.description);
      this.state.layout = sidebar.layout;

      this.refreshLayoutSwitches();
      this.refreshDialogActions();

      // Cleanup the height fix.
      this.e.sectionLinks.css('height', '');

      this.closeSearchSidebarDropdown($target);

      return false;
    },

    closeSearchSidebarDropdown: function($target) {
      var dropdown = $target.closest('.dropdown-menu');
      if (dropdown.size()) {
        dropdown
          .parent()
          .removeClass('open');
      }
    },

    onDialogSave: function() {
      var sidebarData = this.buildSidebarData();

      /**
       Do not display confirmation for sidebars with empty title

      if (!sidebarData.name && !sidebarData.description) {
        this.e.sidebarModal.modal();
      }
      else {
        this.saveSidebar(sidebarData);
      }
      */

      this.saveSidebar(sidebarData);

      return false;
    },

    onSidebarModalConfirm: function() {
      this.e.sidebarModal.modal('hide');
      var sidebar = this.buildSidebarData();
      this.saveSidebar(sidebar);
    },

    saveSidebar: function(data) {
      data = $.extend({
        remove_links: [],
        save_links: [],
        related_links: []
      }, data);

      // Set the rest sidebar data.
      if (this.state.id) {
        data.sidebar_id = this.state.id;
      }
      if (this.state.sidebar.type) {
        data.type = this.state.sidebar.type;
      }
      data.layout = this.state.layout;

      // Build the list of links to remove.
      for (var id in this.state.removeLinks) {
        data.remove_links.push({
          id: id
        });
      }

      var addToRelated = this.e.sidebarAddToRelated.is(':checked');
      if (addToRelated && this.settings.snippet.id) {
        data.snippet_id = this.settings.snippet.id;
      }

      // Build the list of links to insert/update/add to snippet.
      var sidebarPos = 1;
      var snippetPos = {};
      this.eachElement(this.e.sectionLinks.find('.section-link'), function (link) {
        var linkData = this.extractSectionLinkData({
          type: 'previous',
          pos: sidebarPos++
        }, link);

        // Save it to sidebar.
        data.save_links.push(linkData);

        // Save copy to the snippet if asked.
        if (addToRelated) {
          var sectionName = this.chooseUrlSection(linkData.url);
          if (!this.snippetLinkExists(sectionName, linkData.url)) {
            if (!snippetPos[sectionName]) {
              snippetPos[sectionName] = this.getSnippetLinkNextPos(sectionName);
            }

            var snippetLinkData = $.extend(true, {}, linkData, {
              type: sectionName,
              pos: snippetPos[sectionName]++
            });
            delete snippetLinkData.id;
            data.related_links.push(snippetLinkData);
          }
        }
      });

      // Perform the request.
      this.showProgressIndicator();
      this.performAjaxRequest('save-sidebar', {
        data: data,
        success: this.onDialogSaveSuccess,
        error: this.onDialogSaveError
      });
    },

    onDialogSaveSuccess: function(data) {
      // Call the callback first, then update sidebar and the snippet.
      this.api.callback(data.sidebar);
      this.api.setSidebar(data.sidebar);
      if (data.snippet) {
        this.api.setSnippet(data.snippet);
      }

      this.api.closeOverlay();
    },

    onDialogSaveError: function() {
      this.displayAlert('Unable to save the sidebar. Something went wrong.');
      this.hideProgressIndicator();
    },

    onDialogRemove: function() {
      if (window.confirm('The sidebar will be completely removed. Are you sure?')) {
        if (this.state.id) {
          this.showProgressIndicator();
          this.performAjaxRequest('remove-sidebar', {
            data: {
              sidebar_id: this.state.id,
              type: this.state.sidebar.type
            },
            success: this.onDialogRemoveSuccess,
            error: this.onDialogRemoveError
          });
        }
        else {
          // The sidebar is not yet created. Just call success function directly.
          this.onDialogRemoveSuccess();
        }
      }

      return false;
    },

    onDialogRemoveSuccess: function() {
      if (this.state.id) {
        this.api.removeSidebar(this.state.id);
      }

      this.api.closeOverlay();
    },

    onDialogRemoveError: function() {
      this.displayAlert('Unable to remove the sidebar. Something went wrong.');
      this.hideProgressIndicator();
    },

    performSidebarsSearchQuery: function(searchInfo, query, page) {
      var data = {
        type: searchInfo.type,
        query: query,
        page: page
      };

      if (this.state.id) {
        data.sidebar_id = this.state.id;
      }

      this.performAjaxRequest('search', {
        data: data,
        success: this.onSearchRequestSuccess,
        error: this.onSearchRequestError,
        complete: this.hideProgressIndicator
      });
    },

    onSearchSidebarLinksCollapse: function(target) {
      var collapse = $(target);
      var toggles = collapse.closest('.search-sidebar-links-toggles');
      var expand = toggles.find('.search-sidebar-links-expand');

      collapse.hide();
      expand.show();

      var links = toggles
        .closest('.search-result-info')
        .find('.search-sidebar-content-item');

      links
        .slice(this.settings.sidebarsSearchLinksLimit)
        .hide();

      return false;
    },

    onSearchSidebarLinksExpand: function(target) {
      var expand = $(target);
      var toggles = expand.closest('.search-sidebar-links-toggles');
      var collapse = toggles.find('.search-sidebar-links-collapse');

      expand.hide();
      collapse.show();

      var links = toggles
        .closest('.search-result-info')
        .find('.search-sidebar-content-item');

      links
        .slice(this.settings.sidebarsSearchLinksLimit)
        .show();

      return false;
    },

    initSearchSidebarsResults: function(container) {
      // Bootstrap dropdown.
      container
        .find('.search-sidebar-actions-toggle')
        .dropdown();

      // Collapse links by default if there are more than limit + 1 links.
      this.eachElement(container.find('li.search-sidebars-result'), function(element) {
        var items = element.find('.search-sidebar-content-item');
        if (items.size() > this.settings.sidebarsSearchLinksLimit + 1) {
          var toggles = element.find('.search-sidebar-links-toggles');
          toggles.show();

          // Progress indicator may still be active and all event handlers are
          // locked because of it. Just make a direct call instead of triggering
          // handler through jQuery.
          var collapseLink = toggles.find('.search-sidebar-links-collapse');
          this.onSearchSidebarLinksCollapse.call(this, collapseLink[0]);
        }
      });
    },

    renderSidebarsSearchResults: function(sidebars) {
      var elements = this.renderTemplate('searchResultsSidebars', {
        sidebars: sidebars
      });

      this.eachElement(elements.filter('li.search-sidebars-result'), function(element, index) {
        var sidebar = sidebars[index];
        element.data('contextlySidebar', sidebar);

        this.eachElement(element.find('.search-sidebar-content-item'), function(link, linkIndex) {
          link.data('contextlyLink', sidebar.links.previous[linkIndex]);
        });
      });

      return elements;
    }

  });

  $(function() {
    var editor = new Contextly.overlayDialog.Sidebar();
  });

})(jQuery);
