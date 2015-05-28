<?php
/*-----------------------------------------------
 * Function script and styles
-----------------------------------------------*/
function igthemes_scripts() {
    wp_enqueue_style( 'igthemes-style', get_stylesheet_uri() );
//grid css
    wp_enqueue_style( 'igthemes-grid', get_template_directory_uri().'/core-framework/css/grid.css' );
//resposnive css
    wp_enqueue_style( 'igthemes-responsive', get_template_directory_uri().'/core-framework/css/responsive.css' );
//component css
    wp_enqueue_style( 'igthemes-component', get_template_directory_uri().'/core-framework/css/component.css' );
//woocommerce css
if ( class_exists( 'WooCommerce' )){
    wp_enqueue_style( 'igthemes-woocommerce', get_template_directory_uri().'/core-framework/css/woocommerce.css' );
}
//icon css
    wp_enqueue_style( 'igthemes-icon', get_template_directory_uri().'/core-framework/icon/icon.css' );
//lightbox css
if (is_singular() && 'product' != get_post_type() &&  igthemes_get_option('lightbox') == '1' ) {
    wp_enqueue_style( 'nivo-lightbox-css', get_template_directory_uri().'/core-framework/css/nivo-lightbox.css');
}
//carousel css
    wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri().'/core-framework/css/owl-carousel.css' );
//google font
    wp_enqueue_style( 'igthemes-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300' );

//lightbox js
if (is_singular() && 'product' != get_post_type() && igthemes_get_option('lightbox') == '1' ) {
    wp_enqueue_script( 'nivo-lightbox', get_template_directory_uri() . '/core-framework/js/nivo-lightbox.js',array('jquery'),'1.2.0',true);
}
//carousel js
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/core-framework/js/owl-carousel.js',array('jquery'),'1.3.3',true);
//nav js
    wp_enqueue_script( 'igthemes-navigation', get_template_directory_uri() . '/core-framework/js/navigation.js', array(), '1.0', true );
//main js
    wp_enqueue_script( 'igthemes-main-navigation', get_template_directory_uri() . '/core-framework/js/main.js', array(), '1.0', true );
//comment js
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}

}
add_action( 'wp_enqueue_scripts', 'igthemes_scripts' );

function igthemes_wp_head(){
    ?>
    <!--[if lt IE 9]>
       <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/core-framework/js/ie-fix.js"></script>
    <![endif]-->
    <!--[if IE 7]>
       <script src="<?php echo get_template_directory_uri(); ?>/core-framework/icon/lte-ie7.js"></script>
    <![endif]-->
    <?php
}
add_action('wp_head', 'igthemes_wp_head');
