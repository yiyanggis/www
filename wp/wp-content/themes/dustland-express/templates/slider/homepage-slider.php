<?php
if ( get_theme_mod( 'kra-slider-type', false ) == 'kra-no-slider' ) : ?>
    
    <!-- No Slider -->
    
<?php
elseif ( get_theme_mod( 'kra-slider-type', false ) == 'kra-meta-slider' ) : ?>
    
    <?php
    $slider_code = '';
    if ( get_theme_mod( 'kra-meta-slider-shortcode', false ) ) {
        $slider_code = get_theme_mod( 'kra-meta-slider-shortcode' );
    } ?>
    
    <?php echo do_shortcode( esc_html( $slider_code ) ); ?>
    
<?php else : ?>
    
    <?php
    $slider_cats = '';
    if ( get_theme_mod( 'kra-slider-cats', false ) ) {
        $slider_cats = get_theme_mod( 'kra-slider-cats' );
    } ?>
    
    <?php if( $slider_cats ) : ?>
        
        <?php $slider_query = new WP_Query( 'cat=' . esc_html( $slider_cats ) . '&posts_per_page=-1&orderby=date&order=DESC' ); ?>
        
        <?php if ( $slider_query->have_posts() ) : ?>

            <div class="home-slider-wrap home-slider-remove">
                <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
                <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
                <div class="home-slider">
                    
                    <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                    
                        <div>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                            
                                <?php the_post_thumbnail( 'full', array( 'class' => '' ) ); ?>
                                
                            <?php endif; ?>
                            
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            
                        </div>
                    
                    <?php endwhile; ?>
                    
                </div>
                <div class="home-slider-pager"></div>
            </div>
            
        <?php endif; wp_reset_query(); ?>
        
    <?php else : ?>
        
        <div class="home-slider-wrap home-slider-remove">
            <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
            <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
            <div class="home-slider">
                
                <div>
                    
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/slider_default_01.jpg" alt="<?php esc_attr_e('Demo Slide One', 'dustlandexpress') ?>" />
                    
                    <h3>
                        <?php _e( 'Castles in the sky', 'dustlandexpress' ); ?>
                    </h3>
                    
                </div>
                
                <div>
                    
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/slider_default_02.jpg" alt="<?php esc_attr_e('Demo Slide Two', 'dustlandexpress') ?>" />
                    
                    <h3>
                        <?php _e( 'Nemesis - The Dark Dancer', 'dustlandexpress' ); ?>
                    </h3>
                    
                </div>
                
            </div>
            <div class="home-slider-pager"></div>
        </div>

    <?php endif; ?>
    
<?php endif; ?>