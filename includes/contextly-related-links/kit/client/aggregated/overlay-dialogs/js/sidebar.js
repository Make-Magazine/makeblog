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
      this.initSidebarContentState(id);

      this.state.previewTitle = null;

      // Register sidebars search type.
      this.searchTypes['sidebars'] = {
        template: 'searchResultsSidebars',
        emptyQuery: true,
        search: this.proxy(this.performSidebarsSearchQuery, false, true),
        render: this.proxy(this.renderSidebarsSearchResults, false, true)
      };
    },

    initSidebarContentState: function(id) {
      if (id && this.settings.sidebars[id]) {
        this.state.id = id;
        this.state.sidebar = this.settings.sidebars[id];
        this.state.layout = this.state.sidebar.layout;
        this.state.pane = 'edit';
      }
      else {
        this.state.id = null;
        this.state.sidebar = {};
        this.state.layout = 'left';
        this.state.pane = 'create';
      }

      this.state.changed = false;
    },

    getTemplateHandlers: function() {
      var handlers = Contextly.overlayDialog.BaseWidget.prototype.getTemplateHandlers.apply(this, arguments);

      handlers.editor = handlers.editor || [];
      handlers.editor.push(
        this.renderSidebarPaneTypes,
        this.renderSidebarPane
      );

      handlers.sidebarPaneTypes = handlers.sidebarPaneTypes || [];
      handlers.sidebarPaneTypes.push(
        this.bindSidebarPaneTypesEvents
      );

      handlers.sidebarChooser = handlers.sidebarChooser || [];
      handlers.sidebarChooser.push(
        this.initHidden,
        this.findSidebarChooserElements,
        this.bindSidebarChooserEvents,
        this.bindSidebarsCollapsibleLinksEvents,
        this.initSidebarsCollapsibleLinks
      );

      handlers.sidebarContentEditor = handlers.sidebarContentEditor || [];
      handlers.sidebarContentEditor.push(
        this.initHidden,
        this.findContentEditorElements,
        this.bindContentEditorEvents,
        this.refreshLayoutSwitches,
        this.refreshDialogActions,
        this.refreshSearchTabs
      );

      handlers.searchResultsSidebars = handlers.searchResultsSidebars || [];
      handlers.searchResultsSidebars.push(
        this.initHidden,
        this.bindSearchResultsSidebarsEvents,
        this.bindSidebarsCollapsibleLinksEvents,
        this.initSearchSidebarsResults,
        this.initSidebarsCollapsibleLinks
      );

      handlers.modalDialog = handlers.modalDialog || [];
      handlers.modalDialog.push(
        this.findModalDialogElements,
        this.bindModalDialogEvents
      );

      return handlers;
    },

    alterTemplateVariables: function(name, vars) {
      Contextly.overlayDialog.BaseWidget.prototype.alterTemplateVariables.apply(this, arguments);

      vars.editor.isSidebar = true;
    },

    getEditorVariables: function() {
      return {};
    },

    getSidebarPaneTypes: function() {
      var paneTypes = {};

      if (this.state.id === null) {
        paneTypes['create'] = {
          type: 'create',
          icon: 'file-alt',
          title: this.t('New sidebar'),
          changed: this.state.changed,
          render: this.renderSidebarContentEditor
        };
      }
      else {
        paneTypes['edit'] = {
          type: 'edit',
          icon: 'pencil',
          title: this.t('Edit selected sidebar'),
          changed: this.state.changed,
          render: this.renderSidebarContentEditor
        };
      }

      if (!$.isEmptyObject(this.settings.sidebars)) {
        paneTypes['choose'] = {
          type: 'choose',
          icon: 'th-list',
          title: this.t('Select sidebar to edit'),
          changed: false,
          render: this.renderSidebarChooser
        };
      }

      return paneTypes;
    },

    findEditorElements: function() {
      this.e.sidebarPaneTypes = this.e.editor.find('ul.sidebar-pane-types');
      this.e.sidebarPaneContainer = this.e.editor.find('div.sidebar-pane-container');
    },

    bindEditorEvents: function() {
      // Do nothing.
    },

    initEditor: function() {
      // Do nothing.
    },

    renderSidebarPaneTypes: function() {
      this.e.sidebarPaneTypes.empty();

      this.renderTemplate('sidebarPaneTypes', {
        paneTypes: this.getSidebarPaneTypes()
      }, this.e.sidebarPaneTypes);

      this.e.sidebarPaneTypes
        .children('li')
        .filter('[data-pane-type="' + this.escapeSizzleAttrValue(this.state.pane) + '"]')
        .addClass('active');
    },

    bindSidebarPaneTypesEvents: function() {
      this.onClick(this.e.sidebarPaneTypes.children('li'), this.onSidebarPaneTypeSelect, true);
    },

    onSidebarPaneTypeSelect: function(target, e) {
      e.preventDefault();

      var $target = $(target);

      var item = $target.closest('.sidebar-pane-type');
      if (item.hasClass('active') || item.hasClass('disabled')) {
        return;
      }

      var type = $target.attr('data-pane-type');
      if (!type) {
        return;
      }

      this.state.pane = type;
      this.renderSidebarPaneTypes();
      this.renderSidebarPane();
    },

    renderSidebarPane: function() {
      var map = this.getSidebarPaneTypes();
      if (!map[this.state.pane]) {
        $.error('Unknown sidebar pane type: ' + this.state.pane);
      }

      // Hide all panes, renderer is responsible for showing its pane.
      this.e.sidebarPaneContainer
        .children('.sidebar-pane')
        .hide();
      map[this.state.pane].render.call(this);
    },

    renderSidebarChooser: function() {
      if (this.e.sidebarChooser) {
        this.e.sidebarChooser.show();
        return;
      }

      var vars = {
        sidebars: this.settings.sidebars
      };
      this.renderTemplate('sidebarChooser', vars, this.e.sidebarPaneContainer);
    },

    findSidebarChooserElements: function() {
      this.e.sidebarChooser = this.e.sidebarPaneContainer
        .children('.sidebar-chooser');
    },

    bindSidebarChooserEvents: function(container) {
      var linkPreview = container.find('.search-sidebar-link');
      var sidebarEdit = container.find('.sidebar-edit');
      this.onClick(linkPreview, this.onSidebarChooserLinkPreview, true);
      this.onClick(sidebarEdit, this.onSidebarChooserEdit, true);
    },

    renderSidebarContentEditor: function() {
      if (this.e.sidebarContentEditor) {
        // Sidebar chooser is responsible for removing content editor on
        // switching sidebar, so we only show our pane.
        this.e.sidebarContentEditor.show();
        return;
      }

      var vars = Contextly.overlayDialog.BaseWidget.prototype.getEditorVariables.apply(this, arguments);
      vars.sidebar = this.state.sidebar;
      this.renderTemplate('sidebarContentEditor', vars, this.e.sidebarPaneContainer);

      // Render section links.
      if (this.state.sidebar.links && this.state.sidebar.links.previous) {
        vars = {
          links: this.state.sidebar.links.previous
        };
        this.renderTemplate('sectionLinks', vars, this.e.sectionLinks);
      }
    },

    findContentEditorElements: function(container) {
      // Call parent function suitable for the whole editor, since all of the
      // expected elements are inside the content editor.
      Contextly.overlayDialog.BaseWidget.prototype.findEditorElements.apply(this, arguments);

      // Find the content editor root.
      this.e.sidebarContentEditor = this.e.sidebarPaneContainer
        .children('.sidebar-content-editor');

      // Sidebar settings.
      var sidebarSettings = this.e.sidebar.find('.sidebar-settings');
      this.e.sidebarTitle = sidebarSettings.find('.sidebar-title');
      this.e.sidebarDescription = sidebarSettings.find('.sidebar-description');
      this.e.sidebarLayoutSwitches = sidebarSettings.find('.sidebar-layout-switch');

      // Results wrapper.
      this.e.sidebarResult = this.e.sidebar.find('.sidebar-result');
      this.e.sectionLinks = this.e.sidebarResult.find('.section-links');
      this.e.sidebarAddToRelated = this.e.sidebarResult.find('.sidebar-add-to-related');
    },

    bindContentEditorEvents: function() {
      // Call parent function suitable for the whole editor, since all of the
      // expected elements are inside the content editor.
      Contextly.overlayDialog.BaseWidget.prototype.bindEditorEvents.apply(this, arguments);

      // Layout switch buttons.
      this.onClick(this.e.sidebarLayoutSwitches, this.onLayoutChange, true);

      // Prevent enter on sidebar description.
      this.onEnter(this.e.sidebarDescription, this.onTextareaEnter, true);

      // Mark sidebar as changed on title or description changes.
      this.on('change', this.e.sidebarTitle, this.markSidebarChanged);
      this.on('change', this.e.sidebarDescription, this.markSidebarChanged);
    },

    /**
     * Displays modal dialog.
     *
     * @param params
     *   Supported parameters:
     *   - title
     *   - body
     *   - dismiss
     *   - confirm
     *   - onConfirm
     *
     * @returns {boolean}
     */
    showModal: function(params) {
      if (this.e.modalDialog) {
        // Modal dialog is already displayed.
        return false;
      }

      params = $.extend({
        title: '',
        body: '',
        dismiss: '',
        confirm: '',
        onConfirm: null
      }, params);

      this.renderTemplate('modalDialog', params, $('body'));
      if ($.isFunction(params.onConfirm)) {
        this.onClick(this.e.modalDialogConfirm, params.onConfirm);
      }
      this.e.modalDialog.modal();

      return true;
    },

    findModalDialogElements: function(container) {
      // Modal dialog and its confirmation button.
      this.e.modalDialog = container.find('.modal');
      this.e.modalDialogConfirm = this.e.modalDialog.find('.sidebar-modal-confirm');
    },

    bindModalDialogEvents: function() {
      // Destroy the modal when it was dismissed.
      this.on('hidden', this.e.modalDialog, this.onModalClosed);
    },

    onModalClosed: function() {
      this.e.modalDialog.remove();
      delete this.e.modalDialog;
      delete this.e.modalDialogConfirm;
    },

    bindSearchResultsSidebarsEvents: function(container) {
      // Search sidebars result buttons, dropdown menu & links toggles.
      var addButtons = container.find('.search-sidebar-add-all');
      var overwriteButtons = container.find('.search-sidebar-overwrite');
      this.onClick(addButtons, this.onSearchSidebarAddAll, true);
      this.onClick(overwriteButtons, this.onSearchSidebarOverwrite, true);

      // Links inside found sidebars.
      var contentItems = container.find('.search-sidebar-content-item');
      var linkPreview = contentItems.find('.search-sidebar-link');
      var linkAdd = contentItems.find('.search-sidebar-add-single');
      this.onClick(linkPreview, this.onSearchSidebarLinkPreview, true);
      this.onClick(linkAdd, this.onSearchSidebarLinkAdd, true);
    },

    bindSidebarsCollapsibleLinksEvents: function(container) {
      var collapseButtons = container.find('.search-sidebar-links-collapse');
      var expandButtons = container.find('.search-sidebar-links-expand');
      this.onClick(collapseButtons, this.onSearchSidebarLinksCollapse, true);
      this.onClick(expandButtons, this.onSearchSidebarLinksExpand, true);
    },

    bindSectionLinksEvents: function(container, elements) {
      Contextly.overlayDialog.BaseWidget.prototype.bindSectionLinksEvents.apply(this, arguments);

      this.on('change', elements.find('.link-title-editor'), this.markSidebarChanged);
    },

    markSidebarChanged: function() {
      if (this.state.changed) {
        return;
      }

      this.state.changed = true;
      this.e.sidebarPaneTypes
        .find('.sidebar-pane-type')
        .filter('[data-pane-type="' + this.escapeSizzleAttrValue(this.state.pane) + '"]')
        .find('.sidebar-modified-flag')
        .show();
    },

    onLayoutChange: function(target) {
      var desiredLayout = $(target).attr('data-layout');
      if (this.state.layout === desiredLayout) {
        return;
      }

      this.state.layout = desiredLayout;
      this.markSidebarChanged();
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
      this.markSidebarChanged();
      this.e.sectionLinks
        .contextlySortable('destroy');

      var sectionLinks = this.e.sectionLinks
        .find('.section-link');
      for (var i = 0; i < sectionLinks.length; i++) {
        var sectionLink = sectionLinks.eq(i);
        Contextly.overlayDialog.BaseWidget.prototype.removeWidgetLink.call(this, sectionLink);
      }

      this.e.sidebarResult.hide();
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

      this.showUrlPreview($target.attr('href'), {
        confirm: this.onSearchSidebarLinkPreviewConfirm
      });
    },

    onSearchSidebarLinkPreviewConfirm: function() {
      // Get URL and title now, because it will be reset by closeUrlPreview().
      var url = this.state.previewUrl;
      var title = this.state.previewTitle;

      this.closeUrlPreview();
      this.addSearchSidebarLink(title, url);
    },

    onSidebarChooserLinkPreview: function(target, e) {
      e.preventDefault();

      this.showUrlPreview($(target).attr('href'));
    },

    onSidebarChooserEdit: function(target) {
      var desiredId = $(target)
        .closest('.search-result')
        .attr('data-sidebar-id');

      if (this.state.changed && desiredId !== this.state.id) {
        this.showModal({
          title: this.t('All changes to the opened sidebar will be lost!'),
          body: this.t('Do you really want to discard all the changes made to the opened sidebar and edit selected one?'),
          dismiss: this.t('No, keep changes and current sidebar'),
          confirm: this.t('Yes, discard changes and edit selected'),
          onConfirm: function() {
            this.changeSidebar(desiredId);
          }
        });
      }
      else {
        this.changeSidebar(desiredId);
      }
    },

    changeSidebar: function(desiredId) {
      if (desiredId !== this.state.id) {
        this.initSidebarContentState(desiredId);
        this.e.sidebarContentEditor.remove();
        delete this.e.sidebarContentEditor;
      }
      else {
        this.state.pane = 'edit';
      }

      // Refresh tabs and pane content.
      this.renderSidebarPaneTypes();
      this.renderSidebarPane();
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
      this.markSidebarChanged();

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
      if (!sidebar.links || !sidebar.links.previous || !sidebar.links.previous.length) {
        return;
      }

      this.e.sidebarResult.show();
      this.markSidebarChanged();

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
      this.saveSidebar(sidebarData);

      return false;
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
      // TODO Provide better API and drop this backward compatibility workaround.
      // Call the callback only in case the sidebar haven't been changed through
      // chooser tab.
      if (this.state.id === this.api.getSidebarId()) {
        this.api.callback(data.sidebar);
      }

      // Update sidebar and the snippet if necessary.
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

    onLinkRemove: function() {
      this.markSidebarChanged();

      Contextly.overlayDialog.BaseWidget.prototype.onLinkRemove.apply(this, arguments);
    },

    performUrlInfoRequest: function() {
      var started = Contextly.overlayDialog.BaseWidget.prototype.performUrlInfoRequest.apply(this, arguments);

      // Adding widget links from both normal search results and adding URL
      // directly end up in this function, so we use it to set "changed" flag.
      if (started) {
        this.markSidebarChanged();
      }

      return started;
    },

    initSearchSidebarsResults: function(container) {
      // Bootstrap dropdown.
      container
        .find('.search-sidebar-actions-toggle')
        .dropdown();
    },

    initSidebarsCollapsibleLinks: function(container) {
      // Collapse links by default if there are more than limit + 1 links.
      this.eachElement(container.find('li.search-result'), function(element) {
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
    },

    lockDialogActions: function() {
      Contextly.overlayDialog.BaseWidget.prototype.lockDialogActions.apply(this, arguments);

      this.e.sidebarPaneTypes
        .find('.sidebar-pane-type:not(.active):not(.disabled)')
        .addClass('disabled');
    },

    unlockDialogActions: function() {
      Contextly.overlayDialog.BaseWidget.prototype.unlockDialogActions.apply(this, arguments);

      if (this.state.actionsLocked == 0) {
        this.e.sidebarPaneTypes
          .find('.sidebar-pane-type.disabled')
          .removeClass('disabled');
      }
    }

  });

  $(function() {
    var editor = new Contextly.overlayDialog.Sidebar();
  });

})(jQuery);
