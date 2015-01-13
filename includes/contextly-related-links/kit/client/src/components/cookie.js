/**
 * Created by andrew on 11/5/14.
 */

Contextly.Cookie = Contextly.createClass({

    statics: /** @lends Contextly.Cookie */ {

        encode: function(s)
        {
            return encodeURIComponent(s);
        },

        decode: function(s) {
            return decodeURIComponent(s);
        },

        stringifyCookieValue: function(value)
        {
            return this.encode(JSON.stringify(value));
        },

        parseCookieValue: function (s)
        {
            var pluses = /\+/g;

            if (s.indexOf('"') === 0) {
                // This is a quoted cookie as according to RFC2068, unescape...
                s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
            }

            try {
                // Replace server-side written pluses with spaces.
                // If we can't decode the cookie, ignore it, it's unusable.
                s = decodeURIComponent(s.replace(pluses, ' '));
            } catch(e) {
                return;
            }

            try {
                return JSON.parse(s);
            } catch(e) {}
        },

        read: function (s)
        {
            return this.parseCookieValue(s);
        },

        get: function(key)
        {
            var result = key ? undefined : {};

            // To prevent the for loop in the first place assign an empty array
            // in case there are no cookies at all. Also prevents odd result when
            // calling $.cookie().
            var cookies = document.cookie ? document.cookie.split('; ') : [];

            for (var i = 0, l = cookies.length; i < l; i++) {
                var parts = cookies[i].split('=');
                var name = this.decode(parts.shift());
                var cookie = parts.join('=');

                if (key && key === name) {
                    result = this.read(cookie);
                    break;
                }

                // Prevent storing a cookie that we couldn't decode.
                if (!key && (cookie = this.read(cookie)) !== undefined) {
                    result[name] = cookie;
                }
            }

            return result;
        },

        set: function(key, value, options)
        {
            if (value !== undefined && !jQuery.isFunction(value)) {
                options = jQuery.extend({}, options);

                if (typeof options.expires === 'number') {
                    var days = options.expires, t = options.expires = new Date();
                    t.setDate(t.getDate() + days);
                }

                return (document.cookie = [
                    this.encode(key), '=', this.stringifyCookieValue(value),
                    options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                    options.path    ? '; path=' + options.path : '',
                    options.domain  ? '; domain=' + options.domain : '',
                    options.secure  ? '; secure' : ''
                ].join(''));
            }
        }
    }

});
