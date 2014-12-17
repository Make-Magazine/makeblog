(function ($) {

  /**
   * Sortable list component.
   *
   * Used inside the overlay editor, so tested with jQuery 1.9 & 1.10 only.
   *
   * @class
   */
  Contextly.SortableVertical = Contextly.createClass( /** @lends Contextly.SortableVertical.prototype */ {

    construct: function(list, options) {
      this.options = $.extend({
        items: 'li',
        handle: '.handle',
        placeholder: '<li />',
        scrollable: window,
        scrollingThreshold: 40,
        scrollingStep: 40
      }, options);
      this.list = list;

      this.init();
    },

    init: function() {
      this.items = this.list.children(this.options.items);
      this.items
        .find(this.options.handle)
        .on(this.ns('mousedown'), this.proxy(this.onDragStart))
        .on(this.ns('selectstart'), function() {
          return false;
        });
      this.scrollable = $(this.options.scrollable);

      // Dragged item will be absolutely positioned, so we have to limit its
      // position to the list.
      this.list.css({
        position: 'relative'
      });

      // Init dragged item & placeholder.
      this.draggedItem = null;
      this.placeholder = null;
    },

    destroy: function() {
      if (this.draggedItem !== null) {
        // Stop dragging immediately.
        this.onDragDrop();
      }

      // Un-bind event handlers from handles.
      this.items
        .find(this.options.handle)
        .off(this.ns());
    },

    refresh: function() {
      this.destroy();
      this.init();
    },

    /**
     * Adds namespace to events.
     */
    ns: function(events) {
      if (!events) {
        events = '';
      }

      events = events.split(/\s+/);
      for (var i = 0; i < events.length; i++) {
        events[i] += '.contextlySortableVertical';
      }
      return events.join(' ');
    },

    proxy: function(func, context) {
      if (!context) {
        context = this;
      }
      return function() {
        Array.prototype.unshift.call(arguments, this);
        return func.apply(context, arguments);
      };
    },

    onDragStart: function(element, e) {
      this.draggedItem = $(element)
        .closest(this.options.items);
      this.draggedItemStyle = this.draggedItem.attr('style');
      this.draggedItemSize = {
        width: this.draggedItem.width(),
        height: this.draggedItem.height()
      };
      this.draggedItemPos = this.draggedItem.position();

      // Calculate difference between cursor position and the item top line to
      // stick item to the cursor without calculating deltas on mouse move.
      // We'll also need offset of the list to calculate dragged item position.
      var draggedItemOffset = this.draggedItem.offset();
      this.mouseDelta = e.pageY - draggedItemOffset.top;
      this.listOffset = this.list.offset();

      this.placeholder = $(this.options.placeholder)
        .css('height', this.draggedItemSize.height);
      this.draggedItem
        .after(this.placeholder)
        .css({
          position: 'absolute',
          top: this.draggedItemPos.top,
          left: this.draggedItemPos.left,
          width: this.draggedItemSize.width,
          height: this.draggedItemSize.height,
          zIndex: 1
        });

      $('body')
        .on(this.ns('mousemove'), this.proxy(this.onDragMove))
        .on(this.ns('mouseup mouseleave'), this.proxy(this.onDragDrop));

      return false;
    },

    onDragMove: function(element, e) {
      var listHeight = this.list.height();

      // Apply difference with previous position to the dragged element
      // position, apply limits.
      this.draggedItemPos.top = e.pageY - this.listOffset.top - this.mouseDelta;
      if (this.draggedItemPos.top < 0) {
        this.draggedItemPos.top = 0;
      }
      else if (this.draggedItemPos.top + this.draggedItemSize.height > listHeight) {
        this.draggedItemPos.top = listHeight - this.draggedItemSize.height;
      }

      this.draggedItem.css('top', this.draggedItemPos.top);

      // Scroll if cursor is close to the edge.
      // TODO Scroll with animation while cursor is near the edge.
      var scrollTop = this.scrollable.scrollTop();
      var scrollableHeight = this.scrollable.height();
      if (e.pageY - this.options.scrollingThreshold <= scrollTop) {
        // Scroll only if we've not yet reached the list top edge.
        if (scrollTop > this.listOffset.top) {
          // Scroll upwards a bit.
          this.scrollable.scrollTop(scrollTop - this.options.scrollingStep);
        }
      }
      else if (e.pageY + this.options.scrollingThreshold >= scrollTop + scrollableHeight) {
        // Scroll only if we've not yet reached the list bottom edge.
        if (scrollTop + scrollableHeight < this.listOffset.top + listHeight) {
          // Scroll downwards a bit.
          this.scrollable.scrollTop(scrollTop + this.options.scrollingStep);
        }
      }

      // Make sure that placeholder is on expected position if scrolling is
      // not necessary.
      this.reevaluatePlaceholderPosition();

      return false;
    },

    reevaluatePlaceholderPosition: function() {
      var placeholderPos = this.placeholder.position();
      if (this.draggedItemPos.top < placeholderPos.top) {
        // Top point of the dragged item is above the placeholder. Check if we
        // need to move the placeholder upwards.
        var prev = this.placeholder.prev(this.options.items);
        var moveBefore = null;
        while (prev.size()) {
          var prevPos = prev.position();
          if (this.draggedItemPos.top < prevPos.top) {
            // Top point of the dragged item is above the previous item. Move it
            // immediately and keep searching upwards.
            moveBefore = prev;
          }
          else {
            var prevHeight = prev.height();

            var topThreshold;
            if (prevHeight / 2 <= this.draggedItemSize.height) {
              // Previous item is small enough, just make sure that dragged item
              // reached its bottom border.
              topThreshold = prevPos.top + prevHeight / 2;
            }
            else {
              // Previous item is larger than the dragged item. Prevent jumping
              // of the placeholder by making sure that after moving it to this
              // position top point of the dragged element will be inside the
              // placeholder.
              topThreshold = prevPos.top + this.draggedItemSize.height;
            }

            if (this.draggedItemPos.top < topThreshold) {
              // Enough to move placeholder.
              moveBefore = prev;
            }

            // Top point of this previous item is above the top point of the
            // dragged item. Finish the search.
            break;
          }

          // Keep searching upwards.
          prev = prev.prev(this.options.items);
        }

        if (moveBefore !== null) {
          moveBefore.before(this.placeholder);
        }
      }
      else if (this.draggedItemPos.top + this.draggedItemSize.height > placeholderPos.top + this.draggedItemSize.height) {
        // Top point of the dragged item is below the placeholder. Check if we
        // need to move placeholder downwards.
        var next = this.placeholder.next(this.options.items);
        var moveAfter = null;
        while (next.size()) {
          var nextPos = next.position();
          var nextHeight = next.height();
          var draggedItemBottom = this.draggedItemPos.top + this.draggedItemSize.height;
          if (draggedItemBottom > nextPos.top + nextHeight) {
            // Bottom point of the dragged item is below the next item. Move it
            // immediately and keep searching downwards.
            moveAfter = next;
          }
          else {
            var bottomThreshold;
            if (nextHeight / 2 <= this.draggedItemSize.height) {
              // Previous item is small enough, just make sure that the dragged
              // item reached top line of the next item.
              bottomThreshold = nextPos.top + nextHeight / 2;
            }
            else {
              // Previous item is larger than the dragged one. Prevent jumping
              // of the placeholder by making sure that after moving it to this
              // position bottom point of the dragged element will be inside the
              // placeholder.
              bottomThreshold = nextPos.top + nextHeight - this.draggedItemSize.height;
            }

            if (draggedItemBottom > bottomThreshold) {
              // Enough to move placeholder.
              moveAfter = next;
            }

            // Top point of this previous item is above the top point of the
            // dragged item. Finish the search.
            break;
          }

          // Keep searching downwards.
          next = next.next(this.options.next);
        }

        if (moveAfter !== null) {
          moveAfter.after(this.placeholder);
        }
      }
    },

    onDragDrop: function() {
      // Cleanup all global event handlers.
      $('body')
        .off(this.ns());

      this.draggedItem.insertAfter(this.placeholder);
      if (this.draggedItemStyle) {
        this.draggedItem.attr('style', this.draggedItemStyle);
      }
      else {
        this.draggedItem.removeAttr('style');
      }
      this.placeholder.remove();

      this.draggedItem = null;
      this.placeholder = null;

      return false;
    }

  });

  /**
   * jQuery plugin wrapper around the sortable component.
   */
  $.fn.contextlySortable = function() {
    var args = arguments;
    var dataKey = 'contextlySortableVertical';
    var isMethodCall = (arguments[0] in Contextly.SortableVertical.prototype);
    if (isMethodCall) {
      var methodName = args[0];
      args = Array.prototype.slice.call(args, 1);
    }
    return this.each(function() {
      var list = $(this);
      var instance;
      if (isMethodCall) {
        instance = list.data(dataKey);
        if (instance) {
          Contextly.SortableVertical.prototype[methodName].apply(instance, args);
        }

        // Cleanup stored reference on destroying sortable.
        if (methodName == 'destroy') {
          list.removeData(dataKey);
        }
      }
      else {
        instance = new Contextly.SortableVertical(list, args[0]);
        list.data(dataKey, instance);
      }
    });
  };

})(jQuery);
