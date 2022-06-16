<?php 

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
$rss = fetch_feed( "http://tips.cyberchimps.com/category/tips/feed/" );

function cc_add_dashboard_widgets() {

	add_meta_box(
                 'cc_blogging_widget',         // Widget slug.
                 'CyberChimps Blogging Tips - By Neil Patel',         // Title.
                 'cc_blogging_widget_function', // Display function.
		 'dashboard', 'side', 'high'
        );	
}
if ( !is_wp_error($rss) ) { 
add_action( 'wp_dashboard_setup', 'cc_add_dashboard_widgets' );
}

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function cc_blogging_widget_function() {
$rss = fetch_feed( "http://tips.cyberchimps.com/category/tips/feed/" );
     if ( is_wp_error($rss) ) {
          if ( is_admin() || current_user_can('manage_options') ) {
               echo '<p>';
               echo "The host is currently not available";
               echo '</p>';
          }
     return;
}
  
if ( !$rss->get_item_quantity() ) {
     echo '<p>Apparently, there are no updates to show!</p>';
     $rss->__destruct();
     unset($rss);
     return;
}
  
echo "<ul>\n";
  
if ( !isset($items) )
     $items = 5;
  
     foreach ( $rss->get_items(0, $items) as $item ) {
          $publisher = '';
          $site_link = '';
          $link = '';
          $content = '';
          $date = '';
          $link = esc_url( strip_tags( $item->get_link() ) );
          $title = esc_html( $item->get_title() );
          $content = $item->get_content();
          $content = wp_html_excerpt($content, 250) . ' ...';
  
         echo "<li><a class='rsswidget' href='$link'>$title</a>\n<div class='rssSummary'>$content</div>\n";
}
  
echo "</ul>\n";
$rss->__destruct();
unset($rss);
	
	//wp_dashboard_cached_rss_widget( 'cc_blogging_widget', 'cc_blogging_widget_output', $feeds );
}

?>
