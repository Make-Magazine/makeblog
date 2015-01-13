(function ($) {

  // Init global Contextly namespace if not already done.
  Contextly.overlayDialog = Contextly.overlayDialog || {};

  /**
   * Base overlay editor class.
   *
   * @class
   * @extends Contextly.UiRenderer
   */
  Contextly.overlayDialog.Base = Contextly.createClass(/** @lends Contextly.overlayDialog.Base.prototype */ {

    extend: Contextly.UiRenderer,

    construct: function() {
      Contextly.UiRenderer.call(this);

      this.connectToParent();
      this.initState();

      this.renderEditor();
    },

    connectToParent: function() {
      if (!window.parent || !window.parent.jQuery) {
        $.error('Unable to connect to the parent window.');
      }

      // Set shortcut for jQuery of the parent window.
      var p$ = window.parent.jQuery;

      // Let the parent window know that iframe is ready to work and to fill the
      // API object.
      this.api = p$(window.parent).triggerHandler('contextlyOverlayReady');
      if (typeof this.api === 'undefined') {
        $.error('Unable to communicate with the parent window.');
      }

      // Retrieve settings.
      this.settings = this.api.getSettings();
    },

    getEditorVariables: function() {
      return {
        annotations: this.settings.annotations
      };
    },

    renderEditor: function() {
      this.renderTemplate('editor', this.getEditorVariables(), $('body'));
    },

    getPartials: function() {
      return {
        inputFields: true,
        searchTabs: true,
        searchPager: true
      };
    },

    initState: function() {
      this.state = {
        inProgress: false,
        lockedControls: null,
        previewUrl : null,
        scrollTop: 0,
        scrollLeft: 0,
        searchResults: {},
        searchQuery: ''
      };

      // By default support only links search.
      this.searchTypes = {
        links: {
          template: 'searchResultsLinks',
          emptyQuery: false,
          search: this.proxy(this.performLinksSearchQuery, false, true),
          render: this.proxy(this.renderLinksSearchResults, false, true)
        }
      };

      // Parse hostname on each tab.
      this.indexAnnotations();
    },

    alterTemplateVariables: function(name, vars) {
      vars.editor = {};
      vars.settings = this.settings;
    },

    getTemplateHandlers: function() {
      return {
        editor: [
          this.initHidden,
          this.findEditorRoot,
          this.findEditorElements,
          this.bindEditorEvents,
          this.initEditor
        ],
        alert: [
          this.bindAlertEvents
        ],
        searchResultsLinks: [
          this.bindSearchResultsLinksEvents
        ],
        urlPreview: [
          this.initHidden,
          this.findUrlPreviewElements,
          this.bindUrlPreviewEvents
        ],
        progressIndicator: [
          this.findProgressIndicatorElements
        ]
      };
    },

    findProgressIndicatorElements: function(container) {
      this.e.progressIndicator = container.find('.progress-indicator');
    },

    showProgressIndicator: function() {
      if (!this.e.progressIndicator) {
        this.renderTemplate('progressIndicator', {}, $('body'));
      }
      else {
        this.e.progressIndicator.show();
      }
      this.state.inProgress = true;

      this.state.lockedControls = this.e.editor.find('button');
      this.lockControls(this.state.lockedControls, 'global');
    },

    hideProgressIndicator: function() {
      this.e.progressIndicator.hide();
      this.state.inProgress = false;

      if (this.state.lockedControls) {
        this.unlockControls(this.state.lockedControls, 'global');
        this.state.lockedControls = null;
      }
    },

    lockControls: function(controls, reason) {
      // Mark each control with the reason of locking. This way we can lock the
      // same controls for multiple reasons at the same time and unlock them
      // only if all reasons are gone.
      var dataKey = 'contextlyLocked';
      for (var i = 0; i < controls.length; i++) {
        var control = controls.eq(i);

        var reasons = control.data(dataKey);
        if (!reasons) {
          reasons = {};
          control.data(dataKey, reasons);
        }
        reasons[reason] = true;
      }

      // Lock all at once.
      controls.attr('disabled', 'disabled');
    },

    unlockControls: function(controls, reason) {
      for (var i = 0; i < controls.length; i++) {
        var control = controls.eq(i);

        // Remove passed reason from the list.
        var reasons = control.data('contextlyLocked');
        if (reasons) {
          delete reasons[reason];
        }

        if ($.isEmptyObject(reasons)) {
          control.removeData('contextlyLocked');
          control.removeAttr('disabled');
        }
      }
    },

    initHidden: function(container) {
      container
        .find('.hidden')
        .css('display', 'none')
        .removeClass('hidden');
    },

    findEditorRoot: function(container) {
      // Editor itself.
      this.e.editor = container.find('.contextly-editor');
    },

    findEditorElements: function(container) {
      // Search controls.
      this.e.searchInput = this.e.editor.find('.search-phrase');
      this.e.searchSubmit = this.e.editor.find('.search-submit');

      // URL Controls.
      this.e.urlInput = this.e.editor.find('.link-url');
      this.e.urlSubmit = this.e.editor.find('.url-submit');

      // Search tabs & output placeholder.
      this.e.searchTabs = this.e.editor.find('.search-tabs');
      this.e.searchOutput = this.e.editor.find('.search-output');

      // Search pager.
      this.e.searchPager = container.find('.search-pager');
      this.e.searchNext = this.e.searchPager.find('.search-next');
      this.e.searchPrev = this.e.searchPager.find('.search-prev');
    },

    bindEditorEvents: function() {
      // Search submit handlers.
      this.onEnter(this.e.searchInput, this.onSearchSubmit);
      this.onClick(this.e.searchSubmit, this.onSearchSubmit);

      // URL submit handlers.
      this.onEnter(this.e.urlInput, this.onUrlSubmit);
      this.onClick(this.e.urlSubmit, this.onUrlSubmit);

      // Search tabs events.
      var searchTabLinks = this.e.editor.find('.search-tab-link');
      this.onClick(searchTabLinks, this.onSearchTabSwitch, true);

      // Pager events.
      this.onClick(this.e.searchNext, this.onSearchNext);
      this.onClick(this.e.searchPrev, this.onSearchPrev);
    },

    initEditor: function() {
      this.refreshSearchTabs();
    },

    bindAlertEvents: function(container, elements) {
      var alertClose = elements.find('.close');
      this.onClick(alertClose, this.hideAlert, true);
    },

    bindSearchResultsLinksEvents: function(container) {
      var addButton = container.find('.website-add');
      var testLink = container.find('.website-link');
      this.onClick(addButton, this.onSearchResultAdd, true);
      this.onClick(testLink, this.onSearchResultPreview, true);
    },

    /**
     * Binds any passed event to the element.
     *
     * The function is still fired even when the progress indicator is
     * displayed.
     *
     * @param event
     *   Event type to handle.
     * @param element
     * @param func
     *   Function that will be called with "this" as a context.
     * @param [passArguments]
     *   Pass TRUE to call func with arguments of original callback prepended
     *   with the context of original function.
     */
    on: function(event, element, func, passArguments) {
      // Wrap callback with proxy.
      func = this.proxy(func, passArguments, passArguments);
      element.bind(event, func);
    },

    /**
     * Binds click event handler that is called on this object context.
     *
     * @param element
     * @param func
     *   Function that will be called with "this" as a context.
     * @param [passArguments]
     *   Pass TRUE to call func with arguments of original callback prepended
     *   with the context of original function.
     */
    onClick: function(element, func, passArguments) {
      // Wrap callback with proxy.
      func = this.proxy(func, passArguments, passArguments);

      var self = this;
      element.bind('click', function(e) {
        if (self.state.inProgress) {
          return false;
        }

        // React on left mouse button only. IE 8 doesn't provide this info and
        // e.which is 0. See http://bugs.jquery.com/ticket/13209
        if (!e.which || e.which == 1) {
          return func.apply(this, arguments);
        }
      });
    },

    /**
     * Helper to bind Enter key press to the input field.
     *
     * @param input
     * @param func
     * @param [passArguments]
     *   Pass TRUE to call func with arguments of original callback prepended
     *   with the context of original function.
     */
    onEnter: function(input, func, passArguments) {
      // Wrap callback with proxy.
      func = this.proxy(func, passArguments, passArguments);

      var self = this;
      input.bind('keypress', function(e) {
        if (self.state.inProgress) {
          return false;
        }

        if (e.which == 13) {
          return func.apply(this, arguments);
        }
      });
    },

    /**
     * Displays alert on top of the dialog.
     *
     * @param text
     * @param [type]
     *   One of the following:
     *   - error (default)
     *   - success
     *   - warning
     *   - info
     */
    displayAlert: function (text, type) {
      type = type || 'error';

      var vars = {
        type: type,
        text: text
      };
      var container = this.e.editor;
      this.renderTemplate('alert', vars, container, 'prepend');

      this.scrollToTopLeft();
    },

    hideAlert: function (closeButton) {
      $(closeButton)
        .unbind('click')
        .closest('.alert')
        .remove();
    },

    performAjaxRequest: function (method, params, xhrData) {
      params = this.api.buildAjaxConfig(method, params);
      params.context = this;
      var jqXHR = $.ajax(params);

      // Fill in additional data that is passed to all callbacks in properties
      // of the jqXHR object.
      if (!xhrData) {
        xhrData = params.data;
      }
      jqXHR.contextlyData = xhrData;
      jqXHR.contextlyMethod = method;
    },

    getActiveSearchTab: function () {
      var tabs = this.e.searchTabs
        .find('.search-tab');
      var active = tabs.filter('.active');
      if (active.size()) {
        return active;
      }
      else {
        // Fallback to the first links search tab if there is no active tab.
        return tabs
          .filter('[data-search-type="links"]')
          .first();
      }
    },

    createTabSearchInfo: function(tab) {
      var type = tab.attr('data-search-type');
      var siteUrl = tab.attr('data-site-url');
      return new Contextly.overlayDialog.SearchInfo(type, siteUrl);
    },

    getTabSearchInfo: function(tab) {
      var dataKey = 'contextlySearchInfo';
      var searchInfo = tab.data(dataKey);
      if (!searchInfo) {
        searchInfo = this.createTabSearchInfo(tab);
        tab.data(dataKey, searchInfo);
      }
      return searchInfo;
    },

    onSearchNext: function () {
      var searchInfo = this.getTabSearchInfo(this.getActiveSearchTab());
      var cache = this.state.searchResults;
      var cacheKey = searchInfo.toStr();
      if (this.isSearchQuerySet(searchInfo) && cache[cacheKey] && cache[cacheKey].nextPage) {
        var nextPage = parseInt(cache[cacheKey].page) + 1;
        this.performSearchQuery(searchInfo, this.state.searchQuery, nextPage);
      }

      return false;
    },

    onSearchPrev: function () {
      var searchInfo = this.getTabSearchInfo(this.getActiveSearchTab());
      var cache = this.state.searchResults;
      var cacheKey = searchInfo.toStr();
      if (this.isSearchQuerySet(searchInfo) && cache[cacheKey]) {
        var currentPage = parseInt(cache[cacheKey].page);
        if (currentPage > 1) {
          this.performSearchQuery(searchInfo, this.state.searchQuery, currentPage - 1);
        }
      }

      return false;
    },

    trim: function(str) {
      if (!str) {
        return '';
      }

      return str
        .replace(/^\s+/, '')
        .replace(/\s+$/, '');
    },

    onSearchSubmit: function () {
      var query = this.trim(this.e.searchInput.val());
      var searchInfo = this.getTabSearchInfo(this.getActiveSearchTab());
      if (!query && !this.searchTypes[searchInfo.type].emptyQuery) {
        // No search terms and search type doesn't support empty query.
        // Do nothing.
        // TODO Mark input with error class and display error message.
        return;
      }

      this.performSearchQuery(searchInfo, query, 1);
    },

    onSearchTabSwitch: function (target, e) {
      e.preventDefault();

      var tab = $(target).closest('.search-tab');
      if (tab.is('.active')) {
        return;
      }

      var searchInfo = this.getTabSearchInfo(tab);
      if (!this.isSearchQuerySet(searchInfo)) {
        return;
      }

      var cacheKey = searchInfo.toStr();
      if (this.state.searchResults[cacheKey]) {
        // Get results from cache and display immediately.
        this.displaySearchResults(searchInfo, this.state.searchResults[cacheKey]);
      }
      else {
        // No cache entry, perform search query.
        this.performSearchQuery(searchInfo, this.state.searchQuery, 1);
      }
    },

    isSearchQuerySet: function(searchInfo) {
      if (this.state.searchQuery) {
        return true;
      }

      return this.searchTypes[searchInfo.type].emptyQuery;
    },

    performSearchQuery: function(searchInfo, query, page) {
      this.checkSearchType(searchInfo);
      this.showProgressIndicator();
      this.searchTypes[searchInfo.type].search(searchInfo, query, page);
    },

    performLinksSearchQuery: function(searchInfo, query, page) {
      this.performAjaxRequest('search', {
        data: {
          type: searchInfo.type,
          query: query,
          page: page,
          site_url: searchInfo.siteUrl
        },
        success: this.onSearchRequestSuccess,
        error: this.onSearchRequestError,
        complete: this.hideProgressIndicator
      });
    },

    escapeSizzleAttrValue: function(value) {
      if (!value) {
        return '';
      }

      return value.replace('"', '\\\"');
    },

    activateTab: function (searchInfo) {
      var tabs = this.e.searchTabs
        .find('.search-tab');
      tabs
        .filter('.active')
        .removeClass('active');

      // Escape type and URL.
      var escapedType = this.escapeSizzleAttrValue(searchInfo.type);
      var escapedUrl = this.escapeSizzleAttrValue(searchInfo.siteUrl);

      tabs
        .filter('[data-search-type="' + escapedType + '"][data-site-url="' + escapedUrl + '"]:first')
        .addClass('active');
    },

    onSearchRequestSuccess: function (data) {
      if (data.query !== this.state.searchQuery) {
        // Reset search results cache if search is performed on another query.
        this.state.searchResults = {};
        this.state.searchQuery = data.query;
      }

      // Store rendered results in cache for fast tab switching.
      var searchInfo = new Contextly.overlayDialog.SearchInfo(data.type, data.siteUrl);
      var cacheEntry = this.renderSearchResults(searchInfo, data);
      this.state.searchResults[searchInfo.toStr()] = cacheEntry;

      // Display results.
      this.displaySearchResults(searchInfo, cacheEntry);

      // Scroll to top of the page in case user loaded results using pager.
      this.scrollToTopLeft();
    },

    scrollToTopLeft: function() {
      var $window = $(window);
      var scrollTop = $window.scrollTop();
      var scrollLeft = $window.scrollLeft();
      if (scrollTop <= 0 && scrollLeft <= 0) {
        return;
      }

      $window.scrollTo(0, 300);
    },

    onSearchRequestError: function () {
      this.displayAlert('Unable to perform search request. Something went wrong.');
    },

    displaySearchResults: function (searchInfo, result) {
      this.refreshSearchTabs();
      this.activateTab(searchInfo);

      // Put rendered content to the page and attach event handlers.
      this.e.searchOutput
        .empty()
        .append(result.elements);
      if (!result.empty) {
        var template = this.searchTypes[searchInfo.type].template;
        this.attachTemplateHandlers(template, this.e.searchOutput, result.elements);
      }

      // Toggle pager displaying depending on results emptiness.
      if (!result.empty) {
        this.refreshPager(result.page, result.nextPage);
        this.e.searchPager.show();
      }
      else {
        this.e.searchPager.hide();
      }
    },

    refreshPager: function (page, nextPage) {
      var prevWrapper = this.e.searchPrev.closest('.previous');
      if (parseInt(page) <= 1) {
        prevWrapper
          .not('.disabled')
          .addClass('disabled');
      }
      else {
        prevWrapper
          .filter('.disabled')
          .removeClass('disabled');
      }

      var nextWrapper = this.e.searchNext.closest('.next');
      if (nextPage) {
        nextWrapper
          .filter('.disabled')
          .removeClass('disabled');
      }
      else {
        nextWrapper
          .not('.disabled')
          .addClass('disabled');
      }
    },

    refreshSearchTabs: function() {
      var tabs = this.e.searchTabs.find('.search-tab');

      if (this.state.searchQuery) {
        this.e.searchTabs.show();
        tabs.show();
      }
      else {
        var visible = false;
        this.each(this.searchTypes, function(specs, key) {
          var typeTabs = tabs.filter('[data-search-type="' + this.escapeSizzleAttrValue(key) + '"]');

          if (specs.emptyQuery) {
            typeTabs.show();
            visible = true;
          }
          else {
            typeTabs.hide();
          }
        });
        this.e.searchTabs.toggle(visible);
      }
    },

    checkSearchType: function(searchInfo) {
      if (!this.searchTypes[searchInfo.type]) {
        $.error('Unknown search type "' + searchInfo.type + '" passed.');
      }
    },

    renderSearchResults: function (searchInfo, data) {
      this.checkSearchType(searchInfo);
      var result = {
        page: data.page,
        nextPage: data.nextPage,
        empty: !(data.list && data.list.length)
      };

      if (!result.empty) {
        var items = this.searchTypes[searchInfo.type].render(data.list);
        var list = this.renderTemplate('searchResults');
        result.elements = list.append(items);
      }
      else {
        result.elements = this.renderTemplate('searchResultsEmpty');
      }

      return result;
    },

    renderLinksSearchResults: function (links) {
      return this.renderTemplate('searchResultsLinks', {
        links: links
      });
    },

    onUrlSubmit: function () {
      var url = this.trim(this.e.urlInput.val());
      if (url) {
        this.performUrlInfoRequest(url);
      }
      else {
        // TODO Mark input with error class.
      }

      return false;
    },

    onSearchResultAdd: function (target) {
      var url = $(target)
        .closest('.search-result')
        .attr('data-url');
      this.addSearchResultUrl(url);
    },

    addSearchResultUrl: function(url) {
      this.performUrlInfoRequest(url);
    },

    performUrlInfoRequest: function(url) {
      if (!url) {
        return false;
      }

      this.performAjaxRequest('url-info', {
        data: {
          url: url
        },
        success: this.onUrlInfoRequestSuccess,
        error: this.onUrlInfoRequestError,
        complete: this.onUrlInfoRequestComplete
      });
      return true;
    },

    onUrlInfoRequestSuccess: Contextly.abstractMethod(),

    onUrlInfoRequestError: Contextly.abstractMethod(),

    onUrlInfoRequestComplete: function() {
      // Do nothing by default.
    },

    onSearchResultPreview: function(target, e) {
      e.preventDefault();

      // Show the preview.
      this.showUrlPreview($(target).attr('href'), {
        confirm: this.onSearchResultPreviewConfirm
      });
    },

    onSearchResultPreviewConfirm: function() {
      // Get URL now, because it will be reset by closeUrlPreview().
      var url = this.state.previewUrl;

      this.closeUrlPreview();
      this.performUrlInfoRequest(url);
    },

    findUrlPreviewElements: function(container) {
      this.e.urlPreview = container.find('.url-preview-overlay');
      this.e.urlPreviewFrame = this.e.urlPreview.find('.url-preview-frame');
      this.e.urlPreviewLink = this.e.urlPreview.find('.url-preview-link');

      var buttons = this.e.urlPreview.find('.url-preview-buttons');
      this.e.urlPreviewButtons = {
        remove: buttons.find('.url-preview-remove'),
        cancel: buttons.find('.url-preview-cancel'),
        confirm: buttons.find('.url-preview-confirm')
      };
    },

    bindUrlPreviewEvents: function() {
      this.onClick(this.e.urlPreviewLink, this.onLinkNewTabPreview, true);
    },

    showUrlPreview: function(url, params) {
      params = $.extend({
        remove: false,
        confirm: false,
        cancel: this.closeUrlPreview
      }, params);

      // Render template if not already done.
      if (!this.e.urlPreview) {
        this.renderTemplate('urlPreview', {}, $('body'));
      }

      // Show/hide buttons and bind click handlers.
      for (var kind in this.e.urlPreviewButtons) {
        var button = this.e.urlPreviewButtons[kind];
        if ($.isFunction(params[kind])) {
          button
            .show()
            .unbind('click');
          this.onClick(button, params[kind]);
        }
        else {
          button.hide();
        }
      }

      // Save url for future use.
      this.state.previewUrl = url;

      // Lock main scroll.
      this.lockEditorScroll();

      // Set up and show preview.
      this.api.setOverlayCloseButtonHandler(this.proxy(this.onPreviewOverlayCloseButton));
      this.e.urlPreviewFrame.attr('src', url);
      this.e.urlPreviewLink.attr('href', url);
      this.e.urlPreview.show();
    },

    lockEditorScroll: function() {
      var $window = $(window);

      // Save current position to restore later.
      this.state.scrollTop = $window.scrollTop();
      this.state.scrollLeft = $window.scrollLeft();

      // The trick here is that the fixed element with dimensions larger than
      // the window doesn't trigger scrollbars.
      $('html').css({
        position: 'fixed',
        top: -this.state.scrollTop,
        left: -this.state.scrollLeft,
        width: '100%'
      });
    },

    unlockEditorScroll: function() {
      $('html').css({
        position: 'static',
        top: 'auto',
        left: 'auto',
        width: 'auto'
      });

      $(window)
        .scrollTop(this.state.scrollTop)
        .scrollLeft(this.state.scrollLeft);
    },

    onPreviewOverlayCloseButton: function() {
      this.closeUrlPreview();

      // Prevent overlay closing when preview is active.
      return false;
    },

    closeUrlPreview: function() {
      // Cleanup saved URL.
      this.state.previewUrl = null;

      // Cleanup and hide preview overlay.
      this.api.setOverlayCloseButtonHandler(null);
      this.e.urlPreviewFrame.attr('src', 'about:blank');
      this.e.urlPreview.hide();

      // Restore scroll.
      this.unlockEditorScroll();
    },

    onLinkNewTabPreview: function(target, e) {
      e.preventDefault();
      window.parent.open($(target).attr('href'));
    },

    onTextareaEnter: function (target, e) {
      e.preventDefault();
    },

    normalizeSpace: function(text) {
      // This also replaces newlines with space.
      return text
        .replace(/\s+/, ' ')
        .replace(/^\s|\s$/, '');
    },

    indexAnnotations: function() {
      this.relatedHosts = {};

      // Parse current URL too, even if it's not added to the list of
      // annotations.
      var hostname = this.extractUrlHostname(this.settings.baseUrl);
      this.relatedHosts[hostname] = true;

      for (var i = 0; i < this.settings.annotations.length; i++) {
        var annotation = this.settings.annotations[i];
        if (annotation.site_url) {
          hostname = this.extractUrlHostname(annotation.site_url);
          this.relatedHosts[hostname] = true;
        }
      }
    },

    extractUrlHostname: function (url) {
      url = this.parseUrl(url);
      return url.hostname
        .toLowerCase()
        .replace(/^\.+|\.+$/, '')
        .replace(/^w{3}\./, '');
    },

    parseUrl: function (url) {
      // We create a link using passed URL to use its "location"-like properties
      // later as a parsing result.
      var link = document.createElement("a");
      link.href = url;

      // IE doesn't populate all link properties when setting .href with a relative URL,
      // however .href will return an absolute URL which then can be used on itself
      // to populate these additional fields.
      if (link.host == "") {
        link.href = link.href;
      }

      return link;
    },

    /**
     * Returns section name for the passed link.
     *
     * This function depends on indexed host names for search tabs.
     */
    chooseUrlSection: function (url) {
      var urlHostname = this.extractUrlHostname(url);

      // We split URL domain name on dots and try to find a match with search
      // tabs domains iterating from full URL down to 2 domain parts (including).
      // TODO This method fails for IPv4 addresses, we should probably detect
      // them and return 'web'.
      urlHostname = urlHostname.split('.');
      for (var i = 0; i <= urlHostname.length - 2; i++) {
        var urlSegment = urlHostname
          .slice(i)
          .join('.');
        if (this.relatedHosts[urlSegment]) {
          // Matching tab was found.
          return 'previous';
        }
      }

      // No match found.
      return 'web';
    },

    snippetLinkExists: function(sectionName, url) {
      var exists = false;

      // Search for the URL in snippet.
      try {
        this.each(this.settings.snippet.links[sectionName], function(link) {
          if (link.native_url === url) {
            exists = true;
            return false;
          }
        });
      }
      catch (e) {
        // Just suppress the error.
      }

      return exists;
    },

    getSnippetLinkNextPos: function(section) {
      try {
        // Just return position next to the last element.
        var lastPos = this.settings.snippet.links[section]
          .slice(-1)
          .shift()
          .pos | 0;
        return lastPos + 1;
      }
      catch (e) {
        // Fallback to the first position.
        return 1;
      }
    },

    /**
     * Translates the passed string.
     *
     * @param str
     */
    t: function(str) {
      // TODO Implement UI translations.
      return str;
    }

  });

  /**
   * Search info storage.
   *
   * @class
   */
  Contextly.overlayDialog.SearchInfo = Contextly.createClass( /** @lends Contextly.overlayDialog.SearchInfo.prototype */ {
    construct: function(type, siteUrl) {
      this.type = type;
      this.siteUrl = siteUrl;
    },

    /**
     * Returns string represetnation of the search info.
     *
     * @todo Rename to toString() and use JS magic instead of direct call when
     *   we drop IE 8 support.
     *
     * @returns {string}
     */
    toStr: function() {
      return this.type + ':' + this.siteUrl;
    }
  });

})(jQuery);
