<?php
    /*
        Plugin Name: Learnegy Core
        Description: This plugin is the companion for the Learnegy theme, it runs and adds its enhancements only if the Learnegy theme is installed and active.
        Version: 1.0.0
        Author: Mamurjor IT
        Author URI: https://mamurjor.com
        Text Domain: learnegy-core
        License: GPLv2 or later
        License URI: http://www.gnu.org/licenses/gpl-2.0.html
    */

    if ( !defined( 'ABSPATH' ) ) {
        exit;
        // Exit if accessed directly.
    }
    
    define( 'LEARNEGY_PATH', plugin_dir_url( __FILE__ ) );

    function learnegy_front_page_template_add( $templates ) {
        $templates[wp_normalize_path( plugin_dir_path( __FILE__ ) . '/templates/front.php' )] = __( 'Front Page', 'learnegy' ); 

        return $templates;
    }
    add_filter( 'theme_page_templates', 'learnegy_front_page_template_add' );


    function learnegy_front_page_template($template) {
        if (is_page()) {
            $meta = get_post_meta(get_the_ID());
            if (strpos($meta['_wp_page_template'][0], 'front.php') !== false) {
                $template = $meta['_wp_page_template'][0];
            }
        }

        return $template;
    }
    add_filter( 'template_include', 'learnegy_front_page_template', 99 );