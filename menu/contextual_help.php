<?php
      	global $CMM_general_page, $CMM_static_page, $CMM_active_page;

/*
        if ($screen_id == $CMM_general_page) {
      		$contextual_help ='';
      		$contextual_help .= '$CMM_general_page This is where I would provide help to the user on how everything in my admin panel works. Formatted HTML works fine in here too.';

        }
*/
        if ($screen_id == $CMM_static_page) {
      		$contextual_help  = '<div class="wp-cmm_contextual-help">';
      		$contextual_help .= "<h4>".__('Usage of the Static Maps Shortcode', CloudMadeMap::LANG )."</h4>";
      		$contextual_help .= "<p>".__('For a simple static map inside a post or page use', CloudMadeMap::LANG )." <strong><code>[cmm_static]</code></strong> " . __('The generated map will use the default values from this page.', CloudMadeMap::LANG )."</p>";
      		$contextual_help .= "<p>".__('To show a personalized static map use one or more of the following attributes:', CloudMadeMap::LANG )."</p>";
          $contextual_help .= "<dl>";
          $contextual_help .= "<dt><code>width=''</code></dt><dd>". __('Map width', CloudMadeMap::LANG );
      		$contextual_help .= "<small> ".__('Awaiting integers (in px) only, do not add any units.', CloudMadeMap::LANG )."</small></dd>";
          $contextual_help .= "<dt><code>height=''</code></dt><dd>". __('Map height', CloudMadeMap::LANG );
      		$contextual_help .= "<small> ".__('Awaiting integers (in px) only, do not add any units.', CloudMadeMap::LANG )."</small></dd>";
          $contextual_help .= "<dt><code>zoom=''</code></dt><dd>". __('Zoom level', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>background='true'</code></dt><dd>". __('to show the map as a background-image', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "</dl>";
      		$contextual_help .= "<p>".__('Width and Height are awaiting integers (in px) only, do not add any units.', CloudMadeMap::LANG )."</p>";
#      		$contextual_help .= "<p>".__('A combination of all available parameters gives you a simple static map for all postlistings, like in index-view, category-, tag- or date-archives on the one hand. And a fullscreen background-image for the single-view on the other.', CloudMadeMap::LANG )."</p>";
      		$contextual_help .= "<p>".__('Try adding two shortcodes, one for a small preview and one for the background and give them different zoomlevels ;)', CloudMadeMap::LANG )."</p>";
      		$contextual_help .= '</div>';
        }

        if ($screen_id == $CMM_active_page) {
      		$contextual_help  = '<div class="wp-cmm_contextual-help">';
      		$contextual_help .= "<h4>".__('Usage and control of the Interactive Maps', CloudMadeMap::LANG )."</h4>";
      		$contextual_help .= "<p>".__('For a simple active map inside a post or page use', CloudMadeMap::LANG )." <strong><code>[cmm_active_single]</code></strong> " . __('The generated map will use the default values from this page.', CloudMadeMap::LANG )."</p>";
      		$contextual_help .= "<p>".__('To show a personalized active map use one or more of the following attributes:', CloudMadeMap::LANG )."</p>";
          $contextual_help .= "<dl>";
          $contextual_help .= "<dt><code>width=''</code></dt><dd>". __('Map width', CloudMadeMap::LANG );
      		$contextual_help .= "<small> ".__('Awaiting integers (in px) only, do not add any units.', CloudMadeMap::LANG )."</small></dd>";
          $contextual_help .= "<dt><code>height=''</code></dt><dd>". __('Map height', CloudMadeMap::LANG );
      		$contextual_help .= "<small> ".__('Awaiting integers (in px) only, do not add any units.', CloudMadeMap::LANG )."</small></dd>";
          $contextual_help .= "<dt><code>zoom=''</code></dt><dd>". __('Zoom level', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>minzoom=''</code></dt><dd>". __('Minimum zoom level', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>maxzoom=''</code></dt><dd>". __('Maximum zoom level', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>controls=''</code></dt><dd>". __('Map controls', CloudMadeMap::LANG )." ". __('Allowed attributes:', CloudMadeMap::LANG )." ". __('<strong><code>L</code></strong> for large controll, <strong><code>S</code></strong> for a small one and leave or <strong><code>N</code></strong> for no control.', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>scale=''</code></dt><dd>". __('Show the displays scale.', CloudMadeMap::LANG ). " ". __('Allowed attributes:', CloudMadeMap::LANG )." ". __('are only <strong><code>1</code></strong> to show or <strong><code>0</code></strong> to hide', CloudMadeMap::LANG )."</dd>";
          $contextual_help .= "<dt><code>overview=''</code></dt><dd>". __('Show a small overview map', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>labels=''</code></dt><dd>". __('Add labels to marker', CloudMadeMap::LANG ). "</dd>";
          $contextual_help .= "<dt><code>title=''</code></dt><dd>". __('Description for marker &amp; label instead of post- or page-title.', CloudMadeMap::LANG ). "</dd>";

          $contextual_help .= "</dl>";
      		$contextual_help .= '</div>';


        }
?>