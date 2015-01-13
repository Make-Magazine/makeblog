(function($) {

  /**
   * Single link editor.
   *
   * @class
   * @extends Contextly.overlayDialog.Base
   */
  Contextly.overlayDialog.Link = Contextly.createClass(/** @lends Contextly.overlayDialog.Link.prototype */ {

    extend: Contextly.overlayDialog.Base,

    getTemplateHandlers: function() {
      var handlers = Contextly.overlayDialog.Base.prototype.getTemplateHandlers.apply(this, arguments);

      handlers.editor = handlers.editor || [];
      handlers.editor.push(
        this.searchPassedText
      );

      return handlers;
    },

    alterTemplateVariables: function(name, vars) {
      Contextly.overlayDialog.Base.prototype.alterTemplateVariables.apply(this, arguments);

      vars.editor.isLink = true;
    },

    searchPassedText: function() {
      // Start searching immediately using selected text passed to the dialog.
      var text = this.api.getText();
      if (text) {
        this.e.searchInput.val(text);
        this.onSearchSubmit();
      }
    },

    onUrlSubmit: function() {
      var url = this.e.urlInput
        .val()
        .replace(/^\s+|\s+$/, '');
      this.applyUrl(url);
    },

    addSearchResultUrl: function(url) {
      this.applyUrl(url);
    },

    onSearchResultPreviewConfirm: function() {
      // Get URL now, because it will be reset by closeUrlPreview().
      var url = this.state.previewUrl;

      this.closeUrlPreview();
      this.applyUrl(url);
    },

    applyUrl: function(url) {
      if (!url) {
        return;
      }

      var type = this.chooseUrlSection(url);
      if (this.snippetLinkExists(type, url)) {
        // URL is already in snippet. Return immediately.
        this.returnUrl(url);
      }
      else {
        // Add URL to the snippet first.
        this.addSnippetLink({
          type: type,
          url: url
        });
      }
    },

    addSnippetLink: function(data) {
      data.pos = this.getSnippetLinkNextPos(data.type);

      if (this.settings.snippet && typeof this.settings.snippet.id !== 'undefined') {
        data.snippet_id = this.settings.snippet.id;
      }

      this.showProgressIndicator();
      this.performAjaxRequest('add-snippet-link', {
        data: data,
        success: this.onAddSnippetLinkSuccess,
        error: this.onAddSnippetLinkError
      });
    },

    onAddSnippetLinkSuccess: function(response) {
      // Update snippet with new added link.
      this.api.setSnippet(response.snippet);

      // Pass URL back to the editor.
      this.returnUrl(response.url);
    },

    onAddSnippetLinkError: function() {
      this.displayAlert('Unable to add link to the widget. Something went wrong.');
      this.hideProgressIndicator();
    },

    returnUrl: function(url) {
      if (!url) {
        return;
      }

      this.api.callback({
        link_url: url,
        link_title: ''
      });
      this.api.closeOverlay();
    }

  });

  $(function() {
    var editor = new Contextly.overlayDialog.Link();
  });

})(jQuery);