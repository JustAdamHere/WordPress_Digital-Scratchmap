<?php
/**
* Plugin Name: Digital Scratchmap
* Plugin URI: https://r.blakey.family/DigitalScratchmap
* Description: See your places visualised for all to see!
* Version: 1.0
* Author: Adam Matthew Blakey
* Author URI: https://adam.blakey.family
**/

// Cut out the silly behaviour.
if ( !function_exists( 'add_action' ) ) {
	echo 'You just tried to call a plugin? That was a little silly.';
	exit;
}

// Some useful constants.
define( 'DS__VERSION', '1.0' );
define( 'DS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Register the activation and deactivation hooks.
register_activation_hook( __FILE__, array( 'digital_scratchmap', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'digital_scratchmap', 'plugin_deactivation' ) );

// Include the main class.
//require_once( DS__PLUGIN_DIR . 'class.digital-scratchmap.php' );

// Initialise.
//add_action( 'init', array( 'digital_scratchmap', 'init' ) );

// Loads the admin class.
// ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	//require_once( DS__PLUGIN_DIR . 'class.digital-scratchmap-admin.php' );
	//add_action( 'init', array( 'digital_scratchmap_admin', 'page_init' ) );
//}

if ( is_admin() )
{
	require_once( DS__PLUGIN_DIR . 'class.digital-scratchmap-admin.php' );
	$my_settings_page = new digital_scratchmap_admin();
}

?>