/**
 * JS File - DataManager v0.1
 */


var removeItem = function () {};

var addItem = function (e) {
    e.preventDefault();


};


(function ($) {
    'use strict';


    $(function () {
        $('[rel="tooltip"]').tooltip();
        $('.collapse').collapse();
        $('[rel="tooltipmenu"]').tooltipmenu();

        $('#sidebar')
        // 1. ajoute un content
        //  - ouvre un formulaire
        //  - à la validation du form -> ajoute un contenu
        .on('click', '.add', function (e) {
            e.preventDefault();

            // displayContent
        });

        // 2. 

        $('.sortable').sortable({
            // axis: 'y',
            connectWith: '.connectedSortable',
            items: 'li:not(.add)',
            placeholder: 'ui-state-highlight',
            update: function (e, ui) {}
        })
        .disableSelection()

        $('.connectedSortable').sortable({
            // axis: 'y',
            connectWith: '.sortable',
            items: 'li',
            placeholder: 'ui-state-highlight',
            update: function (e, ui) {}
        })
        .disableSelection()
        // .droppable({
        //     accept: '.connectedSortable li',
        //     hoverClass: 'ui-state-hover',
        //     // drop: function (e, ui) {console.log(this);
        //     //     var $item = $(this);
        //     // }
        // });

        
    });

} (jQuery));