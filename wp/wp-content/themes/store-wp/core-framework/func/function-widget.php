<?php
/*-----------------------------------------------
 * Footer widgets
 -----------------------------------------------*/
function store_wp_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'store-wp' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

// Area footer 1, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'store-wp' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'store-wp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

// Area footer 2, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'store-wp' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'store-wp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

// Area footer 3, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'store-wp' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'store-wp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

// Area footer 4, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'store-wp' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'store-wp' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
// Area footer 4, located in the footer. Empty by default.
    register_sidebar( array(
        'name'          => __( 'Sidebar shop', 'store-wp' ),
        'id'            => 'sidebar-shop',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'store_wp_widgets_init');
