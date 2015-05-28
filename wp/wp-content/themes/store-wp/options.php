<?php

function igthemes_optionsframework_option_name() {
    $igthemes_optionsframework_settings = get_option('igthemes-optionsframework');

    // Edit 'options-theme-customizer' and set your own theme name instead
    $igthemes_optionsframework_settings['id'] = 'store-wp';
    update_option('igthemes-optionsframework', $igthemes_optionsframework_settings);
}
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */
function igthemes_optionsframework_options() {
    $upgrade_message = '<a class="upgrade-tag" href="http://www.iograficathemes.com/downloads/store-wp-premium/" target="_blank">' . __(' - only premium', 'store-wp') . '</a>';

    $options[] = array( "name" => __('General', 'store-wp'),
        "type" => "heading" );

    $options['favicon'] = array(
        "name" => __('Favicon', 'store-wp'),
        "desc" => __('Upload your favicon', 'store-wp'),
        "id" => "favicon",
        "type" => "upload" );

    $options['logo'] = array(
        "name" => __('Logo', 'store-wp'),
        "desc" =>  __('Upload your logo', 'store-wp'),
        "id" => "logo",
        "type" => "upload" );

    $options['icon_iphone'] = array(
        "name" => __('iPhone icon', 'store-wp'),
        "desc" =>  __('Apple touch icon iphone (57x57 px)', 'store-wp'),
        "id" => "icon_iphone",
        "type" => "upload" );

    $options['icon_ipad'] = array(
        "name" => __('iPad icon', 'store-wp'),
        "desc" =>  __('Apple touch icon ipad (76x76 px)', 'store-wp'),
        "id" => "icon_ipad",
        "type" => "upload" );

    $options['icon_iphone_retina'] = array(
        "name" => __('iPhone retina icon', 'store-wp'),
        "desc" =>  __('Apple touch icon iphone retina (120x120 px)', 'store-wp'),
        "id" => "icon_iphone_retina",
        "type" => "upload" );

    $options['icon_ipad_retina'] = array(
        "name" => __('iPad retina icon', 'store-wp'),
        "desc" =>  __('Apple touch icon ipad retina (152x152 px)', 'store-wp'),
        "id" => "icon_ipad_retina",
        "type" => "upload" );

    $options['win_tile_image'] = array(
        "name" => __('Windows 8 pinned image', 'store-wp'),
        "desc" =>  __('Pinned site Windows 8 (144x144 px)', 'store-wp'),
        "id" => "win_tile_image",
        "type" => "upload" );

    $options['win_tile_color'] = array(
        "name" => __('Windows 8 pinned image color', 'store-wp'),
        "desc" =>  __('Pinned site Windows 8 color', 'store-wp'),
        "id" => "win_tile_color",
        "type" => "color" );

     $options['lightbox'] = array(
            'name' => __( 'Lightbox', 'store-wp' ),
            'desc' => __( 'Enable image lightbox', 'store-wp' ),
            'id' => "lightbox",
            'std' => "0",
            'type' => "checkbox"
        );

    $options[] = array(
        'name' => __('Shortcodes', 'store-wp'),
        'desc' => __( 'Enable shortcodes', 'store-wp' ).$upgrade_message,
        'type' => 'info');

     $options['breadcrumb '] = array(
            'name' => __( 'Breadcrumb', 'store-wp' ),
            'desc' => __( 'Enable breadcrumb', 'store-wp' ),
            'id' => "breadcrumb",
            'std' => "0",
            'type' => "checkbox"
        );

    $options[] = array(
        "name" => __('Style', 'store-wp'),
        "type" => "heading" );

    $options[] = array(
        'name' => __('Header styling', 'store-wp'),
        'desc' => __( 'Header background color', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Header menu styling', 'store-wp'),
        'desc' => __( 'Custom menu colors', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Menu styling', 'store-wp'),
        'desc' => __( 'Custom menu colors', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Link styling', 'store-wp'),
        'desc' => __( 'Custom links color', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Button styling', 'store-wp'),
        'desc' => __( 'Custom button style', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Footer styling', 'store-wp'),
        'desc' => __( 'Custom background, headings, text and links color', 'store-wp' ).$upgrade_message,
        'type' => 'info');

    $options[] = array( "name" => __('Layout', 'store-wp'),
        "type" => "heading" );

    $options[] = array(
        'name' => __('Main layout', 'store-wp'),
        'desc' => __('Select the index page layout', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options['main-featured-images'] = array(
            'name' => __( 'Main featured images', 'store-wp' ),
            'desc' => __( 'Show featured images in index pages', 'store-wp' ),
            'id' => "main-featured-images",
            'std' => "0",
            'type' => "checkbox"
        );

    $options['main-numeric-pagination'] = array(
            'name' => __( 'Numeric Pagination', 'store-wp' ),
            'desc' => __( 'Numeric pagination in index pages', 'store-wp' ),
            'id' => "main-numeric-pagination",
            'std' => "0",
            'type' => "checkbox"
        );

    $options[] = array(
        'name' => __('Post layout', 'store-wp'),
        'desc' => __('Select the single post layout', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Post featured image', 'store-wp'),
        'desc' => __('Show featured images in posts', 'store-wp'),
        'id' => "post-featured-images",
        'std' => "0",
        'type' => "checkbox");

    $options[] = array(
        'name' => __('Post meta data', 'store-wp'),
        'desc' => __('Hide post meta data', 'store-wp').$upgrade_message,
        'type' => 'info');


    $options[] = array(
        'name' => __('Shop Layout', 'store-wp'),
        'desc' => __('Select shop page layout', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Shop Slide', 'store-wp'),
        'desc' => __('Show product slides', 'store-wp'),
        'id' => "shop-slide",
        'std' => "0",
        'type' => "checkbox");

    $options[] = array( "name" => __('Footer', 'store-wp'),
        "type" => "heading" );

    $options[] = array(
        'name' => __('Footer text', 'store-wp'),
        'desc' => __('Footer custom text', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Credits link', 'store-wp'),
        'desc' => __('Remove author credits', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options[] = array( "name" => __('Social', 'store-wp'),
        "type" => "heading" );

    $options[] = array(
        'name' => __('Facebook url', 'store-wp'),
        'desc' => __('Add the url of your Facebook page', 'store-wp'),
        'id' => 'facebook_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Twitter url', 'store-wp'),
        'desc' => __('Add the url of your Twitter page', 'store-wp'),
        'id' => 'twitter_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Google plus url', 'store-wp'),
        'desc' => __('Add the url of your Google Plus page', 'store-wp'),
        'id' => 'google_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Pinterest url', 'store-wp'),
        'desc' => __('Add the url of your Pinterest page', 'store-wp'),
        'id' => 'pinterest_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Tumblr url', 'store-wp'),
        'desc' => __('Add the url of your Tumblr page', 'store-wp'),
        'id' => 'tumblr_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Instagram url', 'store-wp'),
        'desc' => __('Add the url of your Instagram page', 'store-wp'),
        'id' => 'instagram_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Linkedin url', 'store-wp'),
        'desc' => __('Add the url of your Linkedin page', 'store-wp'),
        'id' => 'linkedin_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Dribbble url', 'store-wp'),
        'desc' => __('Add the url of your Dribbble page', 'store-wp'),
        'id' => 'dribbble_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Vimeo url', 'store-wp'),
        'desc' => __('Add the url of your Vimeo page', 'store-wp'),
        'id' => 'vimeo_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Youtube url', 'store-wp'),
        'desc' => __('Add the url of your Youtube page', 'store-wp'),
        'id' => 'youtube_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('RSS url', 'store-wp'),
        'desc' => __('Add the url of your RSS', 'store-wp'),
        'id' => 'rss_url',
        'std' => '',
        'type' => 'text');

    $options[] = array( "name" => __('Advanced', 'store-wp'),
        "type" => "heading" );

    $options[] = array(
        'name' => __('Custom css', 'store-wp'),
        'desc' => __('Add your custom css code', 'store-wp').$upgrade_message,
        'type' => 'info');

    $options[] = array(
        'name' => __('Custom javascript', 'store-wp'),
        'desc' => __('Add your custom js code', 'store-wp').$upgrade_message,
        'type' => 'info');

    return $options;
}
/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */
add_action( 'customize_register', 'igthemes_customizer_register' );
function igthemes_customizer_register($wp_customize) {
    /**
     * This is optional, but if you want to reuse some of the defaults
     * or values you already have built in the options panel, you
     * can load them into $options for easy reference
     */

    $options = igthemes_optionsframework_options();

    $wp_customize->add_section( 'general-settings', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Logo and favicon', 'store-wp' ),
        'description' => '',
        'panel' => '',
    ) );

//LOGO
    $wp_customize->add_setting( 'store-wp[logo]', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
        'label' => $options['logo']['name'],
        'settings' => 'store-wp[logo]',
        'section' => 'general-settings',

    ) ) );
//FAVICON
    $wp_customize->add_setting( 'store-wp[favicon]', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon', array(
        'label' => $options['favicon']['name'],
        'settings' => 'store-wp[favicon]',
        'section' => 'general-settings',
    ) ) );
}

