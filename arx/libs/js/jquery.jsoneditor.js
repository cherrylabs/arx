/*
 * Version 1.0.0
 * Json Editor is copyright 2011 Fai Yip @ omegapi.hk@gmail.com
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 * 
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL KEVIN VAN ZONNEVELD BE LIABLE FOR ANY CLAIM, DAMAGES
 * OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */ 



( function( jQuery ){
/*

it doesn't check for duplicate key name.  the last duplicate key will override the previous values.

it allow drag and drop by using jquery ui sortable.  It is impossible(for me) to drag and drop an item into an empty array.

it doesn't create a form inside the element.  Because I don't know if the browser support form nesting. It works on Firefox and Chrome.

*/

	var methods = {

		init : function( json_val, options ){
			var defaults = {
				enable_drag:	true,
				enable_remove:	true,
				enable_export:	true,
				enable_import:	true,
				enable_new_val:	true,
				enable_new_array:	true }

			var innerHtml = '';
			var this_options = jQuery.extend( {}, defaults, options );
			var root_parent = jQuery( this );

			innerHtml += json_editor_commands_html( this_options );
			innerHtml += json_editor_json2ul( json_val, this_options ) ;

			jQuery( this )
				.addClass( "json_editor_div" )
				.html( innerHtml )
				.data( 'json_editor', this_options );
			
			if( this_options.enable_drag ){
				jQuery( this ).children( "ul" ).sortable( {
					items: "li:not(.json_non_sortable)",
					connectWith: 'ul'
				} );
			}

			//remove function.
			jQuery( ".json_editor_div .json_remove" )
				.die( "click" )
				.die( "mouseenter" )
				.die( "mouseleave" )
				.live( {
					click: function( ){
						jQuery( this ).parent( ).json_editor( 'remove' );
					},
					mouseenter: function( ){
						return jQuery( this ).parent( ).addClass( "highlight" );
					},
					mouseleave:	function( ){
						return jQuery( this ).parent( ).removeClass( "highlight" );
					}
				} );

			//expand and collapse array.
			jQuery( ".json_editor_div .json_toggle" ).die( "click" ).live( 'click', function( ){
				jQuery( this ).parent( ).children( ":not(.json_toggle, .json_key_name, .json_remove)" ).toggle( );
			} );

			//json create value
			jQuery( ".json_editor_div .json_create_value" ).die( "click" ).live( 'click', function( ){
				jQuery( jQuery( this ).parents( 'li, .json_editor_div' ).get( 0 ) ).json_editor( 'add_key' );

			} );

			//json create array
			jQuery( ".json_editor_div .json_create_array" ).die( "click" ).live( 'click', function( ){

				jQuery( jQuery( this ).parents( 'li, .json_editor_div' ).get( 0 ) ).json_editor( 'add_array' );

			} );

			//json export.
			jQuery( ".json_editor_div .json_export" ).die( "click" ).live( 'click', function( ){
				alert( json_encode( jQuery( this ).parent( ).json_editor( 'export_json' ) ) );

			} );

			//json import
			jQuery( ".json_editor_div .json_import" ).die( "click" ).live( 'click', function( ){
				var tmp_val = prompt( "new val" );
				if( tmp_val ){
					try{
						var json_val = eval( "(" + tmp_val + ")" );
						jQuery( this ).parent( ).json_editor( 'import_json', json_val );
					} catch( e ){
						alert( "unable to parse the json string, please make sure it is format correctly" );
					}
				}
			} );

			//json type swap.
			jQuery( ".json_editor_div .json_type_swap" ).die( "click" ).live( 'click', function( ){

				var val_type = jQuery( this ).parent( ).attr( 'json_val_type' ).toUpperCase( );

				if( val_type == 'INT' ){
					jQuery( this ).html( "Double" ).parent( ).attr( 'json_val_type', 'DOUBLE' );
				}
				else if( val_type == 'DOUBLE' ){
					jQuery( this ).html( "String" ).parent( ).attr( 'json_val_type', 'STRING' );
				}
				else if( val_type == 'STRING' ){
					jQuery( this ).html( "Bool" ).parent( ).attr( 'json_val_type', 'BOOL' );
				}
				else if( val_type == 'BOOL' ){
					jQuery( this ).html( "INT" ).parent( ).attr( 'json_val_type', 'INT' );
				}
			} );
			return this ;
		},
		export_json:	function( ){
			var ul_elem = jQuery( this ).children( "ul" );
			if( ul_elem.length == 0 && jQuery( this ).parent( ).hasClass( "json_array" ) ){
				ul_elem = jQuery( this ).parent( ).children( "ul" );
			}
			var tmp_val = json_editor_ul2json( ul_elem );
			return tmp_val;
		},

		import_json:	function( ){
			if( jQuery( this ).hasClass( 'json_editor_div' ) ){
				var json_editor_elem = jQuery( this );
			} else {
				var json_editor_elem = jQuery( jQuery( this ).parents( ".json_editor_div" ).get( 0 ) );
			}
			if( json_editor_elem.length == 0 ){
				return false;
			}

			if( arguments.length == 1 ){
				//top level import 
				var ul_elem = jQuery( this ).children( "ul" );
				var json_val = arguments[0];
			} else{
				var ul_elem = jQuery( this ).json_editor( 'get_elem', arguments[0] ).children( "ul" );
				var json_val = arguments[1];
			}

			if( ul_elem.length == 0 ){
				if( jQuery( this ).parent( ).hasClass( "json_array" ) ){
					ul_elem = jQuery( this ).parent( ).children( "ul" );
				} else{
					return false;
				}
			}

			var this_options = json_editor_elem.data( 'json_editor' );
			var content = json_editor_json2ul( json_val, this_options );

			ul_elem.replaceWith( content );

			return jQuery( this );
		},

		add_key:	function( ){
			if( jQuery( this ).hasClass( "json_editor_div" ) ){
				//this is the root.
				var json_editor_elem = jQuery( this );
			} else{
				var json_editor_elem = jQuery( jQuery( this ).parents( ".json_editor_div" ).get( 0 ) );
			}
			var ul_elem = jQuery( this ).children( 'ul' );
			var child_length = ul_elem.children().length;
			ul_elem.append( json_editor_json_val2li( '', child_length, json_editor_elem.data( 'json_editor' ) ) );

			return jQuery( this );
		},

		add_array:	function( ){
			if( jQuery( this ).hasClass( "json_editor_div" ) ){
				//this is the root.
				var json_editor_elem = jQuery( this );
			} else{
				var json_editor_elem = jQuery( jQuery( this ).parents( ".json_editor_div" ).get( 0 ) );
			}
			var ul_elem = jQuery( this ).children( 'ul' );
			var child_length = ul_elem.children().length;
			ul_elem.append( json_editor_json_val2li( {}, child_length, json_editor_elem.data( 'json_editor' ) ) );

			return jQuery( this );
		},

		get_array:	function( array_name ){
			return jQuery( this ).find( "li[json_val_type='ARRAY'] input.json_key_name" ).val_equal( array_name ).parent( );
		},
		get_elem:	function( key_name ){
			return jQuery( this ).find( "ul li input.json_key_name" ).val_equal( key_name ).parent( );
		},
		remove:	function( ){
			jQuery( this ).remove( );
		}

	};

	jQuery.fn.json_editor = function( method ) {
		if( method == 'import_json' ){
			//import is different, program should do something like 
			//jQuery( "#rootID" ).json_editor( 'get_elem', [ 'sub_array' ] ).json_editor( 'import_json', { k:'v' } );
			return methods[ method].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( methods[method] ) {
			if( arguments.length == 2 && ( typeof arguments[1] == 'object' ) ){
				var tmp_elem = jQuery( this );
				for( var i=0; i < arguments[1].length; i++ ){
					if( tmp_elem.length ){
						tmp_elem = tmp_elem.json_editor( 'get_elem', arguments[1][i] );
					}
				}
				if( tmp_elem.length ){
					if( method != 'get_elem' ){
						return methods[ method ].apply( tmp_elem, Array.prototype.slice.call( arguments, 2 ) );
					} else{
						return tmp_elem;
					}
				} else{
					return jQuery( null );
				}
			}
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			//to find the sub array with matching name.
			try{
				var tmp_elem = jQuery( this ).json_editor( 'get_array', arguments[0] );
				if( tmp_elem.length == 1 ){
					return tmp_elem;
				}
			} catch( e ){
				//no error if not found.
			}
			jQuery.error( 'Method ' +  method + ' does not exist on jQuery.json_editor ' );
		}    

	};	

	function json_editor_commands_html( options ){
		var innerHtml = '';
		if( options.enable_new_val ){
			innerHtml += " <span class=\"json_create_value json_non_sortable\">(+value)</span>";
		}
		if( options.enable_new_array ){
			innerHtml += " <span class=\"json_create_array json_non_sortable\">(+array)</span>";
		}
		if( options.enable_export ){
			innerHtml += " <span class=\"json_export json_non_sortable\">(export)</span>";
		}
		if( options.enable_import ){
			innerHtml += " <span class=\"json_import json_non_sortable\">(import)</span>";
		}
		return innerHtml;
	}

	function json_editor_json2ul( json_vals, options ){
		var content = '<ul>';
		for( var prop in json_vals ){
			content += json_editor_json_val2li( json_vals[ prop ], prop, options );
		}
		content += "</ul>\n";
		return content ;
	}

	function json_editor_json_val2li( this_val, val_name, options ){
		var content = '';
		if( typeof this_val == "number" ){
			if( parseInt( this_val ) == this_val ){
				content += sprintf( "<li json_val_type=\"INT\"><span class=\"json_type_swap\">Int</span> %s : %s%s</li>\n",
					json_editor_key_name_input( val_name ), json_editor_key_value_input( this_val ), json_editor_remove_html( options ) );
			} else{
				content += sprintf( "<li json_val_type=\"DOUBLE\"><span class=\"json_type_swap\">Double</span> %s : %s%s</li>\n",
					json_editor_key_name_input( val_name ), json_editor_key_value_input( this_val ), json_editor_remove_html( options ) );
			}
		}
		else if( typeof this_val == "string" ){
			content += sprintf( "<li json_val_type=\"STRING\"><span class=\"json_type_swap\">String</span> %s : %s%s</li>\n",
				json_editor_key_name_input( val_name ), json_editor_key_value_input( this_val ), json_editor_remove_html( options ) );
		}
		else if( typeof this_val == "array" || typeof this_val == "object" ){
			content += sprintf( "<li json_val_type=\"ARRAY\"><span class=\"json_toggle json_non_sortable\">Array</span> %s%s%s%s</li>\n",
				json_editor_key_name_input( val_name ),
				json_editor_commands_html( options ),
				json_editor_remove_html( options ),
				json_editor_json2ul( this_val, options ),
				"" );
		}
		else if( typeof this_val == "boolean" ){
			content += sprintf( "<li json_val_type=\"BOOL\"><span class=\"json_type_swap\">Bool</span> %s : %s%s</li>\n",
				json_editor_key_name_input( val_name ), json_editor_key_value_input( this_val ), json_editor_remove_html( options ) );
		}
		else{
			alert( typeof this_val );
		}
		return content;
	}

	function json_editor_remove_html( options ){
		if( options.enable_remove ){
			return " <span class=\"json_remove json_non_sortable\">(remove)</span>";
		}
		return '';
	}

	function json_editor_ul2json( jelem ){

		if( jelem.children( "li" ).length == 0 ){
			return {};
		}

		var new_val = { }, tmp_val;

		jelem.children( "li" ).each( function( ){
			var val_type = jQuery( this ).attr( "json_val_type" ).toUpperCase( );

			if( val_type == 'INT' ){
				tmp_val = parseInt( jQuery( this ).children( ".json_key_value" ).val( ) );
				if( isNaN( tmp_val ) ){
					tmp_val = 0;
				}
				new_val[ jQuery( this ).children( ".json_key_name" ).val( ) ] = tmp_val;
			}
			else if( val_type == 'DOUBLE' ){
				tmp_val = parseFloat( jQuery( this ).children( ".json_key_value" ).val( ) );
				if( isNaN( tmp_val ) ){
					tmp_val = 0;
				}
				new_val[ jQuery( this ).children( ".json_key_name" ).val( ) ] = tmp_val;
			}
			else if( val_type == 'STRING' ){
				new_val[ jQuery( this ).children( ".json_key_name" ).val( ) ] = jQuery( this ).children( ".json_key_value" ).val( ) ;
			}
			else if( val_type == 'BOOL' ){
				tmp_val = jQuery( this ).children( ".json_key_value" ).val( );
				if( tmp_val.toLowerCase( ) == 'false' || tmp_val == '0' || tmp_val.length == 0 ){
					tmp_val = false;
				} else{
					tmp_val = new Boolean( tmp_val );
				}
				new_val[ jQuery( this ).children( ".json_key_name" ).val( ) ] = tmp_val;
			}
			else if( val_type == 'ARRAY' ){
				tmp_val = json_editor_ul2json( jQuery( jQuery( this ).children( "ul" ).get( 0 ) ) );
				new_val[ jQuery( jQuery( this ).children( ".json_key_name" ).get( 0 ) ).val( ) ] = tmp_val;
			}

		} );
		return new_val ;
	}

	function json_editor_key_name_input( key_name ){
		return sprintf( "<input type=\"text\" class=\"json_key_name\" value=\"%s\" size=\"20\" />", key_name );
	}
	function json_editor_key_value_input( key_value ){
		return sprintf( "<input type=\"text\" class=\"json_key_value\" value=\"%s\" size=\"20\" />", key_value );
	}

} )( jQuery );

(function(jQuery) {
	jQuery.fn.val_equal = function( search_key ){
	
		var match_list = [];
		this.map( function( index, elem ){
			if( jQuery( elem ).val() == search_key ){
				match_list.push( elem );
			}
		} );
		return jQuery( match_list ) ;
	}

}(jQuery));
