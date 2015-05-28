<?php
/**
 * The template for displaying all single posts.
 *
 * @package Store WP
 */

get_header(); ?>

<?php igthemes_before_content(); ?>
    <div id="primary" class="content-area col8">
        <main id="main" class="site-main" role="main">
<?php do_action('igthemes_before_post'); ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'single' ); ?>
            <?php igthemes_post_nav(); ?>
<?php do_action('igthemes_after_post'); ?>
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>
        <?php endwhile; // end of the loop. ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php igthemes_after_content(); ?>

<?php get_sidebar();?>
<?php get_footer(); ?>
