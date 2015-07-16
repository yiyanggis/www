<?php
/*
Plugin Name: Custom-More-Link-Complete
Version: 1.4.1
Plugin URI: http://drumliber.ro/custom-more-link-complete-wordpress-plugin/
Description: Completely customize the WordPress generated read more link (posts, pages and excerpts). You can edit the read more link to whatever format you wish. You can disable the default %anchor% and make the post be seen from the top. Now it also includes by default the title (%title% attribute). Editing links for excerpts is enabled by default.
Author: Florin Arjocu
Author URI: http://www.drumliber.ro
Author Email: florin@drumliber.ro
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=WCAGK4N8G8RBC&lc=GB&item_name=Help%20me%20by%20supporting%20the%20Custom%20More%20Link%20Complete%20WordPress%20Plugin&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted

Min WP Version: 2.9.1
Max WP Version: 3.3.1
It should function with older versions of WordPress also, but I only tested it up to WP 3.3.1

Based on the plugin: Custom More Link by Michael Weingaertner (admin@cywhale.de) with elements of More Link Modifier  by Peggy Kuo (http://psychopyko.com).

== Update February 2012 ==
Considering the received feedback, now you cand also customize the "Continue reading" link and  "[...]" text on excerpts (for instance you see them on category pages in TwentyTen/TwentyEleven themes). On the configuration page you MUST first activate the removal of the default filters from TwentyTen, TwentyEleven. Otherwise, the TT, TE filters will conflict with CMLC and your links will not work.

Updated January 2012: I made a change in the regex according to Gerobe's feedback. Thanks!

If you find yourself in the need for updates remember I'm doing it in my time and I might need a little help for doing that. Please donate as little as you afford. I will try to keep the plugin up to date and to listen to users requests.
*/

/*  Copyright 2010  Florin Arjocu (email : florin@drumliber.ro)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

	You can find the GNU General Public License here: http://www.gnu.org/licenses/gpl.html
*/
$t10t11 = false;
// check if not is admin page
if(!is_admin()){
	$remove_wp_tt_filters = get_option('dl_custom_more_link_complete_remove_tt_filters');
	if ($remove_wp_tt_filters == "on")//if activated for excerpts, WE remove excerpts' filters in TwentyTen and TwentyEleven
	{
		add_filter('template_redirect','remove_tt_filters');
		//add_filter('pre_get_posts','remove_tt_filters');
	}
	
	add_filter('the_content_more_link', 'convert_content_more_to_cmlc');//the_content()
	
	if ($remove_wp_tt_filters == "on")//if activated for excerpts
	{	
		add_filter('get_the_excerpt', 'convert_excerpt_more_to_cmlc');//the_excerpt()
	}
    //add_filter('the_content','dlCustom_more');// replace old more link //old filter 1
    //add_filter( 'get_the_excerpt', 'convertExcerptEndToCMLC' );//add to all excerpts (manual and auto)
    //add_filter( 'excerpt_more', 'convertExcerptEndToCMLC' );//add to auto excerpts, [...]
    //add_filter( 'the_excerpt', 'convertExcerptEndToCMLC' );//add to auto excerpts, [...] //old filter 2
}else{
    // load language files and add admin menu option
    load_plugin_textdomain('dl_custom_more_link_complete', false, basename(dirname(__FILE__)) . '/languages');
    add_action('admin_menu', 'dl_custom_more_link_complete_add_option_menu');
	register_activation_hook(__FILE__, 'dl_cmlc_activate');
    
}

function dl_cmlc_activate() {
	if (!get_option('dl_custom_more_link_complete_remove_tt_filters'))//by default we disable standard TwentyTen/TwentyEleven actions
	{
		update_option('dl_custom_more_link_complete_remove_tt_filters',"on");
	}
}

/*
 * Removes the filters in TwentyTen and TwentyEleven that modify the excerpts to be able to do it here 
 * @return true/false depending on success of both functions
 * */
