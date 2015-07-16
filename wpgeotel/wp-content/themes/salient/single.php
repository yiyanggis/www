<?php get_header(); ?>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<?php if(get_post_format() != 'quote' && get_post_format() != 'status' && get_post_format() != 'aside') { ?>
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="row">
					<div class="col span_12 section-title blog-title">
						<h1><?php wp_title("",true); ?></h1>
						
						<div id="single-below-header">
							<?php echo __('Posted by', NECTAR_THEME_NAME); ?> <?php the_author_posts_link(); ?>  
							<?php if( !empty($options['blog_social']) && $options['blog_social'] == 1) { ?>
								| <?php the_time('F d, Y'); ?>
							<?php } ?>
							|
							<?php the_category(', '); ?> | <a href="<?php comments_link(); ?>">
							<?php comments_number( __('No Comments', NECTAR_THEME_NAME), __('One Comment ', NECTAR_THEME_NAME), __('% Comments', NECTAR_THEME_NAME) ); ?></a>
							
						</ul><!--project-additional-->
						</div><!--/single-below-header-->
						
						<div id="single-meta" data-sharing="<?php echo ( !empty($options['blog_social']) && $options['blog_social'] == 1 ) ? '1' : '0'; ?>">
							<ul>
								<li>
									<div class="nectar-love-wrap <?php if( !empty($options['blog_social']) && $options['blog_social'] == 1 ) echo 'fadein'; ?>">
										<?php if( function_exists('nectar_love') ) nectar_love(); ?>
									</div><!--/nectar-love-wrap-->
								</li>
								
								<?php
								// portfolio social sharting icons
									if( !empty($options['blog_social']) && $options['blog_social'] == 1 ) {
											
										//facebook
										if(!empty($options['blog-facebook-sharing']) && $options['blog-facebook-sharing'] == 1) {
											echo '<li class="facebook-share"><a href="#" title="Share this"><span class="count"></span></a></li>';
										}
										//twitter
										if(!empty($options['blog-twitter-sharing']) && $options['blog-twitter-sharing'] == 1) {
											echo '<li class="twitter-share"><a href="#" title="Tweet this"><span class="count"></span></a></li>';
										}
										//pinterest
										if(!empty($options['blog-pinterest-sharing']) && $options['blog-pinterest-sharing'] == 1) {
											echo '<li class="pinterest-share"><a href="#" title="Pin this"><span class="count"></span></a></li>';
										}
										
									} ?>
								
								
								<?php  if( empty($options['blog_social']) || $options['blog_social'] == 0 ) { ?>
									   	
										<li>
											<?php the_time('F d, Y'); ?>
										</li>
								
								<?php } ?>
	
							</ul>
						</div><!--/single-meta-->
					</div><!--/section-title-->
				</div><!--/row-->
				
			<?php endwhile; endif; ?>
			
		<?php } ?>
			
		<div class="row">
			
			<?php $options = get_option('salient'); 
			$blog_type = $options['blog_type']; 
			
			if($blog_type == 'std-blog-fullwidth'){
				echo '<div id="post-area" class="col span_12 col_last">';
			} else {
				echo '<div id="post-area" class="col span_9">';
			}
			
				 if(have_posts()) : while(have_posts()) : the_post(); 
					
					
					$wp_version = floatval(get_bloginfo('version'));
		
					if ( $wp_version < "3.6" ) {
						//old post formats before they got built into the core
						 get_template_part( 'includes/post-templates-pre-3-6/entry', get_post_format() ); 
					} else {
						//WP 3.6+ post formats
						 get_template_part( 'includes/post-templates/entry', get_post_format() ); 
					} 
	
				 endwhile; endif; 
				
				 wp_link_pages(); 
				
				    $options = get_option('salient');
					if( !empty($options['author_bio']) && $options['author_bio'] == true ){ 
						$grav_size = 80;
					?>
						
						<div id="author-bio">
							<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), $grav_size ); }?>
							<div id="author-info">
								<h3>About <?php the_author(); ?></h3>
								<p><?php the_author_meta('description'); ?></p>
							</div>
							
							<div class="clear"></div>
							
						</div>
						
				<?php } ?>
				
				<div class="comments-section">
	   			   <?php comments_template(); ?>
				 </div>   
				 
			</div><!--/span_9-->
			
			<?php if($blog_type != 'std-blog-fullwidth') { ?>
				
				<div id="sidebar" class="col span_3 col_last">
					<?php get_sidebar(); ?>
				</div><!--/sidebar-->
				
			<?php } ?>
			
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->
	
<?php get_footer(); ?>