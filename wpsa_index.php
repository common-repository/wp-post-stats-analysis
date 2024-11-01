<?php
/*
Plugin Name: WP Post Stats & Analysis
Plugin URI: http://wordpress.org
Description: Simple WordPress Post Stats & Analysis plugin
Version: 1.2
Author: chamara
Author URI: ttps://wordpress.org/support/plugin/wp-post-stats-analysis/
*/

 
 
 /**
 * Enqueue plugin style-file
 */
 
add_action( 'admin_enqueue_scripts', 'wpsa_add_stylesheet' );

function wpsa_add_stylesheet() {
	
		wp_register_style( 'wpsa-style', plugins_url('/css/wpsa_style.css', __FILE__) );
 		wp_enqueue_style( 'wpsa-style' );
}
 
 

 /**
 * create custom plugin settings menu
 */
 
add_action('admin_menu', 'wpsa_wp_post_stats_analysis_add_menu');

function wpsa_wp_post_stats_analysis_add_menu() {

	//create new top-level menu
	add_menu_page('WP Post Stats ', 'WP Post Stats & Analysis', 'administrator','WP-Post-Stats-Analysis', 'wpsa_wp_post_stats_analysis'  );

  }

 


function wpsa_wp_post_stats_analysis() {
?>
<div class="wrap">
 <h1 >WP Post Stats & Analysis  </h1>

<?php

	global $wpdb, $id;
	$monthSubs = gmdate( 'Y-m-d H:i:s', strtotime('- 1 MONTH') );	
	$now = gmdate( 'Y-m-d H:i:s', time() );	
	
  
  	$total_number_of_posts_publish = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='publish' AND post_type ='post' " );
	 
  	$total_number_of_posts_future = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='future' AND post_type ='post' " );
 	$total_number_of_posts_draft = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='draft' OR post_status ='auto-draft' AND post_type ='post'   " );
 	$total_number_of_posts_pending = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='pending' AND post_type ='post' " );
 	$total_number_of_posts_private =$wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='private' AND post_type ='post' " );
 	$total_number_of_posts_trash = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='trash' AND post_type ='post' " );
 	$total_number_of_posts_auto  = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='auto-draft' AND post_type ='post' " );
 	$total_number_of_posts_inherit  = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status ='inherit' AND post_type ='post' " );
 	$total_number_of_comments  = $wpdb->get_var( "SELECT SUM(comment_count) FROM $wpdb->posts WHERE post_status ='publish' AND post_type ='post'  " );
 	$total_number_of_posts_last_month  = $wpdb->prepare( "SELECT COUNT(post_content) FROM $wpdb->posts WHERE post_status = 'publish' AND post_date > %s  AND post_type ='post' " , $monthSubs  );
 


 ?>
 




 				<table class="widefat fixed wpsa-style-table " >
					<thead class="wpsa-sm-font wpsa-style-table-col" >
						<tr >
							<th class="wpsa-lg-font" > Stats </th>
							<th> </th>
 						</tr>
					</thead>
					
 						<tbody>
				 
 				
						<tr>
							<td class="wpsa-sm-font" >Total number of posts (published) <span class="wpsa-sm-font-info">( Viewable by everyone ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_publish; ?> </b> </td>
 						</tr>
						
									
						
 						<tr>
							<td class="wpsa-sm-font" >Total number of comments on posts  </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_comments; ?> </b> </td>
 						</tr>
						
						<tr>
							<td class="wpsa-sm-font" >Total number of draft posts <span class="wpsa-sm-font-info">( Incomplete post ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_draft; ?> </b> </td>
 						</tr>
												
				
						<tr>
							<td class="wpsa-sm-font" >Total number of auto-draft posts <span class="wpsa-sm-font-info">( WordPress automatic draft post saves ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_auto; ?> </b> </td>
 						</tr>
							
							
						<tr>
							<td class="wpsa-sm-font" >Total number of future posts <span class="wpsa-sm-font-info">( Scheduled to be published in a future date ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_future; ?> </b> </td>
 						</tr>
						
				

			 
						<tr>
							<td class="wpsa-sm-font" >Total number of pending posts <span class="wpsa-sm-font-info">( Awaiting approval ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_pending; ?> </b> </td>
 						</tr>
						
						
				
						<tr>
							<td class="wpsa-sm-font" >Total number of private posts <span class="wpsa-sm-font-info">( Viewable only to admins ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_private; ?> </b> </td>
 						</tr>
						
						

						
 						<tr>
							<td class="wpsa-sm-font" >Total number of trash posts <span class="wpsa-sm-font-info">( assigned the trash status ) <span> </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_trash; ?> </b> </td>
 						</tr>
						
						
 						<tr>
							<td class="wpsa-sm-font" >Total number of attachments and revisions  </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_posts_inherit; ?> </b> </td>
 						</tr>
						
			
				 						
						
 						<tr>
							<td class="wpsa-sm-font" >Total number of Posts Last 30 days  </td>
							<td class="wpsa-sm-font" > :- <b class="wpsa-add-pad-left wpsa-number-font"> <?php echo $total_number_of_comments; ?> </b> </td>
 						</tr>
						
				 
		 
					</tbody>
				</table>
				
	 
</div>
<?php } ?>