function remove_tt_filters(){
	//remove twentyten filters for custom excerpt read more link
	$f10_1 = remove_filter('excerpt_more', 'twentyten_auto_excerpt_more');//default read more link
	$f11_1 = remove_filter('excerpt_more', 'twentyeleven_auto_excerpt_more');//default read more link
	$f10_2 = remove_filter('get_the_excerpt', 'twentyten_custom_excerpt_more');//custom read more link
	$f11_2 = remove_filter('get_the_excerpt', 'twentyeleven_custom_excerpt_more');//custom read more link
	global $t10t11;
	$t10t11 = ($f10_1||$f11_1||$f10_2||$f11_2);//if any of the filters exists
	
	//or, we use the theme name // it might be useful in the future for allowing translations
	//$theme_data = get_theme_data( get_template_directory() . '/style.css' );
	//echo $theme_data['Title'];//"Twenty Ten" or "Twenty Eleven"
	return ($t10t11);
}


function convert_content_more_to_cmlc($link) {
	$link = convertTheContentLinkToCMLC($link);//convertim automat doar parte de link
	//echo '<pre>Link=='.htmlspecialchars(print_r($link, true)).'</pre>';
	return $link;
}


// Puts link in excerpts more tag
function convert_excerpt_more_to_cmlc($more) {
	global $post;
	//echo '<pre>More=='.htmlspecialchars(print_r($more, true)).'</pre>';
	return(convertExcerptEndToCMLC($more));
}

/*
 * Replaces the old wp generated Continue reading/[...] with new pattern
 * This function is used as a filter for the wordpress excerpt
 * 
 * @param string $content
 * @return string $content
 */
 
 

$default_pattern = '';//initiate the variable
function convertExcerptEndToCMLC($excerpt){
	//we don't run this if standard filters run (not to get duplicates)
	if (!get_option('dl_custom_more_link_complete_remove_tt_filters'))//if the option to remove WP filters for excerpts in TwentyTen and TwentyEleven is activated
	{return ($excerpt);}
	
	//var_dump(get_defined_vars());
	$my_excerpt = $excerpt;//get_the_excerpt();
	//echo 'excerpt1==[[['.$excerpt.']]]';
	//echo '<script>'.$my_excerpt.'</script>';
	//echo 'excerpt2==['.get_the_excerpt().']';

	global $post;
	//print_r($post);
	//we will use the default wordpress stuff
	$title = $post->post_title;
	$url = get_bloginfo('url').'/'.$post->post_name.'/';
	$anchor = '#more-'.$post->ID;
	$class = 'more-link';
	$linktext = 'Continue reading';
	$default_link = '<a class="'.$more_class.'" href="'.$url.$anchor.'">'.$linktext.'</a>';
	
	$pattern=dl_custom_more_link_complete_get_pattern();//get the pattern we configured
	$search_pattern='=<a href\="([^>]*)(#more-[\d]+)" class\="([a-zA-Z\-\ ]+)">(.*)<\/a>=';//feedback from gerobe
	//echo '<pre>(convertExcerptEndToCMLC) Pattern_inainte=='.htmlspecialchars(print_r($pattern, true)).'</pre>';
	$pattern=str_replace(
			array('%permalink%','%anchor%','%class%','%linktext%','%title%'),
			array($url,$anchor,$class,$linktext,$title),
			$pattern);

	//echo '<pre>(convertExcerptEndToCMLC) Pattern_dupa=='.htmlspecialchars(print_r($pattern, true)).'</pre>';
	//echo '<pre>(convertExcerptEndToCMLC) $my_excerpt=='.htmlspecialchars(print_r($my_excerpt, true)).'</pre>';
	
	
	//if we assume the user will not write "[...]" in post, this would also work:
	//echo 'pos=='.$pos = mb_strpos($my_excerpt, "[...]");//we search in the last 30 characters only
	//$my_excerpt_cleaned = mb_substr( trim($my_excerpt), $pos, 5);//removed the [...]
	
	
	//'<p>text[...]' or '<p>text[...]</p>' auto excerpt
	//Attention! It's '[...]' when running in get_the_excerpt and '[...]</p>' in exerpt_more (in this case we don't take the </p>)
	$my_excerpt_cleaned = mb_substr( trim($my_excerpt), -5, 5);
	if ($my_excerpt_cleaned=="[...]")
	{
		//$my_excerpt = mb_substr($my_excerpt, 0, -10).$default_link.'</p>';
		$my_excerpt = mb_substr($my_excerpt, 0, -5).$pattern.'</p>';
		//$my_excerpt = mb_substr($my_excerpt, 0, $pos).$pattern.'</p>';//for version that assumes the user will not write [...] in post
		
		//or, with regex:
		//$search_pattern = '(\[\.\.\.\])';
		//if(FALSE !== preg_match($search_pattern, $my_excerpt, $matches)) {};
	}
	else //manual excerpt
	{
		$my_excerpt .= $pattern;
	}
	
	
	return $my_excerpt;
}


