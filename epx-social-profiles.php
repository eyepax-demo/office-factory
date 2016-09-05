<?php
    /*
    Plugin Name: Eyepax Social Profiles
    Plugin URI: http://eyepax.com
    Description: A plugin to display social profiles.
    Version: 1.0
    Author: Eyepax IT Consulting (Pvt) Ltd
    Author URI: http://eyepax.com
    License: GPL2
    */

    function plugin_text_domain() {
        load_plugin_textdomain('epx-social-profiles', false, dirname( plugin_basename(__FILE__) ) . '/languages/');
    }

    add_action('plugins_loaded', 'plugin_text_domain');

    include_once('inc/helper.php');
    include_once('inc/widget.php');

    // Enqueues external font awesome stylesheet
    function enqueue_stylesheets(){
        // De-register the font-awesome if registered previously
        wp_deregister_style('font-awesome');

        // Better to load font-awesome stylesheet from CDN
        // Content will be cached, so increased performance
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

        wp_enqueue_style('epx-social-profiles', plugins_url('styles/epx-social-profiles-style.css', __FILE__), array(), null);
    }

    add_action('wp_enqueue_scripts', 'enqueue_stylesheets');