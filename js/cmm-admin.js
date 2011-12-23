/**
 *  Select to slider
 *
 *  jQuery UI

jQuery(function(){
	jQuery('.wp-cmm_options_maxzoom').selectToUISlider().hide();
});
 */
jQuery(document).ready(function($) {


		/**
		 *  Global helper functions
		 */

		// change disabled-state of dependent formfields
		$.fn.disableFormField = function ( options ) {
		    var defaults = {
		      status:     true,
		    };
		    // Overwrite default options with user provided ones
		    var options = $.extend({}, defaults, options);
		    if ( options.status  === false ) {
		        $( this ).removeAttr('disabled');
		    } else {
		        $( this ).attr('disabled', true);
		        $( this ).removeAttr('checked');
		    }
		}

		// helper to check existence of given object and property
		$.fn.exists = function ( obj, prop ) {
				if ( obj !== null && obj.hasOwnProperty( prop ) ){
						if (  obj.prop != ''	)
						{ return true; }
				}
		    return false;
		}



		/**
		 *
		 *  General Options
		 *
		 */
		if ( $('.wrap').is('#CMM_general_settings')  ) {

			  // check that an API key exists, to enable the checkboxes of the pluginparts
			  // on change
		    $('#api_key').live('change', function() {
		        if ( $(this).val() ) {
		            $('#pp_static').disableFormField( { status: false } );
		            $('#pp_active').disableFormField( { status: false } );
		        } else {
		            $('#pp_static').disableFormField();
		            $('#pp_widget').disableFormField();
		            $('#pp_active').disableFormField();
		        }
		    });
		    // on page load
			  $(function() {
		        if ( $('#api_key').val() ) {
		            $('#pp_static').disableFormField( { status: false } );
		            $('#pp_active').disableFormField( { status: false } );
		        } else {
		            $('#pp_static').disableFormField();
		            $('#pp_widget').disableFormField();
		            $('#pp_active').disableFormField();
		        }
		    });

			  // check that "static maps pluginpart is active, to make the widget work
			  // on change
		    $('#pp_static').live('change', function() {
		        if ( $(this).is( ':checked' ) ) {
		            $('#pp_widget').disableFormField( { status: false } );
		        } else {
		            $('#pp_widget').disableFormField();
		        }
		    });
		    // on page load
			  $(function() {
		        if ( $('#pp_static').is( ':checked' ) ) {
		            $('#pp_widget').disableFormField( { status: false } );
		        } else {
		            $('#pp_widget').disableFormField();
		        }
		    });

        $.fn.get_default_adress = function ( flickr_places_api_key ) {
        
        		window['CMM_geo_lib'].flickr_places_api_key =  flickr_places_api_key;
        
						if (
									$('#wp-cmm_options_general_da_street').val() == '' &&
									$('#wp-cmm_options_general_da_zip').val() == '' &&
									$('#wp-cmm_options_general_da_city').val() == '' &&
									$('#wp-cmm_options_general_da_region').val() == '' &&
									$('#wp-cmm_options_general_da_region_code').val() == '' &&
									$('#wp-cmm_options_general_da_country').val() == ''
						) {

								yqlgeo.get( 'visitor' ,function(o){
 //	console.log( o );
										if ( typeof o.error != 'object' ) {


										var loc = o.place;


						/*
										if ( typeof loc.centroid.longitude != 'undefined' && loc.centroid.longitude != '' ) {
						        		$('#wp-cmm_options_general_da_street').val(  );
										}
						*/
										if ( $.fn.exists ( loc.postal, "content" ) ) {
						        		$('#wp-cmm_options_general_da_zip').val( loc.postal.content );
										}

										if ( $.fn.exists ( loc.locality1, "content" ) ) {
						        		$('#wp-cmm_options_general_da_city').val( loc.locality1.content );
										}

										if ( $.fn.exists ( loc.admin1, "content" ) ) {
						        		$('#wp-cmm_options_general_da_region').val( loc.admin1.content );
										}

										if ( $.fn.exists ( loc.admin1, "code" ) ) {
						        		$('#wp-cmm_options_general_da_region_code').val( loc.admin1.code );
										}

										if ( $.fn.exists ( loc.country, "content" ) ) {
						        		$('#wp-cmm_options_general_da_country').val( loc.country.content );
										}

										if ( $.fn.exists ( loc.centroid, "latitude" ) ) {
						        		$('#wp-cmm_options_general_da_lat').val( loc.centroid.latitude );
										}

										if ( $.fn.exists ( loc.centroid, "longitude" ) ) {
						        		$('#wp-cmm_options_general_da_lng').val( loc.centroid.longitude );
										}
										
										}
										
								});
						} else {

						    var fieldsToLook = [
										"#wp-cmm_options_general_da_street",
										"#wp-cmm_options_general_da_zip",
										"#wp-cmm_options_general_da_city",
										"#wp-cmm_options_general_da_region",
										"#wp-cmm_options_general_da_region_code",
										"#wp-cmm_options_general_da_country"
								];

								var f = fieldsToLook.join(", ");

								$( f ).focusout( function() {

										var adrToSearchFor ='';
										$( fieldsToLook ).each(function( i ) {
												if ( $( fieldsToLook[i] ).val() != '' && typeof $( fieldsToLook[i] ).val() != 'undefined' ) {
														adrToSearchFor += $( fieldsToLook[i] ).val() + ', ';
												}
										});

										// Find the latlng by given adr
										yqlgeo.get( adrToSearchFor ,function(o){

										    var loc = o.place.centroid;
												if ( $.fn.exists ( loc, "latitude" ) ) {
								        		$('#wp-cmm_options_general_da_lat').val( loc.latitude );
												}

												if ( $.fn.exists ( loc, "longitude" ) ) {
								        		$('#wp-cmm_options_general_da_lng').val( loc.longitude );
												}
										});

								} );
						} // else
				}  // $.fn.get_default_adress
				
        $("#wp-cmm_options_general_flickr_places_api_key").live("change", function(event){
      			$.fn.get_default_adress( $("#wp-cmm_options_general_flickr_places_api_key").val() );
				});

				// Find the user (using the W3C geolocation API and IP as a fallback)
				if ( typeof CMM_geo_lib != 'undefined' && typeof CMM_geo_lib.flickr_places_api_key != 'undefined' && CMM_geo_lib.flickr_places_api_key != '' ) {
      			$.fn.get_default_adress( CMM_geo_lib.flickr_places_api_key );
				}
				
		} // is('#CMM_general_settings')



		/**
		 *
		 *  Static Maps Options
		 *
		 */

		if ( $('.wrap').is('#CMM_staticmaps_settings')  ) {
		    // open wp mediamanagement
		  	$('.wp-cmm_call-wp-mediamanagement').click(function() {
		    	 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		    	 return false;
		  	});

		    // give img infos to current settingspage
		  	window.send_to_editor = function(html) {
		    	 $('.wp-cmm_options_marker_icon').val( $(html).find('img').attr('src') );
		    	 tb_remove();
		  	}

				// Center the Example Map to the 200 x 200px preview window
				$('.admin-example-map > div').css('margin-top', -($('#wp-cmm_options_static_height').val() - 200) / 2 ).css('margin-left',  -($('#wp-cmm_options_static_width').val() - 200) / 2 );

		}



		/**
		 *
		 *  Interactive Maps Options
		 *
		 */

		if ( $('.wrap').is('#CMM_activemaps_settings')  ) {

		    // open wp mediamanagement
		  	$('.wp-cmm_call-wp-mediamanagement').click(function() {
		    	 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		    	 return false;
		  	});

		    // give img infos to current settingspage
		  	window.send_to_editor = function(html) {
		    	 imgurl    = $(html).find('img').attr('src');
		    	 imgwidth  = $(html).find('img').attr('width');
		    	 imgheight = $(html).find('img').attr('height');
		    	 $('.wp-cmm_options_marker_icon').val(imgurl);
		    	 $('.wp-cmm_options_marker_icon_width').val(imgwidth);
		    	 $('.wp-cmm_options_marker_icon_height').val(imgheight);
		    	 tb_remove();
		  	}
		  	
			  // check that minzoom is 0 or 1, to make the overview-control work
			  $('#wp-cmm_options_active_minzoom').live('change', function() {
		        if ( $(this).val() == 0 || $(this).val() == 1 ) {
		            $('#wp-cmm_options_active_overview').disableFormField( { status: false } );
		        } else {
		            $('#wp-cmm_options_active_overview').disableFormField();
		        }
		    });
			  $(function() {
		        if ( $('#wp-cmm_options_active_minzoom').val() == 0 || $('#wp-cmm_options_active_minzoom').val() == 1 ) {
		            $('#wp-cmm_options_active_overview').disableFormField( { status: false } );
		        } else {
		            $('#wp-cmm_options_active_overview').disableFormField();
		        }
		    });


			  // check that minzoom is smaller than zoom and this is smaller than maxzoom
		    $('#wp-cmm_options_active_minzoom, #wp-cmm_options_active_zoom, #wp-cmm_options_active_maxzoom').live('focusin change', function(e) {
		        if (e.type == 'focusin') {
		      	      current_value =  $(this).val();
		        } else {
		              if (  parseInt( $('#wp-cmm_options_active_minzoom').val() ) <=  parseInt( $('#wp-cmm_options_active_zoom').val() )
		                    &&
		                    parseInt( $('#wp-cmm_options_active_zoom').val() ) <=  parseInt( $('#wp-cmm_options_active_maxzoom').val() )
		                 ) {
		                  //console.log('erlaubt');
		                  current_value =  $(this).val();
		                  //$('#map_zoom_control_error').fadeOut('slow');
		              } else {
		                  //console.log('verboten');
		                  $(this).val( current_value );
		                  //$('#map_zoom_control_error').fadeIn('slow');
		              }
		        }
		    });

				// Center the Example Map to the 200 x 200px preview window
				$('.admin-example-map > div').css('margin-top', -($('#wp-cmm_options_active_height').val() - 200) / 2 ).css('margin-left',  -($('#wp-cmm_options_active_width').val() - 200) / 2 );

				// Find the user (using the W3C geolocation API and IP as a fallback)
				if ( typeof CMM_geo_lib != 'undefined' && typeof CMM_geo_lib.flickr_places_api_key != 'undefined' && CMM_geo_lib.flickr_places_api_key != '' ) {
						yqlgeo.get('visitor',function(o){

								$('.wml-container').remove();

								var cid = 'cmm-active-single-map-id-0_1';
								var id = 'CMM_0_1';

								// overwrite defaults
								window[id].lat  = o.place.centroid.latitude;
								window[id].lng  = o.place.centroid.longitude;
								window[id].marker[0][0]  = o.place.centroid.latitude;
								window[id].marker[0][1]  = o.place.centroid.longitude;

								// create map
								$.fn.CloudMadeMap ( cid, window[id] );
						});
				}
		}





		/**
		 *
		 *  Post Edit Screen
		 *
		 */
		if ( $('body').is('.post-new-php, .post-php') ) {

				$("input#publish").click(function( e ) {
						if ( $( '#content_ifr').contents().find('.wp-cmm_placeholderImage')
									&& ( $('#cmm_post_meta_lat').val() == '' || $('#cmm_post_meta_lng').val() == '' ) ) {
								e.preventDefault();
								$('img#ajax-loading').hide();
								$("input#publish").removeClass('button-primary-disabled');
								$('#wp-cmm_reminder-to-choose-location').show('slow');
						}
				});

				$(".meta-box-sortables #cmm_chose_location").mouseenter(function() {
						CM.Event.addListener(wp_cmm_map, 'click', function( latlng ) {
								wp_cmm_map._overlays[0].setLatLng( latlng );
								wp_cmm_map._overlays[1].setLatLng( latlng );
								$.fn.refreshCoordInputs ( latlng, 'cmm_post_meta' );
						});
				});


				if ( typeof CMM_geo_lib != 'undefined' && typeof CMM_geo_lib.flickr_places_api_key != 'undefined' && CMM_geo_lib.flickr_places_api_key != '' ) {

						var pid = $('#post_ID').val();
						var cid = 'cmm-active-single-map-id-'+pid+'_1';
						var id = 'CMM_'+pid+'_1';

						if ( $('#cmm_post_meta_lat').val() == '' || $('#cmm_post_meta_lng').val() == '' ) {

								// Find the user (using the W3C geolocation API and IP as a fallback)
								yqlgeo.get('visitor',function(o){
		 								/*  	*/
										$('.wml-container').remove();

										// overwrite defaults
										window[id].lat  = o.place.centroid.latitude;
										window[id].lng  = o.place.centroid.longitude;
										window[id].marker[0][0]  = o.place.centroid.latitude;
										window[id].marker[0][1]  = o.place.centroid.longitude;

										// create map
										$.fn.CloudMadeMap ( cid, window[id] );

								});
						
						}

						// find lat and lng by given adress and move map-marker
						$(".meta-box-sortables #cmm_chose_location #cmm_find_location_on_map").click(function( ) {

								var fieldsToLook = [
										"#cmm_post_meta_street",
										"#cmm_post_meta_zip",
										"#cmm_post_meta_city",
										"#cmm_post_meta_region",
										"#cmm_post_meta_region_code",
										"#cmm_post_meta_country"
								];

								//								var f = fieldsToLook.join(", ");

								//								$( f ).focusout( function() {

										var adrToSearchFor ='';
										$( fieldsToLook ).each(function( i ) {
												if ( $( fieldsToLook[i] ).val() != '' && typeof $( fieldsToLook[i] ).val() != 'undefined' ) {
														adrToSearchFor += $( fieldsToLook[i] ).val() + ', ';
												}
										});
								//console.log(adrToSearchFor);
										// Find the latlng by given adr
										yqlgeo.get( adrToSearchFor ,function(o){
								//console.log(o);
										    var loc = o.place;
												if ( $.fn.exists ( loc.centroid, "latitude" ) && $.fn.exists ( loc.centroid, "longitude" ) ) {

								        		$('#cmm_post_meta_lat').val( loc.centroid.latitude );
								        		$('#cmm_post_meta_lng').val( loc.centroid.longitude );

														var coords = new CM.LatLng( loc.centroid.latitude, loc.centroid.longitude )

														wp_cmm_map.panTo( coords )

														wp_cmm_map._overlays[0].setLatLng( coords );
														wp_cmm_map._overlays[1].setLatLng( coords );
												}

												if ( $.fn.exists ( loc.postal, "content" ) && $('#cmm_post_meta_zip').val() == ''  ) {
								        		$('#cmm_post_meta_zip').val( loc.postal.content );
												}

												if ( $.fn.exists ( loc.locality1, "content" ) && $('#cmm_post_meta_city').val() == ''  ) {
								        		$('#cmm_post_meta_city').val( loc.locality1.content );
												}

												if ( $.fn.exists ( loc.admin1, "content" ) && $('#cmm_post_meta_region').val() == ''  ) {
								        		$('#cmm_post_meta_region').val( loc.admin1.content );
												}

												if ( $.fn.exists ( loc.admin1, "code" ) && $('#cmm_post_meta_region_code').val() == ''  ) {
								        		$('#cmm_post_meta_region_code').val( loc.admin1.code );
												}

												if ( $.fn.exists ( loc.country, "content" ) && $('#cmm_post_meta_country').val() == '' ) {
								        		$('#cmm_post_meta_country').val( loc.country.content );
												}

										});

								//								} );

						});
				}
		}
     



		$.fn.refreshCoordInputs = function( latlng, formFieldSuffix ) {

				if ( typeof CMM_geo_lib.flickr_places_api_key == 'undefined' || CMM_geo_lib.flickr_places_api_key == '' ) {
				    return false }

				$('#' + formFieldSuffix + '_lat').val( latlng._lat );
				$('#' + formFieldSuffix + '_lng').val( latlng._lng );

				var cmm_id = 'CMM_' + $('#post_ID').val() + '_1';

				if ( typeof icl_lang == 'undefined' ){
				    var icl_lang = $('html').attr('lang').substr(0,2);
				}


				$('#cmm_choose_location_legend input:not("#' + formFieldSuffix + '_lat, #' + formFieldSuffix + '_lng, #cmm_find_location_on_map")').addClass('waiting');

				// Find the user (using the W3C geolocation API and IP as a fallback)
				yqlgeo.get( [  latlng._lat, latlng._lng ] ,function(o){

				    var loc = o.place;

						if ( $.fn.exists ( loc.postal, "content" ) ) {
		        		$('#' + formFieldSuffix + '_zip').val( loc.postal.content ).removeClass('waiting');
						} else {
		        		$('#' + formFieldSuffix + '_zip').val( '' ).removeClass('waiting');
						}

						if ( $.fn.exists ( loc.locality1, "content" ) ) {
		        		$('#' + formFieldSuffix + '_city').val( loc.locality1.content ).removeClass('waiting');
						} else {
		        		$('#' + formFieldSuffix + '_city').val( '' ).removeClass('waiting');
						}

						if ( $.fn.exists ( loc.admin1, "content" ) ) {
		        		$('#' + formFieldSuffix + '_region').val( loc.admin1.content ).removeClass('waiting');
						} else {
		        		$('#' + formFieldSuffix + '_region').val( '' ).removeClass('waiting');
						}

						if ( $.fn.exists ( loc.admin1, "code" ) ) {
		        		$('#' + formFieldSuffix + '_region_code').val( loc.admin1.code ).removeClass('waiting');
						} else {
		        		$('#' + formFieldSuffix + '_region_code').val( '' ).removeClass('waiting');
						}

						if ( $.fn.exists ( loc.country, "content" ) ) {
		        		$('#' + formFieldSuffix + '_country').val( loc.country.content ).removeClass('waiting');
						} else {
		        		$('#' + formFieldSuffix + '_country').val( '' ).removeClass('waiting');
						}

				});

		    var geocoder = new CM.Geocoder( cmm_base.key );
				// street
				geocoder.getLocations( latlng , function(response) {
		        if ( typeof response.features != 'undefined' ){
								var loc = response.features[0].properties;
								if ( typeof loc["name"+":"+icl_lang] != 'undefined' ) {
										$('#' + formFieldSuffix + '_street').val( loc["name"+":"+icl_lang] ).removeClass('waiting');
								} else {
										$('#' + formFieldSuffix + '_street').val( loc["name"] ).removeClass('waiting');
								}
		        } else {
				        $('#' + formFieldSuffix + '_street').val( '' ).removeClass('waiting');
						}
				}, {distance: 'closest', objectType: 'road' } );
		  	return;
		}

}); // end jQuery