//we either use the existing link and convert it, or we can create a new one like for excerpts
//in this version we use the existing link as we have there the url, class, more-id
//in the future if WP developers change the TwentyTen/TwentyEleven 'Continue reading' format, we might just create it from $post
function convertTheContentLinkToCMLC($link){
	// get the customized link pattern
	$pattern=dl_custom_more_link_complete_get_pattern();
    
	// search pattern for old wp generated more link structure        
  //$search_pattern='=<a href\="(.*)(#more-[\d]+)" class\="([a-zA-Z\-\ ]+)">(.*)<\/a>=';//old regex
	$search_pattern='=<a href\="([^>]*)(#more-[\d]+)" class\="([a-zA-Z\-\ ]+)">(.*)<\/a>=';//feedback from gerobe
    
	//Important: we must remove 'Continue reading <span class="meta-nav">&rarr;</span>' as it will break the formated link
	$link = str_replace(' <span class="meta-nav">&rarr;</span>', '', $link);
	
	// search old more link and get the important parts
	$matches=array();
	if(FALSE !== preg_match($search_pattern,$link,$matches)){
		$url = $matches[1];
		$anchor = $matches[2];
		$class = $matches[3];
		$linktext = $matches[4];
		//print_r($matches);
		$title = getFormattedTitle();
		//get_the_title();//

        // replace tags in new-morelink-pattern with found parts if neccessary
		// added one more item: %title% which is the title of the article
        $pattern=str_replace(
            array('%permalink%','%anchor%','%class%','%linktext%','%title%'),
            array($matches[1],$matches[2],$matches[3],$matches[4],$title),
            $pattern);

        // replace old more link with new link pattern    
        $link=preg_replace($search_pattern,$pattern,$link);
        
        // done
        return($link);
    }else{
        // no more-link found, do nothing and return $link
        return($link);
    }
}


/* Add the function to format the title*/
// Format the original post title according to the options specified in admin page
function getFormattedTitle() {
   $limitType = get_option('dl_custom_more_link_complete_limitType');
   $maxLimit = get_option('dl_custom_more_link_complete_maxLimit');
   $showEllipsis = get_option('dl_custom_more_link_complete_showEllipsis');

   $title = the_title('','',false);//

   if ($limitType == "char") {
      // Only get the first 'n' characters of the title
      $titleLen = strlen($title);
      $title = substr($title,0,$maxLimit);
      
      // If shown ellipsis option is checked, add '...' to title if the length of the title
      // is more than the maximum characters shown
      if ($showEllipsis == "on") {
         if ($titleLen > $maxLimit) {
            $title .= "...";
         }
      }
      
   } else if ($limitType == "word") {
      // Create two strings ($pattern/$replacement) depending on the maximum number of words to be shown
      // eg. if maximum number of words was 3 (ie. $maxLimit is 3)
      // $pattern = "/(\S+) (\S+) (\S+) (.*)/"
      // $replacement = "\$1 \$2 \$3"
      $pattern = "/";
      for ($i=1; $i<=$maxLimit; $i++) {
         $pattern .= "(\S+) ";
         $replacement .= "\$$i ";
      }
      $replacement = rtrim($replacement);
      $pattern .= "(.*)/";
      
      // If show ellipsis option is checked, will add '...' to end of replacement
      // $replacement = "\$1 \$2 \$3..."
      if ($showEllipsis == "on") {
         $replacement .= "...";
      }
      
      // Use regex with pattern/replacement strings defined above to match the title
      // Note: If the number of words in title is less than the maximum number of words, the regex
      //       will not match, and will return the title unchanged.
      $title = preg_replace($pattern, $replacement, $title);      
      
   } else {
      // Do nothing
   }   
   return $title;
}
/**/

