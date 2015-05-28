<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Store WP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php do_action('igthemes_before_post_title'); ?>
        <?php if (get_post_meta( get_the_ID(), 'igthemes-page-title', TRUE ) !='yes') {
        the_title( '<h1 class="entry-title">', '</h1>'); } ?>
        <?php do_action('igthemes_after_post_title'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'store-wp' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="page-entry-footer">
        <?php edit_post_link( __( 'Edit', 'store-wp' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
