<?php
/**loading css and js scripts */
function fb_load_resources(){

    /** loading style.css file */
    wp_enqueue_style('main-style',plugins_url().'/youtubesubscribe/includes/css/style.css');

    /**loading main.js script file */
    wp_enqueue_script('main-script',plugins_url().'/youtubesubscribe/includes/js/main.js');

    /**js file to load facebook share button in the widget */
    wp_enqueue_script('facebook-share',plugins_url().'/facebook-share/includes/js/facebookshare.js');
}
add_action('wp_enqueue_scripts','fb_load_resources');