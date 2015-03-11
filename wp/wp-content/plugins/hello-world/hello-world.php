<?php
/*
Plugin Name: Hello-World
Plugin URI: http://weebtutorials..com/
Description: A hello world plugin used to demonstrate the process of creating plugins.
Version: 1.0
Author: Yi Yang
Author URI: http://weebtutorials.com
License: GPL
*/



//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.
//add_filter('the_content','hello_world');
 
//Callback function
function hello_world($content)
{
	global $is_apache;
	global $post;
 //Checking if on post page.
 if ( is_single() ) {
 //Adding custom content to end of post.
 	$posts_array = get_posts( $args );
 	echo count($posts_array);
 return $content . "<h1> Hello World </h1>" . $is_apache;
 }
 else {
 //else on blog page / home page etc, just return content as usual.
 return $content;
 }
}

// [bartag foo="foo-value"]
function testtag_func( $atts ) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    return "foo = {$a['foo']}";
}

function add_meta_boxes( $post_type ) {
        add_meta_box( 'yyhelloworld', 'yyhelloworld', 'meta_box_html');
    }

function meta_box_html( $object, $box ) {

	?>
	    <div>
	    	<h1>test title</h1>
	    	<p>add [testtag] to add plugin in post</p>
	    </div>
	<?php
	}

add_shortcode( 'testtag', 'testtag_func' );

//add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );
add_action( 'add_meta_boxes', 'add_meta_boxes');
//add_meta_box( 'yyhelloworld', 'yyhelloworld', 'meta_box_html');

?>