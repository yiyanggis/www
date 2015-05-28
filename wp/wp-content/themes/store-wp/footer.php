<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Store WP
 */
?>
</div><!-- .row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		  <div class="site-info grid-1200">
            <div class="row">
            <?php get_template_part('core-framework/partials/sidebar-footer') ?>
            <?php get_template_part('core-framework/partials/social') ?>
            </div><!-- .row -->
		</div><!-- .site-info -->
			<?php igthemes_footer(); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
