/**
 * JS File - /js/lib/cabaret/cabaret-transition.js
 */

(function ($) {
    'use strict';


    // CSS TRANSITION SUPPORT (http://www.modernizr.com/)

    $(function () {

        $.support.transition = (function () {
            var transitionEnd = (function () {

                var el = document.createElement('bootstrap'),
                    transEndEventNames = {
                        'WebkitTransition' : 'webkitTransitionEnd',
                        'MozTransition'    : 'transitionend',
                        'OTransition'      : 'oTransitionEnd otransitionend',
                        'transition'       : 'transitionend'
                    },
                    name;

                    for (name in transEndEventNames) {
                        if (el.style[name] !== undefined) {
                            return transEndEventNames[name];
                        }
                    }

            } ());

            return transitionEnd && {
                end: transitionEnd
            };
        }) ();

    });

} (jQuery));