<?php 

$options = get_option('salient'); 
global $post;
$cta_link = ( !empty($options['cta-btn-link']) ) ? $options['cta-btn-link'] : '#';

$exclude_pages = (!empty($options['exclude_cta_pages'])) ? $options['exclude_cta_pages'] : array(); 
if(!empty($options['cta-text']) && current_page_url() != $cta_link && !in_array($post->ID, $exclude_pages)) { ?>
	
<div id="call-to-action">
	<div class="container">
		<div class="triangle"></div>
		<span> <?php echo $options['cta-text']; ?> </span>
		<a href="<?php echo $cta_link ?>"><?php if(!empty($options['cta-btn'])) echo $options['cta-btn']; ?> </a>
	</div>
</div>

<?php } ?>

<div id="footer-outer">
	
	<?php if( !empty($options['enable-main-footer-area']) && $options['enable-main-footer-area'] == 1) { ?>
		
	<div id="footer-widgets">
		
		<div class="container">
			
			<div class="row">
				
				<div class="col span_3">
					
				      <!-- Footer widget area 1 -->
		              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 1') ) : else : ?>	
		              	  <div class="widget">		
						  	 <h4 class="widgettitle">Widget Area 1</h4>
						 	 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at ultricies lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta, odio eget gravida laoreet, felis enim rutrum massa, sit amet aliquet mi lacus id eros. Suspendisse aliquet.</p>
				     	  </div>
				     <?php endif; ?>
				</div><!--/span_3-->
				
				<div class="col span_3">
					 <!-- Footer widget area 2 -->
		             <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 2') ) : else : ?>	
		                  <div class="widget">			
						 	 <h4 class="widgettitle">Widget Area 2</h4>
						 	 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at ultricies lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta, odio eget gravida laoreet, felis enim rutrum massa, sit amet aliquet mi lacus id eros. Suspendisse aliquet.</p>
				     	  </div>
				     <?php endif; ?>
				     
				</div><!--/span_3-->
				
				<div class="col span_3">
					 <!-- Footer widget area 3 -->
		              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 3') ) : else : ?>		
		              	  <div class="widget">			
						  	<h4 class="widgettitle">Widget Area 3</h4>
						  	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at ultricies lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta, odio eget gravida laoreet, felis enim rutrum massa, sit amet aliquet mi lacus id eros. Suspendisse aliquet.</p>
						  </div>		   
				     <?php endif; ?>
				     
				</div><!--/span_3-->
				
				<div class="col span_3 col_last">
					 <!-- Footer widget area 4 -->
		              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 4') ) : else : ?>	
		              	<div class="widget">		
						    <h4>Widget Area 4</h4>
						    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at ultricies lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta, odio eget gravida laoreet, felis enim rutrum massa, sit amet aliquet mi lacus id eros. Suspendisse aliquet.</p>
						 </div><!--/widget-->	
				     <?php endif; ?>
				     
				</div><!--/span_3-->
				
			</div><!--/row-->
			
		</div><!--/container-->
	
	</div><!--/footer-widgets-->
	
	<?php } //endif for enable main footer area?>
		
		<div class="row" id="copyright">
			
			<div class="container">
				
				<div class="col span_9">
					<p> <?php if(!empty($options['footer-copyright-text'])) echo $options['footer-copyright-text']; ?> </p>
				</div><!--/span_9-->
	
				<div class="col span_3 col_last">
				 <a href="http://www.geo-tel.com/sitemap.xml">Sitemap</a>  |  <a href="http://www.geo-tel.com/contact">Contact</a>
				</div><!--/span_3-->
			
			</div><!--/container-->
			
		</div><!--/row-->
		
	
</div><!--/footer-outer-->

<?php if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') { echo '</div>'; } ?>

<?php if(!empty($options['back-to-top']) && $options['back-to-top'] == 1) { ?>
	<a id="to-top"><i class="icon-angle-up"></i></a>
<?php } ?>

<?php if(!empty($options['google-analytics'])) echo $options['google-analytics']; ?> 

<?php wp_footer(); ?>	



</body>
</html>