<?php
/**
 * @package   IGthemes_Options_Framework
 */

class IGthemes_Options_Framework {

/**
 * Plugin version, used for cache-busting of style and script file references.
 */

/**
 * Initialize the plugin.
 */
    public function init() {

        // Needs to run every time in case theme has been changed
        add_action( 'admin_init', array( $this, 'set_theme_option' ) );

    }

/**
 * Sets option defaults
 */
    function set_theme_option() {

        // Load settings
        $igthemes_optionsframework_settings = get_option( 'igthemes-optionsframework' );

        // Updates the unique option id in the database if it has changed
        if ( function_exists( 'igthemes_optionsframework_option_name' ) ) {
            igthemes_optionsframework_option_name();
        }
        elseif ( has_action( 'igthemes_optionsframework_option_name' ) ) {
            do_action( 'igthemes_optionsframework_option_name' );
        }
        // If the developer hasn't explicitly set an option id, we'll use a default
        else {
            $default_themename = get_option( 'stylesheet' );
            $default_themename = preg_replace( "/\W/", "_", strtolower($default_themename ) );
            $default_themename = 'igthemes_optionsframework_' . $default_themename;
            if ( isset( $igthemes_optionsframework_settings['id'] ) ) {
                if ( $igthemes_optionsframework_settings['id'] == $default_themename ) {
                    // All good, using default theme id
                } else {
                    $igthemes_optionsframework_settings['id'] = $default_themename;
                    update_option( 'igthemes-optionsframework', $igthemes_optionsframework_settings );
                }
            }
            else {
                $igthemes_optionsframework_settings['id'] = $default_themename;
                update_option( 'igthemes-optionsframework', $igthemes_optionsframework_settings );
            }
        }

    }

/**
 * Wrapper for igthemes_optionsframework_options()
 */
    static function &_igthemes_optionsframework_options() {
        static $options = null;

        if ( !$options ) {
            // Load options from options.php file (if it exists)
            $location = apply_filters( 'options_framework_location', array('options.php') );
            if ( $optionsfile = locate_template( $location ) ) {
                $maybe_options = require_once $optionsfile;
                if ( is_array( $maybe_options ) ) {
                    $options = $maybe_options;
                } else if ( function_exists( 'igthemes_optionsframework_options' ) ) {
                    $options = igthemes_optionsframework_options();
                }
            }

            // Allow setting/manipulating options via filters
            $options = apply_filters( 'igthemes_options', $options );
        }

        return $options;
    }

}
