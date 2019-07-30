<?php
/*
Plugin Name: Facebook Share
Plugin URI: https://sourceextension.com
Description:Facebook Share button Widget
Version: 1.0.0
Author: Hiren Patel
Author URI: http://sourceextension.com
Text Domain: fb-domain
*/

/** restricting direct access to file */
if(!defined('ABSPATH')){
    exit;
}

/**include facebookshare-scripts.php file to load css and js resources */
require_once(plugin_dir_path(__FILE__).'/includes/facebookshare-scripts.php');

/**include facebookshare-class.php file to load widget class  */
require_once(plugin_dir_path(__FILE__).'/includes/facebookshare-class.php');

/**register widget class to wordpress using register_widget method */

function register_facebookshare(){
    register_widget('Facebookshare_Widget');
}

/**hook in function to call register function using add_action */
add_action('widgets_init','register_facebookshare');