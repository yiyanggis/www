<?php
/**
 * @package Store WP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <?php do_action('igthemes_before_post_title'); ?>
        <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        <?php do_action('igthemes_after_post_title'); ?>
        <?php if ( 'post' == get_post_type() ) : ?>
        <div class="entry-meta">
            <?php igthemes_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php do_action('igthemes_before_post_content'); ?>
        <?php
            /* translators: %s: Name of current post */
            the_content( sprintf(
                __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'store-wp' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
        ?>
        <?php do_action('igthemes_after_post_content'); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'store-wp' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php igthemes_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
