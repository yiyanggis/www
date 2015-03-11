<?php
/*  (c) Copyright 2015  MiKa (wp-osm-plugin.HanBlog.Net)

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
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function osm_map_create() {
  //create a custom meta box

  wp_enqueue_script( 'ajax-script', plugins_url( '/js/osm-plugin-lib.js', __FILE__ ), array('jquery') );
  wp_localize_script( 'ajax-script', 'osm_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'lat' => '', 'lon' => '', 'icon' => '', 'post_id' => '' ) );

  $screens = array( 'post', 'page' );
  foreach ($screens as $screen) {
    add_meta_box( 'osm-sc-meta', 'WP OSM Plugin shortcode generator', 'osm_map_create_shortcode_function', $screen, 'normal', 'high' );
  add_meta_box( 'osm-geotag-meta', 'WP OSM Plugin geotag', 'osm_geotag_post_function', $screen, 'side', 'core' );
  }
}

function osm_geotag_post_function( $post ) {
?>
  <b>1. <?php _e('post icon','OSM-plugin') ?></b>:
  <select name="osm_marker_geotag">
  <?php include('osm-marker-select.php'); ?>
  </select><br>
  <b>2. <?php _e('Click into the map for geotag!','OSM-plugin') ?></b>:
  <?php echo Osm::sc_showMap(array('msg_box'=>'metabox_geotag_gen','lat'=>'50','long'=>'18.5','zoom'=>'3', 'type'=>'mapnik_ssl', 'width'=>'100%','height'=>'300', 'map_border'=>'thin solid grey', 'theme'=>'dark', 'control'=>'mouseposition')); ?><br>
  <div id="Geotag_Div"><br></div><br>
  <a class="button" onClick="osm_saveGeotag();"> <?php _e('Save','OSM-plugin')?> </a><br><br>
  <?php
}


function osm_map_create_shortcode_function( $post ) {
?>

  <style type="text/css">
    <link rel="stylesheet" type="text/css" href="'.OSM_PLUGIN_URL.'/css/osm_map.css" />
  </style>
  <script type="text/javascript">
  /* <![CDATA[ */
  jQuery(document).ready(function(){

    jQuery('.tabs .tab-links a').on('click', function(e)  {
      var currentAttrValue = jQuery(this).attr('href');
 
      // Show/Hide Tabs
      jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
      // Change/remove current tab to active
      jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
      e.preventDefault();
    });
  });
  /* ]]> */
  </script>

