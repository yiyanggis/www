jQuery(document).ready(function($){
	
 
/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/
	
	$('#post-formats-select input').change(checkFormat);
	$('.wp-post-format-ui .post-format-options > a').click(checkFormat);
	 
	function checkFormat(){
		var format = $('#post-formats-select input:checked').attr('value');
		
		// For < WP 3.6
		//only run on the posts page
		if(typeof format != 'undefined'){
			
			if(format == 'gallery'){
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeIn(500);
			}
			
			else {
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeOut(500);
			}
			
			$('#post-body div[id^=nectar-metabox-post-]').hide();
			$('#post-body #nectar-metabox-post-'+format+'').stop(true,true).fadeIn(500);
					
		}
		
		// >= WP 3.6 
		else {
			var format = $(this).attr('data-wp-format');
			
			if( typeof format == 'undefined' && $('a[data-wp-format="gallery"]').hasClass('active')){
				format = $('a[data-wp-format="gallery"]').attr('data-wp-format');
			}
			
			if(typeof format != 'undefined'){
			
				if(format == 'gallery'){
					$('#nectar-metabox-post-gallery').stop(true,true).fadeIn(500);
				}
				
				else {
					$('#nectar-metabox-post-gallery').stop(true,true).fadeOut(500);
				}
				
			}
		}
	
	}
	 
	$(window).load(function(){
		checkFormat();
	})
	
	//default gallery featured image hide
	$('#poststuff div[id$=slide][id^=post]').hide();
	
	if($('.wp-post-format-ui .post-format-options').length > 0 ) {
		$('#nectar-metabox-post-gallery').hide();
	}


	
	/*----------------------------------------------------------------------------------*/
	/*	Take care of the unnecessary buttons on the slider post type edit page
	/*----------------------------------------------------------------------------------*/
	
	if( $('#nectar-metabox-home-slider').length > 0 ){
		$('#preview-action, #wp-admin-bar-view').hide();
		$('.wrap > #message.updated p').html('Slide Updated.');
		
		 $('.buttonset').buttonset();
		 $('.buttonset').append('<span class="msg">This setting is not active when using a video.</span>');
		 
		 checkSlideVideo();
		 
		 $('#_nectar_video_m4v, #_nectar_video_ogv, #_nectar_video_embed').keyup(function(){
		 	checkSlideVideo();
		 });
		 
	}

	
	function checkSlideVideo(){
		
		//if < WP 3.6
		if( $('#_nectar_video_m4v').length > 0 ){

			 if( $('#_nectar_video_m4v').val().length > 0 || $('#_nectar_video_ogv').val().length > 0 || $('#_nectar_video_embed').val().length > 0 ){
			 	$('.buttonset').stop().animate({'opacity':0.55},600);
			 	$('.buttonset .msg').stop().animate({'opacity': 1},600);
			 }
			 else {
			 	$('.buttonset').stop().animate({'opacity':1},600);
			 	$('.buttonset .msg').stop().animate({'opacity': 0},600);
			 }
		 
		} 
		//>= WP 3.6
		else {
			
			 if( $('#_nectar_video_embed').val().length > 0 ){
			 	$('.buttonset').stop().animate({'opacity':0.55},600);
			 	$('.buttonset .msg').stop().animate({'opacity': 1},600);
			 }
			 else {
			 	$('.buttonset').stop().animate({'opacity':1},600);
			 	$('.buttonset .msg').stop().animate({'opacity': 0},600);
			 }
			
		}
		
	}
	
	
	/*----------------------------------------------------------------------------------*/
	/*	Only show the portfolio display settings if the portfolio template is chosen
	/*----------------------------------------------------------------------------------*/
	
	function portfolioDisplaySettings(){
		if($('select#page_template').val() == 'page-portfolio.php'){
			$('#nectar-metabox-portfolio-display').show();
		} else {
			$('#nectar-metabox-portfolio-display').hide();
		}
	}
	
	$('select#page_template').change(portfolioDisplaySettings);
	portfolioDisplaySettings();
	
    
    /*----------------------------------------------------------------------------------*/
	/*	Only show parallax when using bg image
	/*----------------------------------------------------------------------------------*/
    function toggleParallaxOption(){
    	if($('#redux-opts-screenshot-_nectar_header_bg').length > 0 && $('#redux-opts-screenshot-_nectar_header_bg').attr('src').length > 0 ){
    		$('#_nectar_header_parallax').parents('tr').show();
    	} else {
    		$('#_nectar_header_parallax').parents('tr').hide();
    		$('#_nectar_header_parallax').prop('checked', false);
    	}
    }
    toggleParallaxOption();
    
    
    /*----------------------------------------------------------------------------------*/
    /*	Only show social options when using applicable layout
	/*----------------------------------------------------------------------------------*/
    function toggleSocialOptions(){
    	if($('select#header_layout').length > 0 && $('select#header_layout').val() == 'header_with_secondary' ){
    		$('#enable_social_in_header').parents('tr').show();
    		
    		if($('input#enable_social_in_header[type="checkbox"]').is(':checked')){
    			$('#enable_social_in_header').parents('tr').nextAll('tr').show();
    		}
    	} else {
    		$('#enable_social_in_header').parents('tr').hide();
    		$('#enable_social_in_header').parents('tr').nextAll('tr').hide();
    	}
    }
    toggleSocialOptions();
    
    $('select#header_layout').change(function(){
    	 toggleSocialOptions();
    });
    
});


