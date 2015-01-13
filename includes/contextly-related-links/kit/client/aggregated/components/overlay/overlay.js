(function ($) {

  Contextly = window.Contextly || {};

  /**
   * Overlay component.
   *
   * Injected into the website code, uses website's jQuery.
   *
   * Requires jQuery 1.2+, must work on modern jQuery versions too.
   */
  Contextly.overlay = {
    options: {},

    overlay: null,
    dialog: null,
    inner: null,
    closeButton: null,
    content: null,

    window: null,
    document: null,
    html: null,

    _defaultOptions: function() {
      return {
        zIndex: 1000,
        overlayColor: 'black',
        overlayOpacity: 0.5,
        dialogColor: 'white',
        dialogPadding: 20,
        width: {
          value: 'window',
          min: 0,
          max: 0
        },
        height: {
          value: 'window',
          min: 0,
          max: 0
        },
        spacing: 40,
        keepPrevious: false,
        dataKey: 'contextlyOverlay',
        onCloseButton: null
      };
    },

    _initOptions: function(options) {
      if (options) {
        // Allow width & height to be scalar.
        var sizes = ['width', 'height'];
        for (var i = 0; i < sizes.length; i++) {
          var size = sizes[i];
          var type = typeof options[size];
          if (type !== 'undefined' && (type === 'number' || type === 'string')) {
            options[size] = {
              value: options[size],
              min: 0,
              max: 0
            };
          }
        }

        if (options.keepPrevious) {
          this.options = $.extend(true, this.options, options);
        }
        else {
          this.options = $.extend(true, this._defaultOptions(), options);
        }
      }
      else {
        this.options = this._defaultOptions();
      }
    },

    _initElements: function() {
      // Cache elements wrapped with jQuery.
      var map = {
        window: window,
        document: document,
        html: 'html'
      };
      for (var key in map) {
        if (this[key] === null) {
          this[key] = $(map[key]);
        }
      }

      if (this.overlay === null) {
        this.overlay = $('<div class="contextly-overlay" />')
          .hide()
          .appendTo('body');
      }
      this.overlay.css({
        zIndex: this.options.zIndex,
        backgroundColor: this.options.overlayColor,
        opacity: this.options.overlayOpacity
      });

      if (this.dialog === null) {
        this.dialog = $('<div class="contextly-overlay-dialog" />')
          .hide()
          .appendTo('body');
      }
      this.dialog.css({
        backgroundColor: this.options.dialogColor,
        zIndex: this.options.zIndex + 1
      });

      if (this.inner === null) {
        this.inner = $('<div class="contextly-overlay-content" />')
          .appendTo(this.dialog);
      }
      var innerIsFixed = this._innerIsFixed();
      this.inner.css({
        zIndex: this.options.zIndex + 2,
        position: innerIsFixed ? 'fixed' : 'static',
        margin: innerIsFixed ? 0 : this.options.dialogPadding
      });

      if (this.closeButton === null) {
        this.closeButton = $('<a href="javascript:" class="contextly-overlay-close"></a>')
          .bind('click', this._proxy(this._onCloseButton))
          .appendTo(this.dialog);
      }
      this.closeButton.css({
        zIndex: this.options.zIndex + 3
      });

      // Reset dimensions and position on dialog and inner.
      this.inner
        .add(this.dialog)
        .css({
          top: '',
          left: '',
          width: '',
          height: ''
        });
    },

    open: function(element, options) {
      // Set up options, init overlay elements and the content.
      this._initOptions(options);
      this.content = element;
      this._initElements();

      // Set up event handlers.
      this.window
        .unbind('resize.contextlyOverlay')
        .bind('resize.contextlyOverlay', this._proxy(this._onWindowResize));

      // Notify world.
      this._fireEvent('contextlyOverlayBeforeOpen');

      // Lock the scroll first.
      this._lockBodyScroll();

      // Display overlay & dialog.
      this.overlay.show();
      this.inner
        .empty()
        .append(element);
      this.dialog.show();

      this._refreshDialogSizes();

      // Notify world again.
      this._fireEvent('contextlyOverlayAfterOpen');
    },

    close: function() {
      // Notify world.
      this._fireEvent('contextlyOverlayBeforeClose');

      this.content.remove();
      this.content = null;

      this.dialog.hide();
      this.overlay.hide();
      this._unlockBodyScroll();

      this.window.unbind('.contextlyOverlay');

      // Notify world again.
      this._fireEvent('contextlyOverlayAfterClose');
    },

    setCloseButtonHandler: function(callback) {
      this.options.onCloseButton = callback;
    },

    _onCloseButton: function() {
      // Don't close the overlay in case it returns false.
      if ($.isFunction(this.options.onCloseButton) && this.options.onCloseButton() === false) {
        return;
      }

      this.close();
    },

    _onWindowResize: function() {
      this._refreshDialogSizes();
    },

    _innerIsFixed: function() {
      return this.options.height.value === 'window';
    },

    _setDialogDimension: function(dimension, dialogSize) {
      this.dialog.css(dimension, dialogSize);

      if (this._innerIsFixed()) {
        this.inner.css(dimension, dialogSize - 2 * this.options.dialogPadding);
      }
    },

    _setDialogPosition: function(coordinate, windowSize, dialogSize) {
      var dialogPosition = Math.floor((windowSize - dialogSize) / 2);
      this.dialog.css(coordinate, dialogPosition);

      if (this._innerIsFixed()) {
        this.inner.css(coordinate, dialogPosition + this.options.dialogPadding);
      }
    },

    _refreshDialogSize: function(dimension, coordinate, options) {
      var dialogSize,
        windowSize = this.window[dimension]();

      switch (options.value) {
        case 'window':
          // Dialog is sticky to the window size.
          dialogSize = windowSize - this.options.spacing * 2;
          dialogSize = this._applyDialogSizeLimits(dialogSize, options);
          this._setDialogDimension(dimension, dialogSize);
          this._setDialogPosition(coordinate, windowSize, dialogSize);
          break;

        case 'auto':
          // Dialog dimension depends on the content. Content is responsible to
          // have at least width for proper display.
          dialogSize = this.dialog[dimension]();
          this._setDialogPosition(coordinate, windowSize, dialogSize);
          break;

        default:
          if (typeof options.value !== 'number') {
            $.error('Unsupported overlay ' + dimension + ' value: ' + options.value);
          }

          // Dialog size is a fixed value.
          dialogSize = options.value;
          this._setDialogDimension(dimension, dialogSize);
          this._setDialogPosition(coordinate, windowSize, dialogSize);
          break;
      }
    },

    _refreshDialogSizes: function() {
      var dimensions = {
        'width': 'left',
        'height': 'top'
      };
      for (var dimension in dimensions) {
        var coordinate = dimensions[dimension];
        var sideOptions = this.options[dimension];
        this._refreshDialogSize(dimension, coordinate, sideOptions);
      }
    },

    _applyDialogSizeLimits: function(value, limits) {
      if (limits.min && value < limits.min) {
        value = limits.min;
      }
      else if (limits.max && value > limits.max) {
        value = limits.max;
      }

      return value;
    },

    _proxy: function(func) {
      var self = this;
      return function() {
        func.apply(self, arguments);
      }
    },

    _fireEvent: function (type) {
      // Remove the type of event.
      var args = Array.prototype.slice.call(arguments, 1);

      this.window.triggerHandler(type, args);
    },

    _lockBodyScroll: function() {
      // Store scroll position and current HTML element style.
      var data = {
        scroll: {
          top: this.window.scrollTop(),
          left: this.window.scrollLeft()
        },
        style: this.html.attr('style')
      };

      // The trick here is that the fixed element with dimensions larger than
      // the window doesn't trigger scrollbars.
      var css = {
        position: 'fixed',
        top: -data.scroll.top,
        left: -data.scroll.left,
        width: '100%'
      };

      // To avoid page "jumping" we force empty scrollbars in case they were
      // visible because of the document height.
      if (this.document.height() > this.window.height()) {
        css['overflow-y'] = 'scroll';
      }

      this.html
        .data(this.options.dataKey, data)
        .css(css);
    },

    _unlockBodyScroll: function() {
      var data = this.html.data(this.options.dataKey);
      if (data) {
        // Restore "style" attribute back to its state before we locked the
        // document scrolling. This also removes the scroll lock and our styles.
        // Use non-empty string to be sure style is overwritten (IE 8 fix).
        this.html.attr('style', data.style || ' ');

        // Scroll the page back to its original position.
        this.window
          .scrollTop(data.scroll.top)
          .scrollLeft(data.scroll.left);
      }
    }
  };

})(jQuery);
