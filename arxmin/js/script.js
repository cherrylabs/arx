/**
 * JS File - /js/script.js
 */

(function ($) {
    'use strict';


    $(function () {
        $('[rel="tooltip"]').tooltip();
        $('.collapse').collapse();
        $('[rel="tooltipmenu"]').tooltipmenu();
        

        var $sidebar = $('#sidebar'), $application = $('#application');

        $sidebar
        .on('click', '[href="#sidebar"]', function (e) {
            e.preventDefault();

            if ($sidebar.hasClass('closed')) {
                $sidebar.removeClass('closed');
                $application.removeClass('full');
            } else {
                $sidebar.addClass('closed');
                $application.addClass('full');
            }
        });
    });

} (jQuery));