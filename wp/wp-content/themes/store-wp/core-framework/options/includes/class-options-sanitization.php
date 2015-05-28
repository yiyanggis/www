<?php
/**
 * @package   IGthemes_Options_Framework
 */

/**
 * Sanitization for text input
 *
 * @link http://developer.wordpress.org/reference/functions/sanitize_text_field/
 */
add_filter( 'igthemes_sanitize_text', 'sanitize_text_field' );

/**
 * Sanitization for password input
 *
 * @link http://developer.wordpress.org/reference/functions/sanitize_text_field/
 */
add_filter( 'igthemes_sanitize_password', 'sanitize_text_field' );

/**
 * Sanitization for select input
 *
 * Validates that the selected option is a valid option.
 */
add_filter( 'igthemes_sanitize_select', 'igthemes_sanitize_enum', 10, 2 );

/**
 * Sanitization for radio input
 *
 * Validates that the selected option is a valid option.
 */
add_filter( 'igthemes_sanitize_radio', 'igthemes_sanitize_enum', 10, 2 );

/**
 * Sanitization for image selector
 *
 * Validates that the selected option is a valid option.
 */
add_filter( 'igthemes_sanitize_images', 'igthemes_sanitize_enum', 10, 2 );

/**
 * Sanitization for textarea field
 *
 * @param $input string
 * @return $output sanitized string
 */
function igthemes_sanitize_textarea( $input ) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags );
	return $output;
}
add_filter( 'igthemes_sanitize_textarea', 'igthemes_sanitize_textarea' );

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function igthemes_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'igthemes_sanitize_checkbox', 'igthemes_sanitize_checkbox' );

/**
 * Sanitization for multicheck
 *
 * @param array of checkbox values
 * @return array of sanitized values ('1' or false)
 */
function igthemes_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = false;
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = '1';
			}
		}
	}
	return $output;
}
add_filter( 'igthemes_sanitize_multicheck', 'igthemes_sanitize_multicheck', 10, 2 );

/**
 * File upload sanitization.
 *
 * Returns a sanitized filepath if it has a valid extension.
 *
 * @param string $input filepath
 * @returns string $output filepath
 */
function igthemes_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype( $input );
	if ( $filetype["ext"] ) {
		$output = esc_url( $input );
	}
	return $output;
}
add_filter( 'igthemes_sanitize_upload', 'igthemes_sanitize_upload' );

/**
 * Sanitization for editor input.
 *
 * Returns unfiltered HTML if user has permissions.
 *
 * @param string $input
 * @returns string $output
 */
function igthemes_sanitize_editor( $input ) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	}
	else {
		global $allowedposttags;
		$output = wp_kses( $input, $allowedposttags );
	}
	return $output;
}
add_filter( 'igthemes_sanitize_editor', 'igthemes_sanitize_editor' );

/**
 * Sanitization of input with allowed tags and wpautotop.
 *
 * Allows allowed tags in html input and ensures tags close properly.
 *
 * @param string $input
 * @returns string $output
 */
function igthemes_sanitize_allowedtags( $input ) {
	global $allowedtags;
	$output = wpautop( wp_kses( $input, $allowedtags ) );
	return $output;
}

/**
 * Sanitization of input with allowed post tags and wpautotop.
 *
 * Allows allowed post tags in html input and ensures tags close properly.
 *
 * @param string $input
 * @returns string $output
 */
function igthemes_sanitize_allowedposttags( $input ) {
	global $allowedposttags;
	$output = wpautop( wp_kses( $input, $allowedposttags) );
	return $output;
}

/**
 * Validates that the $input is one of the avilable choices
 * for that specific option.
 *
 * @param string $input
 * @returns string $output
 */
function igthemes_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/**
 * Sanitization for background option.
 *
 * @returns array $output
 */
