<?php

/**
 * Plugin Name: Show Time
 * Description: This plugin displays the time
 * Version: 1.0.0
 * Author: Michael Horwitz
 * License: GPL2
 */

 function show_time(){
 	$zone = get_option('time_zone','America/Chicago');
 	date_default_timezone_set("$zone");
 	$time = date("h:i a");
 	$time = "The time is " .$time;
 	echo "<div id=show_time>$time</div>";
 }

 add_action( 'wp_footer', 'show_time');

function show_time_css() {
	?>
	<style type='text/css'>
	#show_time {
		with; 200px;
		float: left;
		padding: 15px;	
		margin: auto;
		background: #fff;
		border-radius: 5px;
		font-size: 30px;
		color: blue;
	}
	</style>
	<?php
}

add_action( 'wp_head', 'show_time_css' );

function showtime_settings_menu() {
	add_menu_page('Show Time Settings', 'Show Time', 'manage_options', 'showtime-settings', 'showtime_settings_page', 'dashicons-clock');
}

add_action('admin_menu', 'showtime_settings_menu');

function showtime_settings() {
	register_setting( 'showtime_settings', 'time_zone' );
}

add_action( 'admin_init', 'showtime_settings' );

function showtime_settings_page() {
?>
<div class="wrap">
<h2>Show Time Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'showtime_settings' ); ?>
    <?php do_settings_sections( 'showtime_settings' ); ?>
    <table class="form-table">        
        <tr valign="top">
        <th scope="row">Time Zone</th>
        <td><input type="text" name="time_zone" value="<?php echo esc_attr( get_option('time_zone') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>

<?php
}

?>