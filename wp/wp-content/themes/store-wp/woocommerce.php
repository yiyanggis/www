<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Store WP
 */

get_header(); ?>

 <div id="primary" class="content-area col8">
        <main id="main" class="site-main" role="main">
            <?php woocommerce_breadcrumb(); ?>
            <?php woocommerce_content(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar('shop');?>
<?php get_footer(); ?>
