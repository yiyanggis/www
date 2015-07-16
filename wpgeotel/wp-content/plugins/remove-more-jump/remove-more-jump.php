<?php
/*
Plugin Name: Remove More Jump
Plugin URI: http://wordpress.org/extend/plugins/remove-more-jump/
Description: Removes the anchor from the permalinks, so you don't jump halfway down the page.
Version: 1.0
Author: Bjørn Johansen
Author URI: http://twitter.com/bjornjohansen
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Copyright 2013 Bjørn Johansen (email : post@bjornjohansen.no)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


class BJ_Remove_More_Jump {

	function __construct() {
		add_filter( 'the_content_more_link', array( $this, 'remove_more_jump' ) );
	}

	function remove_more_jump( $link ) { 
		return preg_replace( '/#more\-\d+/', '', $link );
	}


}

new BJ_Remove_More_Jump();