/*
 * Adds plugin options menu option to WordPress options
 */
function dl_custom_more_link_complete_add_option_menu(){
        add_options_page('Custom More Link Complete Options Page', 'Custom More Link Complete', 9, __FILE__, 'dl_custom_more_link_complete_options');
}

/*
 * Gets new more-link pattern from the wo options database table,
 * if there is no custom link pattern this function rebuilds the
 * WordPress default more-link structure
 * 
 * @returns string $pattern
 */    
function dl_custom_more_link_complete_get_pattern(){
	// set pattern max length
	$dm_custom_more_complete_maxlen=255;
	global $default_pattern;
	// generate default pattern
	//$default_pattern='<a href="%permalink%" title="%linktext% %title%" class="%class%">%linktext% %title%</a>';//old pattern
	$default_pattern='<a href="%permalink%" title="%linktext% &laquo;%title%&raquo;" class="%class%">%linktext% &laquo;%title%&raquo;</a>';
    
	// get pattern and strip those *** slashes
	//$pattern=stripslashes(get_option('dl_custom_more_link_complete_pattern'));//F: v1.3.1
	$pattern=stripslashes(htmlspecialchars_decode(get_option('dl_custom_more_link_complete_pattern')));//F: added htmlspecialchars_decode
    
	// return the shortened (if neccessary) pattern
	if($pattern===FALSE || empty($pattern)){
		$pattern=$default_pattern;
	}
	if(strlen($pattern)>$dm_custom_more_complete_maxlen){
		$pattern=substr($pattern,0,$dm_custom_more_complete_maxlen);
	}   
	return($pattern);
}

/*
 * Shows the custom-more-link options page displaying some information, links
 * and the pattern option field.
 * This function handles the database updating, too.
 */