<div class="tabs">
  <ul class="tab-links">
    <li class="active"><a href="#tab_marker"><?php _e('Marker','OSM-plugin') ?></a></li>
    <li><a href="#tab_file">KML | GPX | TXT</a></li>
    <li><a href="#tab_geotag"><?php _e('Geotagged','OSM-plugin') ?></a></li>
    <li><a href="#tab_about"><?php _e('About','OSM-plugin') ?></a></li>
  </ul>
 
  <div class="tab-content">
    <div id="tab_marker" class="tab active">
      <b>1. <?php _e('map type','OSM-plugin') ?></b>:
      <select name="osm_marker_map_type">
      <?php include('osm-maptype-select.php'); ?>
      </select>
      <b>2. <?php _e('OSM control theme','OSM-plugin') ?></b>: 
      <select name="osm_marker_theme">
      <?php include('osm-theme-select.php'); ?>
      </select>
      <br><br>
      <b>3. <?php _e('marker icon','OSM-plugin') ?></b>:
      <select name="osm_marker_marker">
      <?php include('osm-marker-select.php'); ?>
      </select>
      ( <a href="http://wp-osm-plugin.hanblog.net/wp-osm-plugin-icons/" target="_blank"> icons</a> )<br><br>
      <b>4. <?php $url = 'http://wp-osm-plugin.hanblog.net/'; 
      $link = sprintf( __( 'Adjust the map and click into the map to generate the shortcode. Find more features  <a href="%s" target="_blank">here</a> !', 'OSM-plugin' ), esc_url( $url ) );
      echo $link; ?></b><br><br>
      <?php echo Osm::sc_showMap(array('msg_box'=>'metabox_marker_sc_gen','lat'=>'50','long'=>'18.5','zoom'=>'3', 'type'=>'mapnik_ssl', 'width'=>'450','height'=>'300', 'map_border'=>'thin solid grey', 'theme'=>'dark', 'control'=>'mouseposition,scaleline')); ?>
    </div> <!-- id="tab_marker" -->

    <div id="tab_file" class="tab">
      <b>1. <?php _e('Map type','OSM-plugin') ?></b>:
      <select name="osm_file_map_type">
      <?php include('osm-maptype-select.php'); ?>
      </select>
      <b>2. <?php _e('OSM control theme','OSM-plugin') ?></b>: 
      <select name="osm_file_theme">
      <?php include('osm-theme-select.php'); ?>
      </select><br><br>
      <b>3. <?php _e('If you want to add a file (KML, GPX, TXT):','OSM-plugin') ?></b>
      <select name="osm_file_add_file">
      <?php include('osm-file-select.php'); ?>
      </select><br><br>
      <b>4. <?php _e('Paste the local URL of file here: ','OSM-plugin') ?></b><br>
      <?php _e('Do not save any of your personal data in the plugins/osm folder but in the upload folder!','OSM-plugin') ?><br>
      <input name="file_FileURL" type="text" size="30" maxlength="200" value="../../../../wp-content/uploads/YOUR-FILE"><br><br>
      <b>5. <?php $url = 'http://wp-osm-plugin.hanblog.net/'; 
      $link = sprintf( __( 'Adjust the map and click into the map to generate the shortcode. Find more features  <a href="%s" target="_blank">here</a> !', 'OSM-plugin' ), esc_url( $url ) );
      echo $link;?></b><br><br>
      <?php echo Osm::sc_showMap(array('msg_box'=>'metabox_file_sc_gen','lat'=>'50','long'=>'18.5','zoom'=>'3', 'type'=>'mapnik_ssl', 'width'=>'450','height'=>'300', 'map_border'=>'thin solid grey', 'theme'=>'dark', 'control'=>'mouseposition,scaleline')); ?>
     </div> <!-- id="tab_file" -->
 
     <div id="tab_geotag" class="tab">
       <b>1. <?php _e('Map type','OSM-plugin') ?></b>:
       <select name="osm_geotag_map_type">
       <?php include('osm-maptype-select.php'); ?>
       </select>
       <b>2. <?php _e('OSM control theme','OSM-plugin') ?></b>: 
       <select name="osm_geotag_theme">
       <?php include('osm-theme-select.php'); ?>
       </select><br><br>
       <b>3. <?php _e('Marker icon','OSM-plugin') ?></b>:
       <select name="osm_geotag_marker">
       <?php include('osm-marker-select.php'); ?>
       </select>
       <b>4. <?php _e('Draw a line','OSM-plugin') ?></b>:
       <select name="osm_geotag_line">
       <option value="none"><?php _e('none','OSM-plugin') ?></option>
       <option value="green"><?php _e('green','OSM-plugin') ?></option>
       <option value="red"><?php _e('red','OSM-plugin') ?></option>
       <option value="blue"><?php _e('blue','OSM-plugin') ?></option>
       <option value="black"><?php _e('black','OSM-plugin') ?></option>
       </select> <br><br>
       <b>5. <?php _e('post type','OSM-plugin') ?></b>:
       <select name="osm_geotag_posttype">
       <option value="any"><?php _e('any','OSM-plugin') ?></option>
       <option value="post"><?php _e('post','OSM-plugin') ?></option>
       <option value="page"><?php _e('page','OSM-plugin') ?></option>
       </select>
       ( <a href="http://wp-osm-plugin.hanblog.net/wp-osm-plugin-icons/" target="_blank"> icons</a> )<br><br>
       <b>6. <?php $url = 'http://wp-osm-plugin.hanblog.net/'; 
       $link = sprintf( __( 'Adjust the map and click into the map to generate the shortcode. Find more features  <a href="%s" target="_blank">here</a> !', 'OSM-plugin' ), esc_url( $url ) );
       echo $link; ?><br><br></b>
       <?php echo Osm::sc_showMap(array('msg_box'=>'metabox_geotag_sc_gen','lat'=>'50','long'=>'18.5','zoom'=>'3', 'type'=>'mapnik_ssl', 'width'=>'450','height'=>'300', 'map_border'=>'thin solid grey', 'theme'=>'dark', 'control'=>'mouseposition,scaleline')); ?>
     </div> <!-- id="tab_geotag" -->
 
     <div id="tab_about" class="tab">
     <?php echo '<b>WordPress OSM Plugin '.PLUGIN_VER.' </b>'; ?>
     <table border="0" >
       </tr><td><?php  echo '<p><img src="'.OSM_PLUGIN_URL.'/WP_OSM_Plugin_Logo.png" align="left" vspace="10" hspace="20" alt="Osm Logo"></p>'; ?> </td>
       <td><b><?php _e('Coordination','OSM-plugin'); echo " & "; _e('Development','OSM-plugin') ?>:</b><a target="_new" href="http://mika.HanBlog.net"> MiKa</a><br><br>
       <b><?php _e('Thanks for Translation to','OSM-plugin') ?>:</b><br> Вячеслав Стренадко, <a target="_new" href="http://tounoki.org/">Tounoki</a>, Sykane, <a target="_new" href="http://www.pibinko.org">Andrea Giacomelli</a><br><br><b>
       <?php
       $url = "https://wordpress.org/support/view/plugin-reviews/osm";
       $rate_txt = sprintf( __( 'If you like the OSM plugin rate it <a href="%s">here</a>. ', 'OSM-plugin' ), esc_url($url));
       echo $rate_txt; ?>
       <?php _e('Thanks!','OSM-plugin') ?></b>
       </td></tr>
     </table>
                  
     <b><?php _e('Some usefull sites for this plugin:','OSM-plugin') ?></b>
     <ol>
       <li><?php _e('for advanced samples visit the ','OSM-plugin') ?><a target="_new" href="http://wp-osm-plugin.HanBlog.net">osm-plugin page</a>.</li>
       <li><?php _e('for questions, bugs and other feedback visit the','OSM-plugin') ?> <a target="_new" href="http://wp-osm-plugin.hanblog.net/forum/forum-en/">EN forum</a>, <a target="_new" href="http://wp-osm-plugin.hanblog.net/forum/forum-de/">DE forum</a></li>
       <li><?php _e('Follow us on twitter: ','OSM-plugin') ?><a target="_new" href="https://twitter.com/wp_osm_plugin">wp-osm-plugin</a>.</li>
      <li><?php _e('download the last version at WordPress.org ','OSM-plugin') ?><a target="_new" href="http://wordpress.org/extend/plugins/osm/">osm-plugin download</a>.</li>
    </ol>
    </div> <!-- id="tab_about" -->
  </div><!-- class="tab-content" -->
</div>  <!-- class="tabs" --><br><br>
<h3><span style="color:green"><?php _e('Copy the generated shortcode/customfield/argument: ','OSM-plugin') ?></span></h3>
<div id="ShortCode_Div"><?php _e('If you click into the map this text is replaced','OSM-plugin') ?> </div> <br>
<?php
}
