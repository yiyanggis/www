<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Store WP
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>
<div id="secondary" class="widget-area col4 last" role="complementary">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
