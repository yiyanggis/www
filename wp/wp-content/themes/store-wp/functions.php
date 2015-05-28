<?php
/**
 * store-wp functions and definitions
 *
 * @package Store WP
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 770; /* pixels */
}

if ( ! function_exists( 'store_wp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function store_wp_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'store-wp', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    //Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    //Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    //This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'store-wp' ),
        'header-menu' => __( 'Header Menu', 'store-wp' ),
    ) );

    //Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    //Enable support for Post Formats.
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'store_wp_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif; // store_wp_setup
add_action( 'after_setup_theme', 'store_wp_setup' );

//Implement the Custom Header feature.
require get_template_directory() . '/core-framework/custom-header.php';

//Custom template tags for this theme.
require get_template_directory() . '/core-framework/template-tags.php';

//Custom functions that act independently of the theme templates.
require get_template_directory() . '/core-framework/extras.php';

//Customizer additions.
require get_template_directory() . '/core-framework/customizer.php';

//Load Jetpack compatibility file.
require get_template_directory() . '/core-framework/jetpack.php';

//Core Framework.
require get_template_directory() . '/core-framework/func/function-action.php';
require get_template_directory() . '/core-framework/func/function-widget.php';
require get_template_directory() . '/core-framework/func/function-script.php';
require get_template_directory() . '/core-framework/partials/page-metabox.php';

//Loads the Options Panel
define( 'IGTHEMES_OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/core-framework/options/' );
require_once dirname( __FILE__ ) . '/core-framework/options/options-framework.php';
// Loads options.php from child or parent theme
$igthemes_optionsfile = locate_template( 'options.php' );
load_template( $igthemes_optionsfile );

/*-----------------------------------------------
 * Add favicon.
 -----------------------------------------------*/
function store_wp_favicon() { ?>
<?php if ( igthemes_get_option('favicon')) { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(igthemes_get_option( 'favicon', '' )); ?>" />
<?php } ?>
<?php if ( igthemes_get_option('icon_iphone')) { ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url(igthemes_get_option( 'icon_iphone', '' )); ?>">
<?php } ;?>
<?php if ( igthemes_get_option('icon_ipad')) { ?>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url(igthemes_get_option( 'icon_ipad', '' )); ?>">
<?php } ?>
<?php if ( igthemes_get_option('icon_iphone_retina')) { ?>
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url(igthemes_get_option( 'icon_iphone_retina', '' )); ?>">
<?php } ?>
<?php if ( igthemes_get_option('icon_ipad_retina')) { ?>
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url(igthemes_get_option( 'icon_ipad_retina', '' )); ?>">
<?php } ?>
<?php if ( igthemes_get_option('win_tile_image')) { ?>
    <meta name="msapplication-TileImage" content="<?php echo esc_url(igthemes_get_option( 'win_tile_image', '' )); ?>"/>
<?php } ?>
<?php if ( igthemes_get_option('win_tile_color')) { ?>
    <meta name="msapplication-TileColor" content="<?php echo esc_attr(igthemes_get_option( 'win_tile_color', '' )); ?>"/>
<?php } ?>
<?php }
add_action('wp_head', 'store_wp_favicon');

/*-----------------------------------------------
 * Custom excerpt length
 -----------------------------------------------*/
function store_wp_custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'store_wp_custom_excerpt_length', 999 );

/*-----------------------------------------------
 * Woocommerce support.
 -----------------------------------------------*/
add_theme_support( 'woocommerce' );

//add custom ecommerce link to menu
add_filter( 'wp_nav_menu_items', 'store_wp_woocommerce_menu_item', 10, 2 );
function store_wp_woocommerce_menu_item ( $items, $args ) {
    if ( class_exists( 'WooCommerce' ) && is_user_logged_in() && $args->theme_location == 'header-menu') {
        $items .= '<li><a href="'. esc_url( get_permalink(get_option("woocommerce_myaccount_page_id")) ) .'">'. __("Account", "store-wp").'</a></li>
                   <li><a href="'. esc_url( get_permalink(get_option("woocommerce_cart_page_id")) ) .'">'. __("Cart", "store-wp").'</a></li>
                   <li><a href="'. esc_url( wp_logout_url('$index.php') ) .'">'. __("Log out", "store-wp").'</a></li>';

    }
    elseif ( class_exists( 'WooCommerce' ) && !is_user_logged_in() && $args->theme_location == 'header-menu') {
        $items .= '<li><a href="'. esc_url( get_permalink( get_option("woocommerce_myaccount_page_id")) ) .'">'. __("Log in", "store-wp").'</a></li>';
    }
    return $items;
}
