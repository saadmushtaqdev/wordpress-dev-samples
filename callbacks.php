<?php

namespace HyVid\Includes\Libs\Abstracts;

if ( ! defined('ABSPATH') ) {
    exit('restricted access');
}

/**
 * Callbacks Abstract Class
 * 
 * A class to extend PHP objects and add supports for dynamic
 * methods into that class
 *
 * @package     HyVid
 * @subpackage  Includes\Libs\Abstracts
 * @category    Core
 * @author      Saad Mushtaq
 * @link        https://sample-code.com/plugins/hyvid/
 */
Abstract Class Callbacks {
	private $callbacks = [];

    /**
     * __call Magin function
     * Check if the method was dyamically registered or not
     *
     * @param   string  $method_name Method Name
     * @param   array  $args         Arguments list
     *
     * @return  mixed
     */
    final function __call( $method_name, $args ) {
        $callbacks = $this->get_callbacks_list();

        if ( ! isset( $callbacks[ $method_name ] ) ) {
            throw new \Exception(
                sprintf(
                    esc_html__("The callback %s is not registered in %s", "hyvid-plugin"),
                    $method_name,
                    get_called_class()
                )
            );
        }

        \array_unshift( $args, $this );
        return call_user_func_array( $callbacks[ $method_name ]['function'], $args );
    }

    /**
     * Get hook name
     * Automatically define the hook name based on the 
     * child class
     *
     * @return  string  Hook name
     */ 
    final protected function get_hook_name() {
        return strtolower( str_replace('\\', '/', get_called_class() ) );
    }

    /**
     * List of supported callbacks
     *
     * @return  array  Callbacks list
     */
    private function get_callbacks_list() {
        global $wp_filter;

        $hook_name = $this->get_hook_name();

        if ( ! isset( $wp_filter[ $hook_name ] ) ) {
            return $this->callbacks;
        }

        foreach( $wp_filter[ $hook_name ] as $name => $callback ) {
            foreach( $callback as $callback_name => $callback_args ) {
                if ( \is_array( $callback_args['function'] ) ) {
                    $this->callbacks[ $callback_args['function'][1] ] = $callback_args;
                    continue;
                }

                $this->callbacks[ $callback_name ] = $callback_args;
            }
        }

        return $this->callbacks;
    }
}