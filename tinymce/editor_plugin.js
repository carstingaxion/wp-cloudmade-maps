/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	tinymce.create('tinymce.plugins.CloudmadeMap', {
		init : function(ed, url) {

			ed.addCommand('mceCMM', function() {
/*			var vp = tinymce.DOM.getViewPort(),
					H = vp.h - 80, W = ( 640 < vp.w ) ? 640 : vp.w;
//				tb_show( ed.getLang('cloudmademap.buttontitle'), '#TB_inline?inlineId=cmm_tinymce_addshortcode_form&tab=wp-cmm_tiny_static&width='+W+'&height='+H);
*/
				ed.windowManager.open({
					id : 'cmm_tinymce_addshortcode_form',
					width : 600,
					height : "auto",
					wpDialog : true,
					title : ed.getLang('cloudmademap.buttontitle')
				}, {
					plugin_url : url
				});

			});

			// Register buttons
			ed.addButton('cloudmademap', {
				title : 'cloudmademap.buttontitle',
				cmd : 'mceCMM',
				image : url + '/../img/CMM_16.png'
			});
		},

		getInfo : function() {
			return {
				longname : 'WP Cloudmade Maps',
				author : 'Carsten Bach',
				authorurl : 'http://carsten-bach.de',
				infourl : '',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('cloudmademap', tinymce.plugins.CloudmadeMap);
	
		// executes this when the DOM is ready
/*
jQuery.fn.wpcmm_tiny_init = function () {
		jQuery('body').css('overflow', 'hidden');
}
console.log(tinyMCEPopup);

tinyMCEPopup.executeOnLoad( jQuery('body').css('overflow', 'hidden') );
*/
	jQuery(function(){
/*
jQuery("#cmm_tinymce_addshortcode_form:visible").hover(
  function () {
    jQuery('body').css('overflow', 'hidden');
  },
  function () {
    jQuery('body').css('overflow', 'visible');
  }
);

		if ( jQuery('#cmm_tinymce_addshortcode_form').is(":visible") ) {
    		jQuery('body').css('overflow', 'hidden');
    } else {
    		jQuery('body').css('overflow', 'visible');
    }
*/
		// generate jQuery UI Tabs for different shortcode-forms
		jQuery( "#cmm_tinymce_addshortcode_form" ).tabs();
		
		//
		 jQuery('#wp-cmm_tiny_group_tags').suggest("/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=post_tag", {multiple:true, multipleSep: ", ", resultsClass: 'wp-cmm_tiny_tag_suggest'});
		
		// reposition the dialog box to fit the screen
		jQuery( "#cmm_tabs_navi a" ).click( function(){

				jQuery( '#cmm_tinymce_addshortcode_form' ).css('height', 'auto' );
        var dialogBox = jQuery( '#cmm_tinymce_addshortcode_form' ).parent();

				var vph = tinymce.DOM.getViewPort().h;
				var dbh = jQuery( dialogBox ).height();
				if ( vph > dbh ) {
						var	top = ( vph - dbh ) / 2;
						jQuery( dialogBox ).css('top', top + 'px' );
				} else {
						var newdbh = vph - 80;
						var	top = ( vph - newdbh ) / 2;
						jQuery( '#cmm_tinymce_addshortcode_form' ).css('height', newdbh + 'px' );
						jQuery( dialogBox ).css('top', top + 'px' );
            jQuery("#login").focus();
				}
		});

		//
		jQuery( "#cmm_tinymce_addshortcode_form .toggle-arrow" ).click( function(){
      	jQuery( this ).toggleClass( 'toggle-active' );
				jQuery( this ).next().toggle();
				jQuery( "#cmm_tabs_navi a[href='#" + jQuery( this ).parent().attr('id') + "']" ).trigger('click');

		});

		// bind close-handler to "Cancel"-Link
		jQuery('.cmm-cancel .submitdelete').click( function() { tinyMCEPopup.close(); } );

		// add changed-class to all inputs with non-default values
		jQuery('#cmm_tinymce_addshortcode_form input, #cmm_tinymce_addshortcode_form select').live( 'change', function () {

				if ( jQuery( this ).is('[type="radio"]') ){
						jQuery("[name='"+ jQuery( this ).attr('name') +"']").removeClass('changed');
				}
				jQuery( this ).addClass('changed');
		} );

		// handles the click event of the submit button
		jQuery('#cmm_tinymce_addshortcode_form .button-primary').click(function(){

/**
				var shortcode = '[cmm_' + jQuery(this).attr('id');

				jQuery('#wp-cmm_tiny_' + jQuery(this).attr('id') + ' .changed').each(function( ) {
							shortcode += ' ' + jQuery(this).attr('name') + '="' + jQuery(this).val() + '"';
				});

				shortcode += ']';

				// inserts the shortcode into the active editor
				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
**/

				var shortcode = 'cmm_' + jQuery(this).attr('id');

				jQuery('#wp-cmm_tiny_' + jQuery(this).attr('id') + ' .changed').each(function( ) {

						// strip tiny_static[], tiny_active[] and tiny_group[] from name-Attributes
						// http://txt2re.com/index-javascript.php3?s=tiny_static[align]&5

			      var txt= jQuery(this).attr('name');

			      var re1='.*?';	// Non-greedy match on filler
			      var re2='(?:[a-z][a-z0-9_]*)';	// Uninteresting: var
			      var re3='.*?';	// Non-greedy match on filler
			      var re4='((?:[a-z][a-z0-9_]*))';	// Variable Name 1

			      var p = new RegExp(re1+re2+re3+re4,["i"]);
			      var m = p.exec(txt);

						shortcode += ' ' + m[1] + '=\'' + jQuery(this).val() + '\'';
				});

				var width = jQuery('#wp-cmm_tiny_' + jQuery(this).attr('id') + ' .wp-cmm_tiny_width').val();
				var height = jQuery('#wp-cmm_tiny_' + jQuery(this).attr('id') + ' .wp-cmm_tiny_height').val();
				var align = 'align' + jQuery('#wp-cmm_tiny_' + jQuery(this).attr('id') + ' .wp-cmm_align input:checked').val();

//				var map_placeholder_image = '<img src="/wp-content/plugins/cbach-Cloudmade-map/img/b.gif" width="' + width + '" height="' + height + '" class="wp-cmm_placeholderImage ' + align + '" title="' + shortcode + '" />';
				var map_placeholder_image = '<img src="/wp-includes/js/tinymce/plugins/wpgallery/img/t.gif" width="' + width + '" height="' + height + '" class="wp-cmm_placeholderImage ' + align + ' mceItem" title="' + shortcode + '" />';
//				var map_placeholder_image = '<div style="width:' + width + 'px; height:' + height + 'px;" class="wp-cmm_placeholderImage ' + align + '" title="' + shortcode + '" />';
//				var map_placeholder_image = '<p style="width:' + width + 'px; height:' + height + 'px;" class="wp-cmm_placeholderImage ' + align + '" title="' + shortcode + '" >[' + shortcode + ']</p>';

				// inserts the shortcode into the active editor
				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, map_placeholder_image);
				// closes dialog
				tinyMCEPopup.close();
		});
		
		
	});
})()