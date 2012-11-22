/** La Cerise Numérique : Powa
 * /js/powa.js
 */

;(function($, window, undefined){
	"use strict"
	
	var defaults = {
		min: {h: 400, w: 600}
		, manifest: 'manifest.php'
		, pathBase: '/powa'
	}, s = {}
	
	
	var methods = {
		
		init: function(options){
			var o = this
			
			s = $.extend({}, defaults, options)
			
			return this.each(function(){
				// nav
				/*$('.arx-sortable .app:not(.active)')
				.live('click.powa', function(e){
					$('.arx-sidebar .app-menu li').removeClass('active')
					methods.loadApp.call(this, '/' + $(this).attr('href'), false)
					e.preventDefault()
				})
				
				$('.arx-sortable .app.active')
				.live('click.powa', function(e){
					e.preventDefault()
				})
				
				// sub-nav
				$('.arx-content .app-menu .subnav a')
				.live('click', function(e){//console.log('ok')
					$('.arx-content .app-menu .subnav a').parent('li').removeClass('active')
					methods.loadApp.call(o, $(this).attr('href'), true)
					$(this).parent('li').addClass('active')
					e.preventDefault()
				})*/
				
				//methods.loadApp.call(o, '/app/dashboard', false)
				
				$('a[href^="external"]').attr('target', '_blank')

				$(window).bind('resize.powa', function(){
					methods.resize.call(o)
				}).trigger('resize')
			})
		}, // init
		
		loadApp: function(path, sub){
			var o = this
			
			$('body').addClass('load')
			//console.log(sub)
			if(!sub){
				$('.app, .this-app').removeClass('active')
			
				methods.loadCSS.call(o, path)
				methods.loadMenu.call(o, path)
			}
			
			$.ajax({
				url: s.pathBase + path,
				success: function(data){
					$('.this-app').addClass('active')
					.empty().html(data || '')
				}
			}).done(function(){
				$('body').removeClass('load')
				$(o).parent('li').addClass('active')
			})
		}, // loadApp
		
		loadMenu: function(path){
			$.getJSON(s.pathBase + path + '/manifest.php', function(data){
				var menu = []
				
				$.each(data, function(key, val){
					menu.push('<li><a href="' + val.url + '">' + val.title + '</a></li>')
				})
				
				$('.app-menu nav ul').html(menu.join(''))
			})
		}, // loadMenu
		
		loadCSS: function(path){
			if($('link.active').length)	$('link.active').remove()
			
			var node = document.createElement('link')
			node.className = 'active'
			node.rel = 'stylesheet'
			node.href = s.basePath + path + '/app.css'
			document.head.appendChild(node)
		}, // loadCSS
		
		resize: function(){
			var max = {w: $(window).width(), h: $(window).height()}, sidebar = $('.arx-sidebar').outerWidth()
			
			$('.arx-content').css({
				//height: (max.h >= s.min.h) ? max.h : s.min.h
				width: (max.w - sidebar >= s.min.w - sidebar) ? max.w - sidebar - 20 : s.min.w - sidebar - 20
			})
			
			$('.iframe-app').css({
				height: (max.h >= s.min.h) ? max.h - 100 : s.min.h - 100,
				width: (max.w - sidebar >= s.min.w - sidebar) ? max.w - sidebar - 50 : s.min.w - sidebar - 50
			})
			
			/*$('.arx-content, .arx-sidebar').css({
				height: (max.h >= s.min.h) ? max.h : s.min.h
				, width: (max.w - 280 >= s.min.w - 280) ? max.w - 280 : s.min.w - 280
			})*/
		}, // resize
		
	} // methods
	
	
	$.fn.powa = function(method){
		if(methods[method])	return methods[method].apply(this, Array.prototype.slice.call(arguments, 1)) // call the respective method
		else if(typeof method === 'object' || !method)	return methods.init.apply(this, arguments) // call the initialization method
		else	$.error('Method "' + method + '" does not exist in Powa plugin!') // trigger an error
	}
	
})(jQuery, window)

jQuery(function(){jQuery('body').powa()})