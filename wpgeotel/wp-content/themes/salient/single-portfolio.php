<?php get_header(); ?>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
			<div class="col span_12 section-title project-title <?php if(empty($options['portfolio_social']) || $options['portfolio_social'] == 0 || empty($options['portfolio_date']) || $options['portfolio_date'] == 0 ) echo 'no-date'?>">
				<h1><?php the_title(); ?></h1>
					<?php 
					$options = get_option('salient'); 
					
					if( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1  && !empty($options['portfolio_date']) && $options['portfolio_date'] == 1) { ?>
						<ul class="project-additional">
							<li>
								<?php the_time('F d, Y'); ?>
							</li>
						</ul><!--project-additional-->
					<?php } ?>
							
				<?php  
				
				//attempt to find parent portfolio page - if unsuccessful default to main portfolio page
				global $post;
				$terms = get_the_terms($post->id,"project-type");
				$project_cat = null;
				$portfolio_link = null; 
				
			    if(empty($terms)) $terms = array('1' => (object) array('name' => 'nothing'));
				
		     	 foreach ( $terms as $term ) {
		      	 	$project_cat = strtolower($term->name);
		     	 }
				 
				 $page = get_page_by_title_search($project_cat);
				 if(empty($page)) $page = array( '0' => (object) array('ID' => 'nothing'));
				 
				 $page_link = verify_portfolio_page($page[0]->ID);
	
				 //if a page has been found for the category
				 if(!empty($page_link)) {
				 	$portfolio_link = $page_link; ?>
					 
					 <div id="portfolio-nav">
						<ul>                                           
							<li id="prev-link"><?php be_next_post_link('%link','<i class="icon-angle-left"></i>',TRUE, null,'project-type'); ?></li>
							<li id="all-items"><a href="<?php echo $portfolio_link; ?>"><i class="icon-th"></i></a></li> 
							<li id="next-link"><?php be_previous_post_link('%link','<i class="icon-angle-right"></i>',TRUE, null, 'project-type'); ?></li> 
						</ul>
					</div>
					 
			<?php  } 
				 
				 //if no category page exists
				 else {
				 	$portfolio_link = get_portfolio_page_link(get_the_ID()); 
					if(!empty($options['main-portfolio-link'])) $portfolio_link = $options['main-portfolio-link']; ?>
					
					<div id="portfolio-nav">
						<ul>                                           
							<li id="prev-link"><?php next_post_link('%link','<i class="icon-angle-left"></i>'); ?></li>
							<li id="all-items"><a href="<?php echo $portfolio_link; ?>"><i class="icon-th"></i></a></li> 
							<li id="next-link"><?php previous_post_link('%link','<i class="icon-angle-right"></i>'); ?></li> 
						</ul>
					</div>
			 <?php } ?>
				
			</div>
		</div> 
	
		<?php $enable_gallery_slider = get_post_meta( get_the_ID(), '_nectar_gallery_slider', true ); ?>
		
		<div class="row <?php if(!empty($enable_gallery_slider) && $enable_gallery_slider == 'on') echo 'gallery-slider'; ?>">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<div id="post-area" class="col span_9">
					
					<?php 
					
						$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
						$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
						$video_ogv = get_post_meta($post->ID, '_nectar_video_ogv', true); 
						$video_poster = get_post_meta($post->ID, '_nectar_video_poster', true); 
				
						//Gallery
						$wp_version = floatval(get_bloginfo('version'));
						  
						if(class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide') || !empty($enable_gallery_slider) && $enable_gallery_slider == 'on'){
							
							if ( $wp_version < "3.6" ) {
								if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide')) {
									nectar_gallery($post->ID);
								}
							}
							else {
								
								if(!empty($enable_gallery_slider) && $enable_gallery_slider == 'on') { $gallery_ids = grab_ids_from_gallery(); ?>
							
								<div class="flex-gallery"> 
									 <ul class="slides">
									 	<?php 
										foreach( $gallery_ids as $image_id ) {
										     echo '<li>' . wp_get_attachment_image($image_id, '', false, $attr) . '</li>';
										} ?>
							    	</ul>
						   	  </div><!--/gallery-->
						   	  	
						   	 <?php }	
								
							}
							
						}
						
						//Video
						else if( !empty($video_embed) || !empty($video_m4v) ){
							
				             $wp_version = floatval(get_bloginfo('version'));
										
							//video embed
							if( !empty( $video_embed ) ) {
								
					             echo '<div class="video">' . do_shortcode($video_embed) . '</div>';
								
					        } 
					        //self hosted video pre 3-6
					        else if( !empty($video_m4v) && $wp_version < "3.6") {
					        	
					        	 echo '<div class="video">'; 
					            	 nectar_video($post->ID); 
								 echo '</div>'; 
								 
					        } 
					        //self hosted video post 3-6
					        else if($wp_version >= "3.6"){
				
					        	if(!empty($video_m4v) || !empty($video_ogv)) {
					        		
									$video_output = '[video ';
									
									if(!empty($video_m4v)) { $video_output .= 'mp4="'. $video_m4v .'" '; }
									if(!empty($video_ogv)) { $video_output .= 'ogv="'. $video_ogv .'"'; }
									
									$video_output .= ' poster="'.$video_poster.'"]';
									
					        		echo '<div class="video">' . do_shortcode($video_output) . '</div>';	
					        	}
					        }
							
						}
						
						//Regular Featured Img
						else {
							 
							if (has_post_thumbnail()) { echo get_the_post_thumbnail($post->ID, 'full', array('title' => '')); } else {
								echo '<img src="'.get_template_directory_uri().'/img/no-portfolio-item.jpg" alt="no image added yet." />'; 
							}
						}
					?>
					
					<?php
						//extra content 
						$options = get_option('salient'); 
						if(!empty($options['portfolio_extra_content']) && $options['portfolio_extra_content'] == 1) {
							
							$portfolio_extra_content = get_post_meta($post->ID, '_nectar_portfolio_extra_content', true);
							
							if(!empty($portfolio_extra_content)){
								echo '<div id="portfolio-extra">';
								
								$extra_content = shortcode_empty_paragraph_fix(apply_filters( 'the_content', $portfolio_extra_content ));
								echo do_shortcode($extra_content);
								
								echo '<div class="clear"></div></div>';
							}
						}
					?>
					
					<div class="comments-section">
		   			   <?php comments_template(); ?>
					 </div>   
					 
				</div><!--/span_9-->
				
				
				
				<div id="sidebar" class="col span_3 col_last" data-follow-on-scroll="<?php echo (!empty($options['portfolio_sidebar_follow']) && $options['portfolio_sidebar_follow'] == 1) ? 1 : 0; ?>">
								
					<div id="sidebar-inner">
						
						<div id="project-meta" data-sharing="<?php echo ( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1 ) ? '1' : '0'; ?>">
							
							<ul class="sharing">
								<li>
									<div class="nectar-love-wrap <?php if( $options['portfolio_date'] == 0 && $options['portfolio_social'] == 0 ) echo 'no-border'; ?> <?php if( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1 ) echo 'fadein'; ?>">
										<?php if( function_exists('nectar_love') ) nectar_love(); ?>
									</div><!--/nectar-love-wrap-->
								</li>
								
								<?php if(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
									   if( empty($options['portfolio_social']) || $options['portfolio_social'] == 0 ) { ?>
									   	
										<li>
											<?php the_time('F d, Y'); ?>
										</li>
								
									<?php } 
								    
								    } 
								
								    // portfolio social sharting icons
									if( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1 ) {
											
										//facebook
										if(!empty($options['portfolio-facebook-sharing']) && $options['portfolio-facebook-sharing'] == 1) {
											echo '<li class="facebook-share"><a href="#" title="Share this"><span class="count"></span></a></li>';
										}
										//twitter
										if(!empty($options['portfolio-twitter-sharing']) && $options['portfolio-twitter-sharing'] == 1) {
											echo '<li class="twitter-share"><a href="#" title="Tweet this"><span class="count"></span></a></li>';
										}
										//pinterest
										if(!empty($options['portfolio-pinterest-sharing']) && $options['portfolio-pinterest-sharing'] == 1) {
											echo '<li class="pinterest-share"><a href="#" title="Pin this"><span class="count"></span></a></li>';
										}
										
									}
								?>
							</ul><!--sharing-->
			
							<div class="clear"></div>
						</div><!--project-meta-->
						
						<?php the_content(); ?>
						
						
						<?php 
						$project_attrs = get_the_terms( $post->ID, 'project-attributes' );
						 if (!empty($project_attrs)){ ?>
							<ul class="project-attrs checks">
								<?php 
								foreach($project_attrs as $attr){
									echo '<li>' . $attr->name . '</li>';
								}	 
								?>
							</ul>
						<?php } ?>
					
		
					</div>
					
				</div><!--/sidebar-->
				
			<?php endwhile; endif; ?>
			
		</div>
		
	</div><!--/container-->

</div><!--/container-wrap-->
	
<?php get_footer(); ?>