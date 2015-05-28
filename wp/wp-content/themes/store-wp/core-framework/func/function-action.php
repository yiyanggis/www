<?php
/*-----------------------------------------------
 * Custom action
 -----------------------------------------------*/
//1.0 igthemes_header
function igthemes_header() {
    do_action('igthemes_header');
}
//2.0 igthemes_footer
function igthemes_footer() {
    do_action('igthemes_footer');
}
// 3.0 igthemes_before_content
function igthemes_before_content() {
    do_action('igthemes_before_content');
}
// 4.0 igthemes_after_content
function igthemes_after_content() {
    do_action('igthemes_after_content');
}
// 5.0 igthemes_before_post
function igthemes_before_post() {
    do_action('igthemes_before_post');
}
// 6.0 igthemes_after_post
function igthemes_after_post() {
    do_action('igthemes_after_post');
}
// 7.0 igthemes_before_post_content
function igthemes_before_post_content() {
    do_action('igthemes_before_post_content()');
}
// 8.0 igthemes_after_post_content
function igthemes_after_post_content() {
    do_action('igthemes_after_post_conten');
}
// 9.0 igthemes_before_post_title
function igthemes_before_post_title() {
    do_action('igthemes_before_post_title');
}
// 10.0 igthemes_after_post_title
function igthemes_after_post_title() {
    do_action('igthemes_after_post_title');
}

/*-----------------------------------------------
 * 1.0 igthemes_header
 -----------------------------------------------*/
// logo
function igthemes_header_branding() { ?>
<div class="site-branding col12">
    <?php if ( get_header_image() ) : ?>
            <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" class="header-image">
    <?php endif; // End header image check. ?>
    <?php if ( igthemes_get_option('logo') ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <img src="<?php echo esc_url(igthemes_get_option('logo')); ?>" alt="<?php echo esc_attr( bloginfo( 'name' )); ?>"></a>
    <?php else : ?>
    <h1 class="site-title">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    </h1>
        <?php endif; ?>
</div><!-- .site-branding -->
<?php }
add_action( 'igthemes_header' , 'igthemes_header_branding' );

/*-----------------------------------------------
 * 2.0 igthemes_footer
 -----------------------------------------------*/
// scroll to top
function igthemes_footer_gotop() { ?>
    <a href="#masthead" id="smoothup" title="<?php esc_attr_e('Back to top', 'store-wp' ); ?>"><?php echo __( 'TOP', 'store-wp' ); ?></a>
<?php }
add_action( 'igthemes_footer' , 'igthemes_footer_gotop' );

//credits
function igthemes_footer_credits() { ?>
    <div class="credits">
        <?php printf( __( 'Proudly powered by ', 'store-wp' )); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'store-wp' ) ); ?>"><?php printf( __( '%s', 'store-wp' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <?php printf( __( 'Theme: %1$s by %2$s.', 'store-wp' ), 'Store WP', '<a href="http://iograficathemes.com/" rel="designer">Iografica Themes</a>' ); ?>
    </div>
<?php }
add_action( 'igthemes_footer' , 'igthemes_footer_credits' );

/*-----------------------------------------------
 * 4.0 igthemes_after_content.
 -----------------------------------------------*/
//featured image
function igthemes_after_content_sidebar() { ?>
    <?php get_sidebar();?>
<?php }
add_action( 'igthemes_after_content' , 'igthemes_after_content_sidebar' );

/*-----------------------------------------------
 * 5.0 igthemes_before_post
 -----------------------------------------------*/
//Breadcrumb
function igthemes_breadcrumb() {
if (igthemes_get_option('breadcrumb') == '1') {
    echo '<div class="breadcrumb">';
    if (!is_home())  {
        echo '<a href="'. esc_url(home_url('/')) .'">';
        echo __('Home', 'store-wp');
        echo '</a> &#47; ';
        if (is_category() || is_single()) {
            the_category(' &#47; ');
            if (is_single()) {
                echo ' &#47; ';
                the_title();
            }
        }
        elseif (is_page()) {
            echo the_title();
        }
        elseif (is_archive()) {
            echo single_month_title();
            echo single_tag_title("", false);
        }
    }
        echo '</div>';
    }
}
add_action( 'igthemes_before_post' , 'igthemes_breadcrumb' );

/*-----------------------------------------------
 * 7.0 igthemes_before_post_content
 -----------------------------------------------*/
//featured image
function igthemes_featured_image() { ?>
<?php if ( igthemes_get_option("post-featured-images") && has_post_thumbnail()) {
        the_post_thumbnail( 'large', array( 'class' => 'featured-img' ) );} ?>
<?php }
add_action( 'igthemes_before_post_content' , 'igthemes_featured_image' );