function igthemes_sanitize_background( $input ) {

	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'igthemes_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'igthemes_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'igthemes_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'igthemes_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'igthemes_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'igthemes_sanitize_background', 'igthemes_sanitize_background' );

/**
 * Sanitization for background repeat
 *
 * @returns string $value if it is valid
 */
function igthemes_sanitize_background_repeat( $value ) {
	$recognized = igthemes_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_background_repeat', current( $recognized ) );
}
add_filter( 'igthemes_background_repeat', 'igthemes_sanitize_background_repeat' );

/**
 * Sanitization for background position
 *
 * @returns string $value if it is valid
 */
function igthemes_sanitize_background_position( $value ) {
	$recognized = igthemes_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_background_position', current( $recognized ) );
}
add_filter( 'igthemes_background_position', 'igthemes_sanitize_background_position' );

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function igthemes_sanitize_background_attachment( $value ) {
	$recognized = igthemes_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_background_attachment', current( $recognized ) );
}
add_filter( 'igthemes_background_attachment', 'igthemes_sanitize_background_attachment' );

/**
 * Sanitization for typography option.
 */
function igthemes_sanitize_typography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'igthemes_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'igthemes_font_size', $output['size'] );
	$output['style'] = apply_filters( 'igthemes_font_style', $output['style'] );
	$output['color'] = apply_filters( 'igthemes_sanitize_color', $output['color'] );
	return $output;
}
add_filter( 'igthemes_sanitize_typography', 'igthemes_sanitize_typography', 10, 2 );

/**
 * Sanitization for font size
 */
function igthemes_sanitize_font_size( $value ) {
	$recognized = igthemes_recognized_font_sizes();
	$value_check = preg_replace('/px/','', $value);
	if ( in_array( (int) $value_check, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_font_size', $recognized );
}
add_filter( 'igthemes_font_size', 'igthemes_sanitize_font_size' );

/**
 * Sanitization for font style
 */
function igthemes_sanitize_font_style( $value ) {
	$recognized = igthemes_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_font_style', current( $recognized ) );
}
add_filter( 'igthemes_font_style', 'igthemes_sanitize_font_style' );

/**
 * Sanitization for font face
 */
function igthemes_sanitize_font_face( $value ) {
	$recognized = igthemes_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'igthemes_default_font_face', current( $recognized ) );
}
add_filter( 'igthemes_font_face', 'igthemes_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 */
function igthemes_recognized_background_repeat() {
	$default = array(
		'no-repeat' => __( 'No Repeat', 'store-wp' ),
		'repeat-x'  => __( 'Repeat Horizontally', 'store-wp' ),
		'repeat-y'  => __( 'Repeat Vertically', 'store-wp' ),
		'repeat'    => __( 'Repeat All', 'store-wp' ),
		);
	return apply_filters( 'igthemes_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 */
function igthemes_recognized_background_position() {
	$default = array(
		'top left'      => __( 'Top Left', 'store-wp' ),
		'top center'    => __( 'Top Center', 'store-wp' ),
		'top right'     => __( 'Top Right', 'store-wp' ),
		'center left'   => __( 'Middle Left', 'store-wp' ),
		'center center' => __( 'Middle Center', 'store-wp' ),
		'center right'  => __( 'Middle Right', 'store-wp' ),
		'bottom left'   => __( 'Bottom Left', 'store-wp' ),
		'bottom center' => __( 'Bottom Center', 'store-wp' ),
		'bottom right'  => __( 'Bottom Right', 'store-wp')
		);
	return apply_filters( 'igthemes_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 */
function igthemes_recognized_background_attachment() {
	$default = array(
		'scroll' => __( 'Scroll Normally', 'store-wp' ),
		'fixed'  => __( 'Fixed in Place', 'store-wp')
		);
	return apply_filters( 'igthemes_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 */

function igthemes_sanitize_hex( $hex, $default = '' ) {
	if ( igthemes_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}
add_filter( 'igthemes_sanitize_color', 'igthemes_sanitize_hex' );

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */

function igthemes_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'igthemes_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 */
function igthemes_recognized_font_faces() {
	$default = array(
		'arial'     => 'Arial',
		'verdana'   => 'Verdana, Geneva',
		'trebuchet' => 'Trebuchet',
		'georgia'   => 'Georgia',
		'times'     => 'Times New Roman',
		'tahoma'    => 'Tahoma, Geneva',
		'palatino'  => 'Palatino',
		'helvetica' => 'Helvetica*'
		);
	return apply_filters( 'igthemes_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 */
function igthemes_recognized_font_styles() {
	$default = array(
		'normal'      => __( 'Normal', 'store-wp' ),
		'italic'      => __( 'Italic', 'store-wp' ),
		'bold'        => __( 'Bold', 'store-wp' ),
		'bold italic' => __( 'Bold Italic', 'store-wp' )
		);
	return apply_filters( 'igthemes_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 */
function igthemes_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}