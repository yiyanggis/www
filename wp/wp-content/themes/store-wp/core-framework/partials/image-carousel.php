<div id="image-slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
<?php
    $args = array( 'posts_per_page' => 16, 'post_type' => 'product', 'cat' => '', 'orderby' => 'post_date' );
    $product_carousel_query = new WP_Query( $args );
    if ( $product_carousel_query->have_posts() ) :
    $item = 0;
    while ( $product_carousel_query->have_posts() ) : $product_carousel_query->the_post();
    $item++;
    if ( $item == 16 ) {
       echo '<div class="item active">';
    }
    echo '<div class="item">';
    echo '<a href="'. esc_url( get_permalink() ) .'">';
    echo get_the_post_thumbnail();
    echo '</a>';
    echo '<div class="carousel-caption"><h6>'. get_the_title() .'</h6>';
        echo woocommerce_get_template( 'loop/price.php' );
    echo '<p>'.wp_trim_excerpt().'</p></div>';
echo '</div>';
if ( $item % 1 == 0 && $item != 16 ) {
    echo '</div><div class="item">'; }
endwhile;
    echo '</div>';
    wp_reset_postdata();
endif;
?>
    </div><!-- /.carousel-inner -->
</div><!-- /.carousel -->
