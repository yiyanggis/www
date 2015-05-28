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

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    igthemes_archive_title( '<h1 class="page-title">', '</h1>' );
                    igthemes_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                    /* Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );
                ?>

             <?php endwhile; ?>

                   <?php if ( igthemes_get_option('main-numeric-pagination') == '1' ) { igthemes_numeric_paging(); } else {igthemes_paging_nav(); }?>

              <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar();?>

<?php get_footer(); ?>
