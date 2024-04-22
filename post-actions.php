<?php

namespace HyVid\Includes\Libs\Abstracts;

if ( ! defined('ABSPATH') ) {
    exit('restricted access');
}

use HyVid\Includes\Libs\Abstracts\Dynamic_Data;

/**
 * Video Post Actions
 * The frontend actions to be performed against a video
 *
 * @package     HyVid
 * @subpackage  Includes\Libs\Video
 * @category    Core
 * @author      Saad Mushtaq
 * @link        https://sample-code.com/plugins/hyvid/
 */
Abstract class Post_Actions extends Dynamic_Data {
    /**
     * List of available post actions
     *
     * @var array
     */
	protected $post_actions = [];

    /**
     * HTML Code
     *
     * @var mixed
     */
	protected $html_code = null;

    /**
     * Set the markup filter name prefix
     *
     * @return  string
     */
    abstract protected function get_markup_filter_prefix();

    /**
     * Set the post action markup filter name
     *
     * @return  string  
     */
    abstract protected function get_action_markup_filter_name();

    /**
     * Constructor method for dependency injection
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
	function __construct( \HyVid\Includes\Libs\Abstracts\Post_Abstract $post ) {
		$this->post_object =& $post;
        // $this->post_object =& $post;
	}

    /**
     * Return the post actions HTML
     *
     * @param   array  $meta_fields   list of meta fields
     * @param   string  $wrapper_html  HTML code with sprintf placeholders
     *
     * @return  mixed
     */
	public function get_html( $meta_fields, $wrapper_html = '<li>%s</li>' ) {
		$meta_fields = $this->get_meta_data( $meta_fields );

		$html = '';
		$code = $this->get_html_code();
		foreach ( $meta_fields as $meta_key => $meta_value ) {
			if ( ! $meta_value ) {
				continue;
			}

            $markup_filter_prefix = $this->get_markup_filter_prefix();
			$markup = apply_filters( $markup_filter_prefix . '/' . $meta_key, null, $meta_value, $meta_fields, $this->post_object );
			if ( $markup ) {
				$html .= $this->wrap_markup( $markup, $wrapper_html );
				continue;
			}

			$html .= $this->wrap_markup(
				sprintf( $code, 'hyvid-actions-' . esc_attr( sanitize_key( $meta_key ) ), $meta_value ),
				$wrapper_html
			);
		}

		return $html;
	}

    /**
     * Return the HTML code
     * Method contains a WP filter hook to overwrite the HTML
     *
     * @access  protected
     * @since   1.0.0
     * @return  mixed
     */
	protected function get_html_code() {
		if ( $this->html_code ) {
			return $this->html_code;
		}

        $markup_filter_name = $this->get_action_markup_filter_name();
		$this->html_code = apply_filters( $markup_filter_name, '<div class="hyvid-post-action %s">%s</div>' );
		return $this->html_code;
	}

    /**
     * The wrapper markup for post actions list
     *
     * @param   string  $markup   The HTML code
     * @param   string  $wrapper  HTML markup with sprintf support placeholders %s and %d
     *
     * @return  string
     */
	protected function wrap_markup( $markup, $wrapper ) {
		if ( ! $wrapper ) {
			return $markup;
		}

		return sprintf( $wrapper, $markup );
	}
}