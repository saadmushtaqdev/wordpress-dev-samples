<?php

namespace HyVid\Includes\Libs\Video;

if ( ! defined( 'ABSPATH' ) ) {
    exit('restricted access');
}

/**
 * Video_Post Custom Post Type
 * Registers WordPress custom post type hyvid-post
 *
 * @package     HyVid
 * @subpackage  Includes\Libs\Video
 * @category    Core
 * @author      Saad Mushtaq
 * @link        https://sample-code.com/plugins/hyvid/
 */
class Video_Post {

    /**
    * Custom Post type Slug
    *
    * @var string
    * @since 1.0.0
    */
    private $post_type_slug = 'hyvid-post';

    /**
     * Class constructor method
     * Contains the callback hook to register_post_type
     *
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        add_action('init', [ $this, 'register_post_type' ] );
    }

    /**
     * Registers a new post type
     * @uses $wp_post_types Inserts new post type object into the list
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
    public function register_post_type() {
        $labels = [
            'name'                => __( 'Videos', 'hyvid-plugin' ),
            'singular_name'       => __( 'Video', 'hyvid-plugin' ),
            'add_new'             => _x( 'Add New Video', 'hyvid-plugin', 'hyvid-plugin' ),
            'add_new_item'        => __( 'Add New Video', 'hyvid-plugin' ),
            'edit_item'           => __( 'Edit Video', 'hyvid-plugin' ),
            'new_item'            => __( 'New Video', 'hyvid-plugin' ),
            'view_item'           => __( 'View Video', 'hyvid-plugin' ),
            'search_items'        => __( 'Search Videos', 'hyvid-plugin' ),
            'not_found'           => __( 'No Videos found', 'hyvid-plugin' ),
            'not_found_in_trash'  => __( 'No Videos found in Trash', 'hyvid-plugin' ),
            'parent_item_colon'   => __( 'Parent Video:', 'hyvid-plugin' ),
            'menu_name'           => __( 'Videos', 'hyvid-plugin' ),
        ];

        $args = [
            'labels'              => $labels,
            'hierarchical'        => false,
            'taxonomies'          => [ 'video_cat', 'video_tag' ],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-video-alt3',
            'show_in_nav_menus'   => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'supports'           => [ 'title', 'editor', 'thumbnail' ]
        ];

        register_post_type( $this->post_type_slug, $args );
    }
}
