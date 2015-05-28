/********************************************************************************
 * sticky-nav.js
********************************************************************************/
jQuery(document).ready(function($) {
	var $filter = $('.main-navigation');
	var $filterSpacer = $('<div />', {
		"class": "filter-drop-spacer",
		"height": $filter.outerHeight()
	});

	if ($filter.size())
	{
		$(window).scroll(function ()
		{
			if (!$filter.hasClass('fix') && $(window).width() > 767  && $(window).scrollTop() > $filter.offset().top)
			{
				$filter.before($filterSpacer);
				$filter.addClass("fix");
			}
			else if ($filter.hasClass('fix') && $(window).scrollTop() < $filterSpacer.offset().top)
			{
				$filter.removeClass("fix");
				$filterSpacer.remove();
			}
		});
	}
} );
/********************************************************************************
 * Slider
********************************************************************************/ 
jQuery(document).ready(function($) {
  $("#image-slider").owlCarousel({
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      //singleItem:true,
      autoHeight : false,
      autoPlay : 8000,
      // "singleItem:true" is a shortcut for:
      items : 4, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });
});
/*********************************************************************************
 * Scroll to js
********************************************************************************/ 
jQuery(document).ready(function($) {
//smoothup
$(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
			$('#smoothup') .fadeOut();
        } else {
			$('#smoothup') .fadeIn();
        }
});
$('#smoothup').on('click', function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
});
//scrollto
$('.scrollto a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
  });
} );