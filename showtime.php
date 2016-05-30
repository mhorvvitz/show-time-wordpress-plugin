<?php

/**
 * Plugin Name: Show Time
 * Description: This plugin displays the time
 * Version: 1.0.0
 * Author: Michael Horwitz
 * License: GPL2
 */

 function show_time(){
 	//get time zone set in plugin settings
 	$zone = get_option('time_zone','America/Chicago');
 	//set it as default time zone inside function
 	date_default_timezone_set("$zone");
 	//save time in a string after time zone set
 	$show_time = date("h:i a");
	
	//get number of seconds after midnight by converting our displayed time to a unix time stamp then subtracting unix timestamp at beginning of day
 	$time_of_day = strtotime($show_time) - strtotime("today");

 	//full string saved into variable
 	$show_time = 'The time is ' .$show_time .' or ' .$time_of_day .' seconds after midnight';

 	//there are 86,400 seconds in day. output appropiate greeting based on the time of day.
 	if ($time_of_day < 43200){
 		echo "<div id='show_time'>Good Morning .$show_time</div>";
 	}
 	else if ($time_of_day >= 43200 and $time_of_day < 64800){
 		echo "<div id='show_time'>Good Afternoon .$show_time</div>";
 	}
 	else{
 		echo "<div id='show_time'>Good Evening .$show_time</div>";
 	}
 }
//location of string will be in wordpress footer
 add_action( 'wp_footer', 'show_time');

//inserting style for plugin into wordpress header
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

//adding settings page to wp admin
function showtime_settings_menu() {
	add_menu_page('Show Time Settings', 'Show Time', 'manage_options', 'showtime-settings', 'showtime_settings_page', 'dashicons-clock');
}

add_action('admin_menu', 'showtime_settings_menu');

//registering settings https://developer.wordpress.org/plugins/settings/creating-and-using-options/
function showtime_settings() {
	register_setting( 'showtime_settings', 'time_zone' );
}

add_action( 'admin_init', 'showtime_settings' );

//creating a form to take settings
function showtime_settings_page() {
?>
<div class="wrap">
<h2>Show Time Settings</h2>

<!--saving settings to options.php-->
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