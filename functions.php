<?php
/**
 * GeniemTask functions and definitions
 *
 * @link 
 *
 * @package GeniemTask
 * @subpackage GeniemTask
 * @since 1.0.0
 */

require get_template_directory() . "/vendor/devgeniem/dustpress/dustpress.php";
dustpress();

if ( ! defined( 'ASSETS_DIR' ) ) {
    define( 'ASSETS_DIR', get_template_directory_uri() . '/assets' );
}

/**
 * Enqueue scripts and styles.
 */
function geniemtask_scripts() {
  wp_enqueue_style( 'theme-style', ASSETS_DIR . "/stylesheets/theme-style.css", array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'geniemtask_scripts' );
