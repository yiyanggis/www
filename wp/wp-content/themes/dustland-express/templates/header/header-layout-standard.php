<?php global $woocommerce; ?>

<?php if( get_theme_mod( 'kra-show-header-top-bar', false ) ) : ?>
    
    <div class="site-top-bar border-bottom">
        <div class="site-container">
            
            <div class="site-top-bar-left">
                
                <?php get_template_part( '/templates/social-links' ); ?>
                
            </div>
            <div class="site-top-bar-right">
                
                <?php
                if ( dustlandexpress_is_woocommerce_activated() ) { ?>
                    <div class="site-top-bar-right-text"><?php echo wp_kses_post( get_theme_mod( 'kra-header-info-text', 'Call Us: 082 444 BOOM' ) ) ?></div>
                <?php
                } ?>
                
                <?php
                if( get_theme_mod( 'kra-header-search', false ) ) :
                    echo '<i class="fa fa-search search-btn"></i>';
                endif; ?>
                
            </div>
            <div class="clearboth"></div>
            
            <?php if( get_theme_mod( 'kra-header-search', false ) ) : ?>
                <div class="search-block">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
            
        </div>
        
    </div>

<?php endif; ?>

<div class="site-container">
    
    <div class="site-header-left">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    </div><!-- .site-branding -->
    
    <div class="site-header-right">
        
        <?php
        if ( dustlandexpress_is_woocommerce_activated() ) { ?>
        
            <div class="header-cart">
                <a class="header-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'dustlandexpress'); ?>">
                    <span class="header-cart-amount">
                        <?php echo $woocommerce->cart->get_cart_total(); ?> <?php echo sprintf(_n('(%d)', '(%d)', $woocommerce->cart->cart_contents_count, 'dustlandexpress'), $woocommerce->cart->cart_contents_count);?>
                    </span>
                    <span class="header-cart-checkout<?php echo ( $woocommerce->cart->cart_contents_count > 0 ) ? ' cart-has-items' : ''; ?>">
                        <i class="fa fa-shopping-cart"></i>
                    </span>
                </a>
            </div>
            
        <?php
        } else { ?>
            
            <div class="site-top-bar-left-text"><?php echo wp_kses_post( get_theme_mod( 'kra-header-info-text', 'Call Us: 082 444 BOOM' ) ) ?></div>
            
        <?php
        } ?>
        
    </div>
    <div class="clearboth"></div>
    
</div>

<nav id="site-navigation" class="main-navigation" role="navigation">
    
    <div class="site-container">
        
        <button class="menu-toggle" aria-expanded="false"><?php _e( 'Menu', 'dustlandexpress' ); ?></button>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        
    </div>
    
</nav><!-- #site-navigation -->