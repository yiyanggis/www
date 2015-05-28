<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_dustlandexpress_options() {

	// Theme defaults
	$primary_color = '#955cce';
	$secondary_color = '#7f18ce';
    
    $body_font_color = '#4F4F4F';
    $heading_font_color = '#5E5E5E';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'kra-favicon';
    
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Favicon', 'dustlandexpress' ),
		'priority' => '10',
		'description' => __( 'Add a favicon to your website', 'dustlandexpress' )
	);
    
	$options['kra-header-favicon'] = array(
		'id' => 'kra-header-favicon',
		'label'   => __( 'Favicon', 'dustlandexpress' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);
    
    
    // Layout Settings
    $section = 'kra-layout';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Layout Options', 'dustlandexpress' ),
        'priority' => '30'
    );
    
    // Upsell Button One
    $options['kra-upsell-one'] = array(
        'id' => 'kra-upsell-one',
        'label'   => __( 'Site Layout', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $choices = array(
        'kra-header-layout-standard' => 'Standard Layout',
        'kra-header-layout-centered' => 'Centered Layout'
    );
    $options['kra-header-layout'] = array(
        'id' => 'kra-header-layout',
        'label'   => __( 'Header Layout', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'kra-header-layout-centered'
    );
    
    $options['kra-header-search'] = array(
        'id' => 'kra-header-search',
        'label'   => __( 'Show Search', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Enable to a slogan for your site. This uses the site Tagline', 'dustlandexpress' ),
        'default' => 1,
    );
    // Upsell Button Two
    $options['kra-upsell-two'] = array(
        'id' => 'kra-upsell-two',
        'label'   => __( 'Sticky Header', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['kra-show-header-top-bar'] = array(
        'id' => 'kra-show-header-top-bar',
        'label'   => __( 'Show Top Bar', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'This will show/hide the top bar in the header.<br /><a href="http://support.kairaweb.com/knowledgebase/top-bar-not-showing-2/" target="_blank"><b>Not working? See here</b></a>', 'dustlandexpress' ),
        'default' => 1,
    );
    
    
    // Blog Settings
    $section = 'kra-slider';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Slider Options', 'dustlandexpress' ),
        'priority' => '35'
    );
    
    $choices = array(
        'kra-slider-default' => 'Default Slider',
        'kra-meta-slider' => 'Meta Slider',
        'kra-no-slider' => 'None'
    );
    $options['kra-slider-type'] = array(
        'id' => 'kra-slider-type',
        'label'   => __( 'Choose a Slider', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'kra-slider-default'
    );
    $options['kra-slider-cats'] = array(
        'id' => 'kra-slider-cats',
        'label'   => __( 'Slider Categories', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s).<br /><a href="http://support.kairaweb.com/knowledgebase/setup-the-dustland-express-default-slider/" target="_blank"><b>Follow instructions here</b></a>', 'dustlandexpress' )
    );
    $options['kra-meta-slider-shortcode'] = array(
        'id' => 'kra-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by meta slider.', 'dustlandexpress' )
    );
    // Upsell Button Two
    $options['kra-upsell-two-up'] = array(
        'id' => 'kra-upsell-two-up',
        'label'   => __( 'Extra Settings', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );


	// Colors
	$section = 'kra-styling';
    $font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Styling Options', 'dustlandexpress' ),
		'priority' => '38'
	);

	$options['kra-main-color'] = array(
		'id' => 'kra-main-color',
		'label'   => __( 'Main Color', 'dustlandexpress' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	$options['kra-main-color-hover'] = array(
		'id' => 'kra-main-color-hover',
		'label'   => __( 'Secondary Color', 'dustlandexpress' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    
    $options['kra-body-font'] = array(
        'id' => 'kra-body-font',
        'label'   => __( 'Body Font', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['kra-body-font-color'] = array(
        'id' => 'kra-body-font-color',
        'label'   => __( 'Body Font Color', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );
    $options['kra-heading-font'] = array(
        'id' => 'kra-heading-font',
        'label'   => __( 'Headings Font', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Raleway'
    );
    $options['kra-heading-font-color'] = array(
        'id' => 'kra-heading-font-color',
        'label'   => __( 'Heading Font Color', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    $options['kra-custom-css'] = array(
        'id' => 'kra-custom-css',
        'label'   => __( 'Custom CSS', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( '', 'dustlandexpress'),
        'description' => __( 'Add custom CSS to your theme', 'dustlandexpress' )
    );
    
    
    // Blog Settings
    $section = 'kra-blog';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog Options', 'dustlandexpress' ),
        'priority' => '50'
    );
    
    $choices = array(
        'blog-post-side-layout' => 'Side Layout',
        'blog-post-top-layout' => 'Top Layout'
    );
    $options['kra-blog-layout'] = array(
        'id' => 'kra-blog-layout',
        'label'   => __( 'Blog Post Layout', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-post-side-layout'
    );
    $options['kra-blog-title'] = array(
        'id' => 'kra-blog-title',
        'label'   => __( 'Blog Page Title', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'Blog'
    );
    $options['kra-blog-cats'] = array(
        'id' => 'kra-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'dustlandexpress' )
    );
    // Upsell Button Two
    $options['kra-upsell-two-up-up'] = array(
        'id' => 'kra-upsell-two-up-up',
        'label'   => __( 'Extra Blog Full Width Setting', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Social Settings
    $section = 'kra-social';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'dustlandexpress' ),
        'priority' => '80'
    );
    
    $options['kra-social-email'] = array(
        'id' => 'kra-social-email',
        'label'   => __( 'Email Address', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['kra-social-facebook'] = array(
        'id' => 'kra-social-facebook',
        'label'   => __( 'Facebook', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['kra-social-twitter'] = array(
        'id' => 'kra-social-twitter',
        'label'   => __( 'Twitter', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['kra-social-instagram'] = array(
        'id' => 'kra-social-instagram',
        'label'   => __( 'Instagram', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
    );
    // Upsell Button Three
    $options['kra-upsell-three'] = array(
        'id' => 'kra-upsell-three',
        'label'   => __( 'More Social Links', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Site Text Settings
    $section = 'kra-website';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Website Text', 'dustlandexpress' ),
        'priority' => '50'
    );
    
    $options['kra-header-info-text'] = array(
        'id' => 'kra-header-info-text',
        'label'   => __( 'Header Info Text', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Call Us: 082 444 BOOM', 'dustlandexpress'),
        'description' => __( 'This is the text in the header', 'dustlandexpress' )
    );
    // Upsell Button Four
    $options['kra-upsell-four'] = array(
        'id' => 'kra-upsell-four',
        'label'   => __( 'Site Copy Text', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['kra-website-error-head'] = array(
        'id' => 'kra-website-error-head',
        'label'   => __( '404 Error Page Heading', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'dustlandexpress'),
        'description' => __( 'Enter the heading for the 404 Error page', 'dustlandexpress' )
    );
    $options['kra-website-error-msg'] = array(
        'id' => 'kra-website-error-msg',
        'label'   => __( 'Error 404 Message', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'dustlandexpress'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'dustlandexpress' )
    );
    $options['kra-website-nosearch-msg'] = array(
        'id' => 'kra-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'dustlandexpress' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dustlandexpress'),
        'description' => __( 'Enter the default text for when no search results are found', 'dustlandexpress' )
    );

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_dustlandexpress_options' );
