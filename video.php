<?php

namespace HyVid\Includes\Libs\Video;

if ( ! defined( 'ABSPATH' ) ) {
    exit('restricted access');
}

use \HyVid\Includes\Libs\Enqueue_Scripts;

/**
 * Video Class
 * Responsible to handle / load all video related functionality
 *
 * @package     HyVid
 * @subpackage  Includes\Libs\Video
 * @category    Core
 * @author      Saad Mushtaq
 * @link        https://sample-code.com/plugins/hyvid/
 */
class Video {
    /**
     * Class constructor method
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        $this->load_helpers();
        $this->initialize();

        // Custom archive page template
        add_filter( 'archive_template', [ &$this, 'get_archive_template' ] );
    }

    /**
     * Return the video archive template file path
     *
     * The user can overwrite the video template from theme directory
     * this method is giving the theme file priority - if there is no file
     * then load the default file from plugin directory
     *
     * @access public
     * @since 1.0.0
     * @return string
     */
    public function get_archive_template( $template ) {
        if ( "hyvid-post" != get_post_type() ) {
            return $template;
        }

        // Enqueue Plugin scripts and files
        \HyVid\enqueue_files();

        // Check if the template is available in theme directory
        $theme_archive_file = locate_template( 'archive-hyvid-post' );
        if ( ! $theme_archive_file ) {
            $theme_archive_file = \HyVid\locate_template( 'archive-videos' );
        }

        return $theme_archive_file;
    }

    /**
     * Load video core files
     * Register the plugin video custom post type and taxonomies
     *
     * @access  protected
     * @since   1.0.0
     * @return  void
     */
    protected function initialize() {
        new Video_Post;
        new Video_Taxonomies;
    }

    /**
     * Load video helper functions
     * The loaded functions are accessiable with namespace
     * e.g. HyVid/get_video( $video_id )
     *
     * @access  protected
     * @since   1.0.0
     * @return  void
     */
    protected function load_helpers() {
        require_once HYVID_PLUGIN_PATH . 'includes/helpers/video-global-filters.php';
        require_once HYVID_PLUGIN_PATH . 'includes/helpers/video-helpers.php';
        require_once HYVID_PLUGIN_PATH . '/includes/helpers/video-post-filters.php';
        require_once HYVID_PLUGIN_PATH . '/includes/helpers/video-html-helpers.php';
    }
}
