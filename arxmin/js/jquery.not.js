;(function($){
	var debugMode = true;
	function debug(msg){
		if(!debugMode){	return;	}
		if(window.console && window.console.log){
			window.console.log(msg);
		} else {	alert(msg);	}
	}
	
	$.fn.arxmin = function(method){
		var $el = $(this), el = this;
		
		var defaults = {
			callback: function(){},
			event: {},
			menuW: 200,
			panelW: 400,
			saveCallback: function(){},
			wH: null,	// window height
			wW: null	// window width
		};
		
		var settings = {};

		// public methods
		// $(selector).arxmin('methodName', arg1, arg2, ... argn) or
		// arxmin.methodName(arg1, arg2, ... argn)
		var arxmin = {
			init: function(options){ debug('init');
				settings = $.extend({}, defaults, options);
				
				return this.each(function(){
					
					settings.wH = $(window).height();
					settings.wW = $(window).width();
					
					h.setup($el);
					h.addListener($el);
					
					//arxmin.newPanel('test');
					
				});
			},

			newPanel: function(id){ debug('newPanel');
				panel.create($('#a-main'), id);
			}
		};

		// private methods
		// h.methodName(arg1, arg2, ... argn)
		var h = {
			addListener: function(o){ debug('addListener');
				
				$(window)
				.bind('resize', function(){
					settings.wH = $(window).height();
					settings.wW = $(window).width();
					
					var h = settings.wW - $('#a-topbar').height(),
					w = settings.wH - $('#a-menu').outerWidth();
					
					$('#a-main, #a-menu, #a-content').height(h);
					$('#a-content').width(w);
					
					/*o.css({
						height: settings.wH,
						/ *
						left: settings.wW/2,
						top: settings.wH/2,
						* /
						width: settings.wW
					});*/
				})
				.bind('save', function(){
					// ..
				})
				.trigger('resize');
				
				
			$(window)
			.bind('resize', function(){
				var h = $(window).height() - $('#a-topbar').height(),
				w = $(window).width() - $('#a-menu').outerWidth();
				$('#a-main, #a-menu, #a-content').height(h);
				$('#a-content').width(w);
			})
			.trigger('resize');
				// ..
				 
			},
			setup: function(o){ debug('setup');
				o.find('#a-menu')
				.css({
					width: settings.menuW
				});
				
				o.find('#a-main')
				.css({
					width: settings.wW - settings.menuW
				});
				
				o.find('.a-panel')
				.css({
					width: settings.panelW
				});
			}
		};
		
		var panel = {
			create: function(o, id){ debug('panel.create');
				var html = '<section id="'+id+'" class="a-panel">'
										+'<header></header>'
										+'<div></div>'
										+'<footer></footer>'
									+'</section>';
				
				o.append(html);
				
				panel.register();
			},
			destroy: function(){ debug('panel.destroy');
				// ..
			},
			place: function(){ debug('panel.place');
				// ..
			},
			register: function(){ debug('panel.register');
				// ..
			}
		};

		
		if(arxmin[method]){
			return arxmin[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if(typeof method === 'object' || !method){
			return arxmin.init.apply(this, arguments);
		} else {
			$.error('Method "'+method+'" does not exist in arxmin plugin!');
		}
	};
})(jQuery);
