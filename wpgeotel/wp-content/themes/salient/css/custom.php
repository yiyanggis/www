<?php 

function nectar_custom_css() {
	
	$options = get_option('salient');
	
	//boxed css
	if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1')  {
		
		$attachment = $options["background-attachment"];
		$position = $options["background-position"];
		$repeat = $options["background-repeat"];
		$background_color = $options["background-color"];
		
		echo '<style type="text/css">
		 body {
		 	background-image: url("'.$options["background_image"].'");
			background-position: '.$position.';
			background-repeat: '.$repeat.';
			background-color: '.$background_color.';
			background-attachment: '.$attachment.';';
			if(!empty($options["background-cover"]) && $options["background-cover"] == '1') {
				echo 'background-size: cover;
				-moz-background-size: cover;
				-webkit-background-size: cover;
				-o-background-size: cover;';
			}
			
		 echo '} 
		</style>';
	}
	
	//custom css
	if(!empty($options["custom-css"])){
		echo '<style type="text/css">' . $options["custom-css"] . '</style>';
	} 

}

add_action('wp_head', 'nectar_custom_css');

?>