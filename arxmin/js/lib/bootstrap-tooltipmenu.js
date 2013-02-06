/**
 * bootstrap-tooltipmenu.js v0.1
 */

(function ($) {
    'use strict';

    
    var TooltipMenu = function () {
        var defaults = {};

        var init = function (options) {
            defaults = $.extend({}, defaults, options);

            return this.each(function () {
                var $toggle = $(this), id = $toggle.data('tooltipmenu') || $toggle.attr('href'), $menus = $(id).find('li'), items = '';

                $menus.each(function () {
                    items += $(this).html();
                })
                .parent().remove();

                $toggle.tooltip({
                    html: true,
                    placement: 'right',
                    template: '<div class="tooltip tooltipmenu" id="' + id + '"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="width: ' + $menus.length*15 + 'px;"></div></div>',
                    title: items,
                    trigger: 'manual'
                });

                $toggle
                .on('mouseenter', function () {
                    $toggle.tooltip('show');
                });

                $toggle.parent()
                .on('mouseleave', function () {console.log('ok');
                    $toggle.tooltip('hide');
                });

                $(document)
                .on('click', function () {
                    $toggle.tooltip('hide');
                });
            });
        }; // init

        return {
            init: init,
        };
    }; // TooltipMenu


    $.fn.tooltipmenu = function (options) {
        if (!$.data(this, 'tooltipmenu')) {
            $.data(this, 'tooltipmenu', new TooltipMenu(this, options));
        }

        var plugin = $.data(this, 'tooltipmenu');

        if (plugin[options]) {
            return plugin[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof options === 'object' || !options) {
            return plugin.init.apply(this, arguments);
        } else {
            $.error('Method "' + arguments[0] + '" does not exist in $.tooltipmenu plugin!');
        }
    }; // $.fn.tooltipmenu

} (jQuery));