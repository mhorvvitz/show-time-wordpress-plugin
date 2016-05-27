<?php

/**
 * Plugin Name: Show Time
 * Description: This plugin displays the time
 * Version: 1.0.0
 * Author: Michael Horwitz
 * License: GPL2
 */

 function show_time(){
 	date_default_timezone_set("America/Chicago");
 	$time = date("h:i a");
 	$time = "The time is " .$time;
 	echo "<div id=show_time>$time</div>";
 }

 add_action( 'wp_footer', 'show_time');

function show_time_css() {
	echo "
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
	";
}

add_action( 'wp_head', 'show_time_css' );

?>