<?php

namespace HyVid\Includes\Libs\Video;

if ( ! defined('ABSPATH') ) {
    exit('restricted access');
}

use HyVid\Includes\Libs\Abstracts\Post_Meta_Data;

/**
 * Video Meta Data
 * Fetch the video meta data, this class is being
 * used by video_object class
 *
 * @package     HyVid
 * @subpackage  Includes\Libs\Video
 * @category    Core
 * @author      Saad Mushtaq
 * @link        https://sample-code.com/plugins/hyvid/
 */
class Video_Meta_Data extends Post_Meta_Data {

    /**
     * Return the available meta fields list
     *
     * @access  protected
     * @since   1.0.0
     * @return  array
     */

     // @TODO: DEPRECIATE
	protected function get_meta_fields_list() {
		return hyvid_post_meta_fields();
	}
}
