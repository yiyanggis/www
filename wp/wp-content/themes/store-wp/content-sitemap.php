<?php
/*
 * The template used for displaying page content in page-sitemap.php
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

<div class="col4">
<!-- Pages -->
    <h3><?php echo __('Pages', 'store-wp'); ?></h3>
    <ul><?php wp_list_pages("title_li=" ); ?></ul>
</div>

<div class="col4">
<!-- Posts -->
    <h3><?php echo __('Posts', 'store-wp'); ?></h3>
    <ul><?php wp_get_archives('type=postbypost'); ?></ul>
</div>

<div class="col4 last">
<!-- Authors -->
    <h3><?php echo __('Authors', 'store-wp'); ?></h3>
    <ul><?php wp_list_authors( 'optioncount=true'); ?></ul>

<!-- Categories -->
    <h3><?php echo __('Categories', 'store-wp'); ?></h3>
    <ul><?php wp_list_categories('title_li='); ?></ul>
</div>

    </div><!-- .entry-content -->
    <footer class="page-entry-footer">
        <?php edit_post_link( __( 'Edit', 'store-wp' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
