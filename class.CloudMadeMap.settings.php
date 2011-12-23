<?php

function get_dynamic_settings_options ( $type ) {
		global $wp_version;
		$options = array();

		switch ( $type ) {

				case 'categories' :
						$args=array(
						  'hide_empty'  => false,
						  'orderby'     => 'count'
						);
				    foreach ( get_categories( $args ) as $category) {
								$options[''.$category->cat_ID.''] = $category->cat_name;
						}
				    break;

				case 'users' :
						if ( version_compare ( $wp_version, '3.1.0', ">" ) ) {
								foreach ( get_users() as $user) {
										$options[''.$user->ID.''] = $user->display_name;
								}
						} else {
								// use 3.0. fallback
								foreach ( get_users_of_blog() as $user) {
										$options[''.$user->ID.''] = $user->display_name;
								}
						}
						break;

				case 'posttypes' :
						$args=array(
						  'public'   => true,
						);
						$output = 'objects';
				    foreach ( get_post_types( $args, $output ) as $post_type) {
				        if ( $post_type->name != 'attachment' )
								$options[''.$post_type->name.''] = $post_type->label;
						}
				    break;
		}

		return  $options;
}


$this->defined_general_opts = array(
		'api_key'	=> array(
			'label'		=> __('Cloudmade API Key', self::LANG ),
			'desc'		=> sprintf( __('Sign up for your personal API key <a href="%s">here</a>', self::LANG), 'http://developers.cloudmade.com/projects/show/web-maps-studio'),
			'type'		=> 'text',
			'value' 	=> $this->general_opts['api_key'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
			'class'   => 'regular-text',
		),
		'style_ID'	=> array(
			'label'		=> __('Cloudmade Style ID', self::LANG ),
			'desc'		=> sprintf( __('Copy from Cloudmade <a href="%s">Style editor</a> or leave blank for default style.', self::LANG), 'http://maps.cloudmade.com/editor'),
			'type'		=> 'text',
			'value' 	=> $this->general_opts['style_ID'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'flickr_places_api_key'	=> array(
			'label'		=> __('flickr Places API Key', self::LANG ),
			'desc'		=> __( 'Needed for geo-locating and reverse geo-coding.', self::LANG ).' '.sprintf( __('Sign up for your personal API key <a href="%s">here</a>', self::LANG), 'http://www.flickr.com/services/apps/create/apply/'),
			'type'		=> 'text',
			'value' 	=> $this->general_opts['flickr_places_api_key'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
			'class'   => 'regular-text',
		),
		'plugin-parts-row' => array(
			'label'		=> __('Plugin Parts', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 3,
			'usage'   => array( 'options_' ),
		),
		'pp_static'	=> array(
			'label'		=> __('Static Maps', self::LANG ),
			'desc'		=> __('Is needed to use the widget', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['pp_static'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'pp_widget'	=> array(
			'label'		=> __('Sidebar Widget', self::LANG ),
			'desc'		=> __('show static maps of last geotagged posts', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['pp_widget'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'pp_active'	=> array(
			'label'		=> __('Interactive Maps', self::LANG ),
			'desc'		=> false,
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['pp_active'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'posttypes'	=> array(
			'label'		=> __('Post Types', self::LANG ),
			'desc'		=> __( 'Choose the post types, where to add the "Choose location" meta box on the edit screen.', self::LANG ),
			'type'		=> 'terms_checklist',
			'value' 	=> $this->general_opts['posttypes'],
			'usage'   => array( 'options_' ),
			'validate'=> 'terms_checklist',
			'validate_msg'  => false,
			'options' => get_dynamic_settings_options ( 'posttypes' ),
		),
/*
		'default_adress'	=> array(
			'label'		=> __( 'Default Address', self::LANG ),
			'desc'		=> __( 'Please enter at least longitude and latitude to define a fallback-adress.', self::LANG ),
			'type'		=> 'multiple_input',
			'value' 	=> false,
			'usage'   => array( 'options_' ),
			'validate'=> 'multiple_input',
			'validate_msg'  => false,
			'options' => array(
					'da_street' => array( __( 'Street', self::LANG ), $this->general_opts['da_street'] ),
			),
		),
*/
		'default_adress-row' => array(
			'label'		=> __('Default Address', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 8,
			'usage'   => array( 'options_' ),
		),
		'da_street'	=> array(
			'label'		=> __('Street', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_street'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
		),
		'da_zip'	=> array(
			'label'		=> __('Postal Code', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_zip'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'da_city'	=> array(
			'label'		=> __('City', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_city'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
		),
		'da_region'	=> array(
			'label'		=> __('Region', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_region'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
		),
		'da_region_code'	=> array(
			'label'		=> __('Code', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_region_code'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'da_country'	=> array(
			'label'		=> __('Country', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_country'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
		),
		'da_lat'	=> array(
			'label'		=> __('Latitude', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_lat'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'da_lng'	=> array(
			'label'		=> __('Longitude', self::LANG ),
			'desc'		=> false,
			'type'		=> 'text',
			'value' 	=> $this->general_opts['da_lng'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'add-geo-markup-row' => array(
			'label'		=> __('Add Geo-Markup', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 2,
			'usage'   => array( 'options_' ),
		),
		'add_meta_tag'	=> array(
			'label'		=> sprintf ( __('Add geo meta-tags to %1$s of every post and page', self::LANG), '<code>&lt;head&gt;</code>' ),
			'desc'		=> false,
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['add_meta_tag'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'add_microformat_geo_tag'	=> array(
			'label'		=> sprintf ( __('Add microformat geo-tags to %1$s of every post and page', self::LANG), '<code>the_content()</code>' ),
			'desc'		=> sprintf ( __( 'The rendered markup is visually hidden with %1$s', self::LANG ), '<abbr title="Cascading Stylesheets">CSS</abbr>'),
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['add_microformat_geo_tag'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'db-options-row' => array(
			'label'		=> __('Database Options', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_' ),
		),
		'chk_default_options_db'	=> array(
			'label'		=> __('Restore defaults upon plugin deactivation/reactivation', self::LANG ),
			'desc'		=> __('Only check this if you want to reset plugin settings upon Plugin reactivation', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->general_opts['chk_default_options_db'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
);



$this->defined_static_opts = array(
		'map-size-row' => array(
			'label'		=> __('Map size', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 2,
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
		),
		'width'	=> array(
			'label'		=> __('Width', self::LANG ),
			'desc'		=> __('in px', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->static_opts['width'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'height'	=> array(
			'label'		=> __('Height', self::LANG ),
			'desc'		=> __('in px', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->static_opts['height'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'zoom'	=> array(
			'label'		=> __('Zoom level', self::LANG ),
			'desc'		=> false,
			'type'		=> 'select',
			'value' 	=> $this->static_opts['zoom'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
			    '0' 	=>  '0',
			    '1'   =>  '1 = '.__('Region',self::LANG),
			    '2' 	=>  '2',
			    '3' 	=>  '3',
			    '4' 	=>  '4',
			    '5' 	=>  '5 = '.__('Country',self::LANG),
			    '6' 	=>  '6',
			    '7' 	=>  '7',
			    '8' 	=>  '8',
			    '9' 	=>  '9 = '.__('County',self::LANG),
			    '10' 	=>  '10',
			    '11' 	=>  '11',
			    '12' 	=>  '12',
			    '13' 	=>  '13 = '.__('Neighborhood',self::LANG),
			    '14' 	=>  '14',
			    '15' 	=>  '15',
			    '16' 	=>  '16',
			    '17' 	=>  '17 = '.__('Building',self::LANG),
			    '18' 	=>  '18',
			),
		),
		'marker_icon'	=> array(
			'label'		=> __('Marker Icon', self::LANG ),
			'desc'		=> __('Enter an URL or upload an image for the markericon.', self::LANG),
			'type'		=> 'upload',
			'value' 	=> $this->static_opts['marker_icon'],
			'usage'   => array( 'options_' ),
			'validate'=> 'url',
			'validate_msg'  => false,
			'class'   => 'regular-text',
		),
		'bg_element'	=> array(
			'label'		=> __('Background Element(s)', self::LANG ),
			'desc'		=> __('HTML Element, #ID- or .class-Name, where to add the background-image, e.g. <code>html</code>, <code>#wrapper</code> or multiple elements like <code>body, #wrapper</code>', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->static_opts['bg_element'],
			'usage'   => array( 'options_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
		),
		'align'	=> array (
			'label' 	=> __( 'Alignment' ),
			'desc'		=> false,
			'type'		=> 'radio',
			'value' 	=> $this->static_opts['align'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
					'none' 	=> __( 'None' ),
					'left' 	=> __( 'Left' ),
					'center'=> __( 'Center' ),
					'right' => __( 'Right' ),
			)
		),
		'adress-caption-row' => array(
			'label'		=> __('Show Adress', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_', 'tiny_', 'widget_' ),
		),
		'caption'	=> array(
			'label'		=> __('Show address as caption of the map', self::LANG ),
			'desc'		=> false,
			'type'		=> 'checkbox',
			'value' 	=> $this->static_opts['caption'],
			'usage'   => array( 'options_', 'tiny_', 'widget_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'example-row' => array(
			'label'		=> __('Example', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_' ),
		),
		'show_example'	=> array(
			'label'		=> __('Show example map with default configuration', self::LANG ),
			'desc'		=> __('Is shown only on this page, centered to your current position', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->static_opts['show_example'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'db-options-row' => array(
			'label'		=> __('Database Options', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_' ),
		),
		'chk_default_options_db'	=> array(
			'label'		=> __('Restore defaults upon plugin deactivation/reactivation', self::LANG ),
			'desc'		=> __('Only check this if you want to reset plugin settings upon Plugin reactivation', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->static_opts['chk_default_options_db'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
);




$this->defined_active_opts = array(
		'map-size-row' => array(
			'label'		=> __('Map size', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 2,
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
		),
		'width'	=> array(
			'label'		=> __('Width', self::LANG ),
			'desc'		=> __('in px or percent', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->active_opts['width'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'height'	=> array(
			'label'		=> __('Height', self::LANG ),
			'desc'		=> __('in px', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->active_opts['height'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'zoomlevel-row' => array(
			'label'		=> __('Zoom level', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 3,
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
		),
		'minzoom'	=> array(
			'label'		=> __('Minimum zoom level', self::LANG ),
			'desc'		=> false,
			'type'		=> 'select',
			'value' 	=> $this->active_opts['minzoom'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
			    '0' 	=>  '0',
			    '1'   =>  '1 = '.__('Region',self::LANG),
			    '2' 	=>  '2',
			    '3' 	=>  '3',
			    '4' 	=>  '4',
			    '5' 	=>  '5 = '.__('Country',self::LANG),
			    '6' 	=>  '6',
			    '7' 	=>  '7',
			    '8' 	=>  '8',
			    '9' 	=>  '9 = '.__('County',self::LANG),
			    '10' 	=>  '10',
			    '11' 	=>  '11',
			    '12' 	=>  '12',
			    '13' 	=>  '13 = '.__('Neighborhood',self::LANG),
			    '14' 	=>  '14',
			    '15' 	=>  '15',
			    '16' 	=>  '16',
			    '17' 	=>  '17 = '.__('Building',self::LANG),
			    '18' 	=>  '18',
			),
		),
		'zoom'	=> array(
			'label'		=> __('Start zoom level', self::LANG ),
			'desc'		=> false,
			'type'		=> 'select',
			'value' 	=> $this->active_opts['zoom'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
			    '0' 	=>  '0',
			    '1'   =>  '1 = '.__('Region',self::LANG),
			    '2' 	=>  '2',
			    '3' 	=>  '3',
			    '4' 	=>  '4',
			    '5' 	=>  '5 = '.__('Country',self::LANG),
			    '6' 	=>  '6',
			    '7' 	=>  '7',
			    '8' 	=>  '8',
			    '9' 	=>  '9 = '.__('County',self::LANG),
			    '10' 	=>  '10',
			    '11' 	=>  '11',
			    '12' 	=>  '12',
			    '13' 	=>  '13 = '.__('Neighborhood',self::LANG),
			    '14' 	=>  '14',
			    '15' 	=>  '15',
			    '16' 	=>  '16',
			    '17' 	=>  '17 = '.__('Building',self::LANG),
			    '18' 	=>  '18',
			),
		),
		'maxzoom'	=> array(
			'label'		=> __('Maximum zoom level', self::LANG ),
			'desc'		=> false,
			'type'		=> 'select',
			'value' 	=> $this->active_opts['maxzoom'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
			    '0' 	=>  '0',
			    '1'   =>  '1 = '.__('Region',self::LANG),
			    '2' 	=>  '2',
			    '3' 	=>  '3',
			    '4' 	=>  '4',
			    '5' 	=>  '5 = '.__('Country',self::LANG),
			    '6' 	=>  '6',
			    '7' 	=>  '7',
			    '8' 	=>  '8',
			    '9' 	=>  '9 = '.__('County',self::LANG),
			    '10' 	=>  '10',
			    '11' 	=>  '11',
			    '12' 	=>  '12',
			    '13' 	=>  '13 = '.__('Neighborhood',self::LANG),
			    '14' 	=>  '14',
			    '15' 	=>  '15',
			    '16' 	=>  '16',
			    '17' 	=>  '17 = '.__('Building',self::LANG),
			    '18' 	=>  '18',
			),
		),
		'map-controls-row' => array(
			'label'		=> __('Map controls', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 3,
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
		),
		'control'	=> array (
			'label' 	=> false,
			'desc'		=> false,
			'type'		=> 'radio',
			'value' 	=> $this->active_opts['control'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
					'N' 	=> __( 'None', self::LANG ),
					'S' 	=> __( 'Small control', self::LANG ),
					'L'		=> __( 'Large control', self::LANG ),
			),
		),
		'scale'	=> array(
			'label'		=> __('Displays scale of the current map view', self::LANG ),
			'desc'		=> false,
			'type'		=> 'checkbox',
			'value' 	=> $this->active_opts['scale'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'overview'	=> array(
			'label'		=> __( 'A small overview map for navigational purposes', self::LANG ),
			'desc'		=> __( '"Minimum zoom level" must be 0 or 1 to make the overview map work', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->active_opts['overview'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'marker-icon-row' => array(
			'label'		=> __('Marker Icon', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 3,
			'usage'   => array( 'options_' ),
		),
		'marker_icon'	=> array(
			'label'		=> false,
			'desc'		=> __('Enter an URL or upload an image for the markericon.', self::LANG),
			'type'		=> 'upload',
			'value' 	=> $this->active_opts['marker_icon'],
			'usage'   => array( 'options_' ),
			'validate'=> 'url',
			'validate_msg'  => false,
		),
		'marker_icon_width'	=> array(
			'label'		=> __('Width', self::LANG ),
			'desc'		=> __('in px', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->active_opts['marker_icon_width'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'marker_icon_height'	=> array(
			'label'		=> __('Height', self::LANG ),
			'desc'		=> __('in px', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->active_opts['marker_icon_height'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'labels-row' => array(
			'label'		=> __('Labels', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
		),
		'marker_labels'	=> array(
			'label'		=> __('Add labels to marker', self::LANG ),
			'desc'		=> false,
			'type'		=> 'checkbox',
			'value' 	=> $this->active_opts['marker_labels'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'align'	=> array (
			'label' 	=> __( 'Alignment' ),
			'desc'		=> false,
			'type'		=> 'radio',
			'value' 	=> $this->active_opts['align'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => array (
					'none' 	=> __( 'None' ),
					'left' 	=> __( 'Left' ),
					'center'=> __( 'Center' ),
					'right' => __( 'Right' ),
			)
		),
		'copyright'	=> array(
			'label'		=> __('copyright mention', self::LANG ),
			'desc'		=> __('HTML Element, #ID- or .class-Name, where to move the copyright mention from Cloudmade, e.g. <code>#site-generator</code>', self::LANG),
			'type'		=> 'text',
			'value' 	=> $this->active_opts['copyright'],
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
			'class'   => 'small-text',
		),
		'example-row' => array(
			'label'		=> __('Example', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_' ),
		),
		'show_example'	=> array(
			'label'		=> __('Show example map with default configuration', self::LANG ),
			'desc'		=> __('Is shown only on this page, centered to your current position', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->active_opts['show_example'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		'db-options-row' => array(
			'label'		=> __('Database Options', self::LANG ),
			'type'		=> 'rowgroup',
			'rows'    => 1,
			'usage'   => array( 'options_' ),
		),
		'chk_default_options_db'	=> array(
			'label'		=> __('Restore defaults upon plugin deactivation/reactivation', self::LANG ),
			'desc'		=> __('Only check this if you want to reset plugin settings upon Plugin reactivation', self::LANG ),
			'type'		=> 'checkbox',
			'value' 	=> $this->active_opts['chk_default_options_db'],
			'usage'   => array( 'options_' ),
			'validate'=> 'numeric',
			'validate_msg'  => false,
		),
		
);

$this->defined_group_opts = array(
		'category'	=> array(
			'label'		=> __('Categories' ),
			'desc'		=> false,
			'type'		=> 'terms_checklist',
			'value' 	=> array(),
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => get_dynamic_settings_options ( 'categories' ),
			),
		'tags'	=> array(
			'label'		=> __( 'Tags' ),
			'desc'		=> __( 'Separate tags with commas' ),
			'type'		=> 'text',
			'value' 	=> '',
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'text',
			'validate_msg'  => false,
			),
		'users'	=> array(
			'label'		=> __('Users' ),
			'desc'		=> false,
			'type'		=> 'terms_checklist',
			'value' 	=> array(),
			'usage'   => array( 'options_', 'widget_', 'tiny_' ),
			'validate'=> 'options',
			'validate_msg'  => false,
			'options' => get_dynamic_settings_options ( 'users' ),
			),
);
?>