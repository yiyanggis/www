jQuery(function($) {
	 
    $('#sortable-table tbody').sortable({
        axis: 'y',
        handle: '.column-order img',
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true,
        update: function(event, ui) {
        var theOrder = $(this).sortable('toArray');
 		var nonce = $('#nectar_meta_box_nonce').attr('value');
        var data = {
            action: 'nectar_update_slide_order',
            postType: $(this).attr('data-post-type'),
            order: theOrder,
            nectar_meta_box_nonce: nonce
            };
 
            $.post(ajaxurl, data);
        }
    }).disableSelection();
    
    //shifty fix for the title column header in the home slider section
    if($('td.post-title').parent().hasClass('type-home_slider')) {
    	$('th#title, th.column-title').html('<span>Actions</span>');
    }
	 
});