<?php 

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/../wp-includes/query.php' );

$block1Featured= new WP_Query();

if ( have_posts() ) : ?>
	<!-- WordPress has found matching posts -->
<?php else : ?>
	<!-- No matching posts, show an error -->
	<h1>Error 404 &mdash; Page not found.</h1>
<?php endif; ?>


