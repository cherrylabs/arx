/*jshint nonstandard: true, browser: true, boss: true */
/*global jQuery*/

/** ARX - aLabelManager
 * JS File - /apps/aLabelManager/js/edit.js
 */

(function ($) {
	"use strict";
	

	var oConfig = {
		// Location of TinyMCE script
		script_url: '<?= ARX_JS ?>/tinymce/jscripts/tiny_mce/tiny_mce.js',

		// General options
		mode: 'textareas',
		theme: 'advanced',
		plugins: 'pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',

		element_format: 'html',
		verify_html: false,
		force_p_newlines: false,
		forced_root_block: false,
		paste_auto_cleanup_on_paste: '1',

		// Theme options
		theme_advanced_buttons1: 'save,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,nonbreaking,|,forecolor,backcolor,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,link,unlink,code,|,preview',
		//theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,link,unlink,code,|,preview",
		theme_advanced_toolbar_location: 'top',
		theme_advanced_toolbar_align: 'left',
		theme_advanced_statusbar_location: 'bottom',
		theme_advanced_resizing: true,

		// Example content CSS (should be your site CSS)
		content_css: '<?= URL_ROOT.DS.CSS ?>/style.css',

		// Drop lists for link/image/media/template dialogs
		template_external_list_url: 'lists/template_list.js',
		external_link_list_url: 'lists/link_list.js',
		external_image_list_url: 'lists/image_list.js',
		media_external_list_url: 'lists/media_list.js',

		// Replace values for the template plugin
		template_replace_values: {
			username: 'Some User',
			staffid: '991234'
		}
	}; // oConfig


	$(function () {

		$('textarea').tinymce(oConfig);

	}); // jQuery.ready

}(jQuery)); // 2012-11-27 by Stéphan Zych
