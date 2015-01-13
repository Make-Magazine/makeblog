(function($) {

  /**
   * Mixin with proxy features to simplify callbacks usage on rich classes.
   *
   * @class
   */
  Contextly.Proxy = Contextly.createClass( /** @lends Contextly.Proxy.prototype */ {

    /**
     * Returns proxy function that will be called in current context.
     *
     * @param func
     * @param [passContext]
     *   If true the context of the proxy will be passed as a first argument to
     *   the callback function.
     * @param [passArguments]
     *   If true the arguments of the proxy will be passed to the callback
     *   (after) the proxy context if set.
     */
    proxy: function(func, passContext, passArguments) {
      // Event handlers need GUID and it is used to remove the same function
      // later. Init GUID of the callback first.
      if (!func.guid) {
        func.guid = $.guid++;
      }

      // To minimize overhead of the proxy we generate 4 different functions to
      // avoid runtime checks.
      var self = this;
      var proxy;
      if (passArguments) {
        if (passContext) {
          proxy = function() {
            Array.prototype.unshift.call(arguments, this);
            return func.apply(self, arguments);
          };
        }
        else {
          proxy = function() {
            return func.apply(self, arguments);
          };
        }
      }
      else {
        if (passContext) {
          proxy = function() {
            return func.call(self, this);
          };
        }
        else {
          proxy = function() {
            return func.call(self);
          };
        }
      }

      // Copy GUID of the callback to the proxy, so it could be detached from
      // the event.
      proxy.guid = func.guid;

      return proxy;
    },

    each: function(collection, func) {
      return $.each(collection, this.proxy(func, true, true));
    },

    eachElement: function(elements, func) {
      return this.each(elements, function() {
        arguments[0] = $(arguments[0]);
        return func.apply(this, arguments);
      });
    }

  });

})(jQuery);