/**
 * Adds the html that will appear in the sidebar module of the options panel.
 */
function igthemes_panel_info() { ?>
    <div id="optionsframework-sidebar">
        <div class="metabox-holder">
            <div class="postbox">
                <h3><?php _e( 'Store WP Premium', 'store-wp' ); ?></h3>
                    <div class="inside">
                    <?php echo sprintf(
                        '<p>%s</p><ul><li><strong>%s</strong></li><li>%s</li><li>%s</li><li>%s</li><li>%s</li></ul><p>%s</p>',
                        __( 'If you like this theme, considering supporting development by purchasing the premium version.', 'store-wp' ),
                        __( 'MAIN PREMIUM FEATURES', 'store-wp' ),
                        __( 'All options enabled', 'store-wp' ),
                        __( 'Premium shortcodes included', 'store-wp' ),
                        __( 'Priority support', 'store-wp' ),
                        __( 'Money back guarantee', 'store-wp' ),
                        '<a class="upgrade-button" href="http://www.iograficathemes.com/downloads/store-wp-premium/" rel="nofollow">' . __('upgrade to premium', 'store-wp') . '</a>'
                        )
                    ?>
                    </div>
            </div>
        </div>
    </div>
<?php }
add_action( 'igthemes_optionsframework_after','igthemes_panel_info' );

/**
 * Loads an additional CSS file for the options panel
 */

if ( is_admin() ) {
    $igthemes_page= 'appearance_page_igthemes-options-framework';
    add_action( "admin_print_styles-$igthemes_page", 'igthemes_option_styles', 100);
}

function igthemes_option_styles () {
    wp_enqueue_style(
        'igthemes-option-styles',
        get_stylesheet_directory_uri() .'/core-framework/options/css/option-styles.css'
    );
}