function dl_custom_more_link_complete_options(){
	// update the database if needed
	if ('update' == $_POST['action']){
        
		// set messagebox status default
		$updated=FALSE;
        
		// are we allowed to do this ?
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			die(__('Cheatin’ uh?'));

		// check for form security
		check_admin_referer( 'dl_custom_more_link_complete' );
        
		// everything ok, update and set messagebox status
		update_option("dl_custom_more_link_complete_pattern",$_POST['dl_custom_more_link_complete_pattern']);
		update_option('dl_custom_more_link_complete_limitType',$_POST['dl_custom_more_link_complete_limitType']);
		update_option('dl_custom_more_link_complete_maxLimit',$_POST['dl_custom_more_link_complete_maxLimit']);
		update_option('dl_custom_more_link_complete_showEllipsis',$_POST['dl_custom_more_link_complete_showEllipsis']);
		update_option('dl_custom_more_link_complete_remove_tt_filters',$_POST['dl_custom_more_link_complete_remove_tt_filters']);
		$updated=TRUE;

	}

	// get and prepare the custom more-link pattern
	$pattern=dl_custom_more_link_complete_get_pattern();
	$limitType = get_option('dl_custom_more_link_complete_limitType');
	$maxLimit = get_option('dl_custom_more_link_complete_maxLimit');
	$showEllipsis = get_option('dl_custom_more_link_complete_showEllipsis');
	$remove_wp_tt_filters = get_option('dl_custom_more_link_complete_remove_tt_filters');
	$pattern=htmlspecialchars($pattern);  //F: alta varianta ar fi sa folosim \ pt escape
	global $default_pattern;
    
	// now let's build the options page
	?>
		<div class="wrap">
		<h2><?php _e('Custom More Link Complete','dl_custom_more_link_complete');?></h2>
		<p><?php _e('Customize the WordPress "Read more" link displayed on bottom of your posts. With this plugin you can add custom attributes such as the "<code>nofollow</code>" relation, add custom XHTML tags surrounding the link or remove the <code>#-number</code> anchor added by WordPress. By default it puts the article title in the link. If you like this plugin please consider giving a backlink to <a href="http://www.drumliber.ro/" title="Link to the authors website">http://www.drumliber.ro/</a> or <b><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=WCAGK4N8G8RBC&lc=GB&item_name=Help%20me%20by%20supporting%20the%20Custom%20More%20Link%20Complete%20WordPress%20Plugin&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted">donate</a></b> in order to help me continue supporting the plugin and creating new plugins or versions of this one. Thank you.','dl_custom_more_link_complete');?></p>

		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHbwYJKoZIhvcNAQcEoIIHYDCCB1wCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYAnqLI8ow/oEsAL95aWLBThODolJOUSbDtDKHDCwe5eImVIliNcUlOI48RjF8UP/TslGQLn+yV1L7Rnq3yHAE+K7AOJZasLWsLG4PtBGUwRZZC2MMn/6x4CdeGgQU10ISsQDH8Xd449M/7CMJQqtCiple6NLzsFIpS01Sd4ycofbTELMAkGBSsOAwIaBQAwgewGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIQxouwzUWEDSAgcgL+RshfkPLLcv9YJDZlLVujmEYBVWBuLlwntjXO3IeOvIMKcrz98EUI7DatG1lkVafQ+8uUwJd3XFWQIccThkLypWziuij2RihWaBAvOcvy12NaE4gnIu048C8QJB1svttrfu5RZG3aHI+w0jczev3uZCFT3K0gBcCXhPfJbUgpHwh+9T+WHo94RLGVfLMKqUISAkXxshjm/VEhLZaZDKzlCAcPupnsLHq1t5YvNQrzP/6LuG5mdqltFV4c4eoNhC6jmQOlKmk06CCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTEwMDIwNjEyNDQ1OVowIwYJKoZIhvcNAQkEMRYEFHPeJMDjB5Ls2JVWfY6qw+8AUet4MA0GCSqGSIb3DQEBAQUABIGAQ1U0LlvXuc+22ea5lvSFqb4+IwKr48gY79lmQI0/TWBt3xzaLgasXvN+EOupTc5kVPBnrHNiauK04jnpdZbD5+EfuP61263Dqt+glIf4pIhYkn5Y5VtJJRDaCK22/iJo1cbeH3atn1Pz4rkb4F4G9jOmsZFVo+lFMqy7v1YMy+Y=-----END PKCS7-----">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>


		<h3><?php _e('Usage','dl_custom_more_link_complete');?></h3>
		<p><?php _e('Use the following tags to build your custom more link:','dl_custom_more_link_complete');?></p>
		<ul>
			<li><p><code>%permalink%</code> - <?php _e('The permalink provided by WordPress to the full post','dl_custom_more_link_complete');?></p></li>
			<li><p><code>%anchor%</code> - <?php _e('The anchortext provided by WordPress that jumps the complete article to the link point. If you want the page to jump, add <code>%anchor%</code> to the pattern just after <code>%permalink%</code>. (default: disabled)','dl_custom_more_link_complete');?></p></li>
			<li><p><code>%class%</code> - <?php _e('The default CSS class provided by WordPress (default: <code>more-link</code>)','dl_custom_more_link_complete');?></p></li>
			<li><p><code>%linktext%</code> - <?php _e('The linktext provided by WordPress','dl_custom_more_link_complete');?>. <?php _e('By default WordPress will use "Continue Reading&#8230;". You can remove <code>%linktext%</code> and use your own text.','dl_custom_more_link_complete');?></p></li>
			<li><p><code>%title%</code> - <?php _e('The title of the article provided by WordPress. You can customize the title with the options in this page.','dl_custom_more_link_complete');?></p></li>
		</ul>
        
		<?php if(isset($_POST['action']) && $updated!==TRUE):?>
		<div id="dl_custom_more_link_complete_message" class="error fade-ff0000">
			<p>
				<?php echo htmlspecialchars(__('The new more link pattern could not be saved, sorry. ','dl_custom_more_link_complete'));?>
			</p>
		</div>
        
		<?php endif;?>

		<?php if(isset($_POST['action']) && $updated===TRUE):?>
			<div id="dl_custom_more_link_complete_message" class="updated fade-ff0000">
				<p>
					<?php echo htmlspecialchars(__('Custom more link settings updated.','dl_custom_more_link_complete'));?>
				</p>
			</div>
		<?php endif;?>

		<form method="post" action="">
		<?php wp_nonce_field('dl_custom_more_link_complete'); ?>

		<b><?php _e('More Link Pattern','dl_custom_more_link_complete');?></b>: 
		<input type="text" style="width:100%" name="dl_custom_more_link_complete_pattern" value="<?php  echo $pattern; ?>" />
		<br />
		<?php _e('Default pattern','dl_custom_more_link_complete');?>: <code><?php echo htmlentities($default_pattern);?></code>
		<br />
		<br />
		<b><?php _e('Limits for Title','dl_custom_more_link_complete') ?></b> <?php _e('(aplicable only if <code>%title%</code> is in pattern)','dl_custom_more_link_complete'); ?>:<br />
		<input type="radio" name="dl_custom_more_link_complete_limitType" value="none" <?php checked("none",$limitType) ?> /> <?php _e('Display the entire title','dl_custom_more_link_complete') ?><br />
		<input type="radio" name="dl_custom_more_link_complete_limitType" value="char" <?php checked("char",$limitType) ?> /> <?php _e('Limit title by number of characters','dl_custom_more_link_complete') ?><br />
		<input type="radio" name="dl_custom_more_link_complete_limitType" value="word" <?php checked("word",$limitType) ?> /> <?php _e('Limit title by number of words (max: 99)','dl_custom_more_link_complete') ?><br /> 
		<?php _e('Limit title to ','dl_custom_more_link_complete');?><input type="text" size="3" name="dl_custom_more_link_complete_maxLimit" value="<?php echo "$maxLimit" ?>" /><?php _e(' characters/words.', 'dl_custom_more_link_complete') ?><br />
		<input type="checkbox" name="dl_custom_more_link_complete_showEllipsis" <?php checked("on",$showEllipsis) ?>/> <?php _e('Display ellipsis marks (...) at the end of the title, <b>only</b> if it is has been cut off. eg. The answer to life...','dl_custom_more_link_complete'); ?><br />
		<input type="checkbox" name="dl_custom_more_link_complete_remove_tt_filters" <?php checked("on",$remove_wp_tt_filters) ?>/> <?php _e('Also use CMLC for excerpts. The plugin will remove default brackets [...] and <b>Continue reading</b> text from <i>excerpts</i> modified by <b>TwentyTen</b> and <b>TwentyEleven</b> themes. It is needed if you run these themes and want to customize read-more links on excerpts, here in CMLC.','dl_custom_more_link_complete'); ?><br />
		<i><?php _e('Note: These limits/options only apply to the post title, and not the plaintext you have entered.','dl_custom_more_link_complete') ?></i>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="more-link-pattern" />

		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
		</p>

		</form>
		</div>
	<?php }
?>
