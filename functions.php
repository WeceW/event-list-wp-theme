<?php
/**
 * Functions and definitions
 *
 * @link 
 *
 * @package EventList
 * @since 1.0.0
 */


require get_template_directory() . "/vendor/devgeniem/dustpress/dustpress.php";
dustpress();


if ( ! defined( 'ASSETS_DIR' ) ) {
    define( 'ASSETS_DIR', get_template_directory_uri() . '/assets' );
}


/**
 * Add custom menu
 */
function wpb_custom_new_menu() {
    register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );


/**
 * Custom post type: Event
 */
function custom_post_type() {

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Events', 'Post Type General Name', 'geniemtask' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'geniemtask' ),
        'menu_name'           => __( 'Events', 'geniemtask' ),
        'all_items'           => __( 'All Events', 'geniemtask' ),
        'view_item'           => __( 'View Event', 'geniemtask' ),
        'add_new_item'        => __( 'Add New Event', 'geniemtask' ),
        'add_new'             => __( 'Add New', 'geniemtask' ),
        'edit_item'           => __( 'Edit Event', 'geniemtask' ),
        'update_item'         => __( 'Update Event', 'geniemtask' ),
        'search_items'        => __( 'Search Event', 'geniemtask' ),
        'not_found'           => __( 'Not Found', 'geniemtask' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'geniemtask' ),
    );
     
// Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'event', 'geniemtask' ),
        'description'         => __( 'Events', 'geniemtask' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    register_post_type( 'event', $args );
}
add_action( 'init', 'custom_post_type', 0 );


/**
 * Enqueue scripts and styles.
 */
function geniemtask_scripts() {
    wp_enqueue_style( 'theme-style', ASSETS_DIR . "/stylesheets/theme-style.css", array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'theme-js', ASSETS_DIR . '/scripts/theme-script.js', [ 'jquery' ], $version, true );
}
add_action( 'wp_enqueue_scripts', 'geniemtask_scripts' );
