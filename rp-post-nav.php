<?php
/**
* Plugin Name: RP Post Nav
* Plugin URI: http://www.rplofino.freehosting007.com/rp-post-nav
* Description: RP Post Nav display the Next/Previous Post Title, Thumbnail, Excerpt and other custom functionality.
* Version: 1.1
* Author: Rommel Plofino
* Author URI: http://www.rplofino.freehosting007.com/
* Network: false
* License: GPL2
**/
/* Copyright © 2015  Rommel Plofino (email : rplofino@gmail.com)
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as  published by the Free Software Foundation.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*Check Version*/
global $wp_version;
$exit_msg="WP Requires Latest version, Your version is old";
if(version_compare($wp_version, "3.6", "<"))
{
	exit($exit_msg);
}

if(!class_exists(RPPostNav)):
	class RPPostNav{
		private $config = array('is_active'=>false,'position'=>'bottom','related'=>'0','is_thumbnail'=>true,'is_excerpt'=>true,'is_reversed'=>false,'thumb_size'=>'75','excerpt_length'=>'15','is_label'=>false,'custom_prev_label'=>'','custom_next_label'=>'','is_custom_bg'=>false,'custom_prev_label_nav_bg'=>'','custom_next_label_nav_bg'=>'','style'=>'','next_nav_post'=>'','prev_nav_post'=>'','custom_post_type'=>'post','custom_taxonomy'=>'');
		function load_settings()
		{
			$options = $this->get_rp_post_nav_options();
			$this->config["related"] = $options['related'];
			$related = $options['related'] == "1"? true: false;
			$this->config["custom_taxonomy"] = $options['custom_taxonomy'];
			$by_taxonomy = $options['custom_taxonomy'];
			if(!empty($by_taxonomy)){
				foreach($by_taxonomy as $by_tax){
					$next_post = get_next_post($related, null, $by_tax);
					$prev_post = get_previous_post($related, null, $by_tax);
				}
			}
			else {
				$next_post = get_next_post($related, null, 'category');
				$prev_post = get_previous_post($related, null, 'category');
			}
			
			$this->config["is_active"] = $options['is_active'];
			$this->config["position"] = $options['position'];
			$this->config["is_excerpt"] = $options['is_excerpt'];
			$this->config["thumb_size"] = $options['thumb_size'];
			$options['thumb_size'] = $options['thumb_size']!=""?$options['thumb_size']:'75';
			$this->config["excerpt_length"] = $options['excerpt_length'];
			$options['excerpt_length'] = $options['excerpt_length']!=""?$options['excerpt_length']:'15';
			$this->config["is_custom_bg"] = $options['is_custom_bg'];
			$this->config["is_reversed"] = $options['is_reversed'];
			$this->config["custom_post_type"] = $options['custom_post_type'];
			$this->config["custom_taxonomy"] = $options['custom_taxonomy'];
			
			if($options['is_label'] == "1"){
				$prev_label = $prev_post->ID!=""?'<div class="rp-post-nav-label">'.$options['custom_prev_label'].'</div>':'';
				$next_label = $next_post->ID!=""?'<div class="rp-post-nav-label">'.$options['custom_next_label'].'</div>':'';
			}
			else {	
				$post_type_object = get_post_type_object(get_post_type( get_the_ID() ));
				$post_singular = $post_type_object->labels->singular_name;	
				$post_plural = $post_type_object->labels->name;
				
				$prev_label = $prev_post->ID!=""?'<div class="rp-post-nav-label">Previous '.$post_singular.'</div>':'';
				$next_label = $next_post->ID!=""?'<div class="rp-post-nav-label">Next '.$post_singular.'</div>':'';
			}
			
			if($options['is_thumbnail'] == "1"){
				$prev_thumbnail = $prev_post->ID!=""?get_the_post_thumbnail($prev_post->ID, array($options['thumb_size'],$options['thumb_size'])):'';
				if(!empty($prev_thumbnail)){
					$prev_thumbnail = $prev_post->ID!=""?'<div class="rp-post-nav-thumbnail"><a href="'.get_permalink($prev_post->ID).'" title="'.$prev_post->post_title.'">'.$prev_thumbnail.'</a></div>':'';
				}
				$next_thumbnail = $next_post->ID!=""?get_the_post_thumbnail($next_post->ID, array($options['thumb_size'],$options['thumb_size'])):'';
				if(!empty($next_thumbnail)){
					$next_thumbnail = $next_post->ID!=""?'<div class="rp-post-nav-thumbnail"><a href="'.get_permalink($next_post->ID).'" title="'.$next_post->post_title.'">'.$next_thumbnail.'</a></div>':'';
				}
			}
			
			$prev_title = $prev_post->ID!=""?'<h4 class="rp-post-nav-title"><a href="'. get_permalink($prev_post->ID).'">'.$prev_post->post_title.'</a></h4>':'';
			$next_title = $next_post->ID!=""?'<h4 class="rp-post-nav-title"><a href="'. get_permalink($next_post->ID).'">'.$next_post->post_title.'</a></h4>':'';
			
			if($options['is_excerpt'] == "1"){
				$prev_excerpt = $prev_post->ID!=""?'<p>'.balanceTags(wp_trim_words($prev_post->post_content, $options['excerpt_length'], ' ... <a href="'.get_permalink($prev_post->ID).'">Read more</a>'), true).'</p>':'';
				$next_excerpt = $next_post->ID!=""?'<p>'.balanceTags(wp_trim_words($next_post->post_content, $options['excerpt_length'], ' ... <a href="'.get_permalink($next_post->ID).'">Read more</a>'), true).'</p>':'';
			}
			
			if($options['is_custom_bg'] != "1") {
				$this->config["custom_next_label_nav_bg"] = $next_post->ID!=""?'style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id($next_post->ID, 'full')).');"':'';
				$this->config["custom_prev_label_nav_bg"] = $prev_post->ID!=""?'style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id($prev_post->ID, 'full')).');"':'';
			}
			else {
				$this->config["custom_next_label_nav_bg"] = $next_post->ID!=""?'style="background-image: url('.$options['custom_next_label_nav_bg'].');"':'';
				$this->config["custom_prev_label_nav_bg"] = $prev_post->ID!=""?'style="background-image: url('.$options['custom_prev_label_nav_bg'].');"':'';
			}
			
			$prev = $this->config["prev_nav_post"] = $prev_post->ID!=""?'<section class="rp-post-nav-pre rp-glass" '.$this->config["custom_prev_label_nav_bg"].'>
														<div class="rp-post-nav-wrap">
															<div class="rp-post-nav-content">'
																.$prev_label.$prev_thumbnail.
																'<div class="rp-post-nav-text">'.$prev_title.$prev_excerpt.'</div>
															</div>
														</div>
													</section>':'';
			$next = $this->config["next_nav_post"] = $next_post->ID!=""?'<section class="rp-post-nav-next rp-glass" '.$this->config["custom_next_label_nav_bg"].'>
														<div class="rp-post-nav-wrap">
															<div class="rp-post-nav-content">'
																.$next_label.$next_thumbnail.
																'<div class="rp-post-nav-text">'.$next_title.$next_excerpt.'</div>
															</div>
														</div>
													</section>':'';

			$this->config["post_nav"] = ($options['is_reversed'] == "1")?$next.$prev:$prev.$next;
	
		}
		function rp_post_nav_display($content)
		{
			global $post;
			$this->load_settings();
			if($this->config["is_active"] == "1"){
				if(is_singular($this->config["custom_post_type"]))
				{
					switch($this->config["position"]){
							case "both":
								return '<div class="rp-post-nav" >'.$this->config["post_nav"].'</div>'.$content.'<div class="rp-post-nav">'.$this->config["post_nav"].'</div>';
								break;
							case "top":
								return '<div class="rp-post-nav">'.$this->config["post_nav"].'</div>'.$content;
								break;
							case "bottom":
								return $content.'<div class="rp-post-nav">'.$this->config["post_nav"].'</div>';
								break;
							default:
								return $content;
								break;
					}
				}
			}
			return $content;
		}
		function rp_post_nav_shortcode()
		{
			if(is_singular($this->config["custom_post_type"]))
			{
				return '<div class="rp-post-nav">'.$this->config["post_nav"].'</div>';
			}
		}
		function handle_rp_post_nav_options()
		{
			$settings = $this->get_rp_post_nav_options();
			if (isset($_POST['submitted']))
			{
				//check security
				check_admin_referer('rp-post-nav-fields');
				
				$settings['is_active'] = isset($_POST['is_active'])? "1" : "0" ;
				$settings['position'] = isset($_POST['position'])? $_POST['position'] : "bottom" ;
				$settings['is_thumbnail'] = isset($_POST['is_thumbnail'])? "1" : "0" ;
				$settings['is_excerpt'] = isset($_POST['is_excerpt'])? "1" : "0" ;
				$settings['related'] = isset($_POST['related'])? "1" : "0" ;
				$settings['thumb_size'] = isset($_POST['thumb_size'])? $_POST['thumb_size'] : "75" ;
				$settings['excerpt_length'] = isset($_POST['excerpt_length'])? $_POST['excerpt_length'] : "15" ;
				$settings['is_reversed'] = isset($_POST['is_reversed'])? "1" : "0" ;
				$settings['is_label'] = isset($_POST['is_label'])? "1" : "0" ;
				$settings['custom_prev_label'] = isset($_POST['custom_prev_label'])? $_POST['custom_prev_label'] : "" ;
				$settings['custom_next_label'] = isset($_POST['custom_next_label'])? $_POST['custom_next_label'] : "" ;
				$settings['is_custom_bg'] = isset($_POST['is_custom_bg'])? "1" : "0" ;
				$settings['custom_prev_label_nav_bg'] = isset($_POST['custom_prev_label_nav_bg'])? $_POST['custom_prev_label_nav_bg'] : "" ;
				$settings['custom_next_label_nav_bg'] = isset($_POST['custom_next_label_nav_bg'])? $_POST['custom_next_label_nav_bg'] : "" ;
				$settings['style'] = isset($_POST['style_css'])? $_POST['style_css'] : "" ;
				$settings['custom_post_type'] = isset($_POST['custom_post_type'])? $_POST['custom_post_type'] : "post" ;
				$settings['custom_taxonomy'] = isset($_POST['custom_taxonomy'])? $_POST['custom_taxonomy'] : "" ;
				
				update_option("rp_post_nav_options", serialize($settings));
				echo '<div class="updated fade"><p>RP Post Nav Settings Updated!</p></div>';
			}
			$action_url = $_SERVER['REQUEST_URI'];
			include 'admin/rp-post-nav-admin-options.php';
		}

		function get_rp_post_nav_options()
		{
			$options = unserialize(get_option("rp_post_nav_options"));
			return $options;
		}
		function rp_post_nav_install()
		{
			$options = $this->get_rp_post_nav_options();
			$options = array(
				'is_active' => (isset($options) && is_array($options) && isset($options["is_active"]))?$options["is_active"]:'0',
				'position' => (isset($options) && is_array($options) && isset($options["position"]))?$options["position"]:'bottom',
				'is_thumbnail' => (isset($options) && is_array($options) && isset($options["is_thumbnail"]))?$options["is_thumbnail"]:'1',
				'is_excerpt' => (isset($options) && is_array($options) && isset($options["is_excerpt"]))?$options["is_excerpt"]:'1',
				'related' => (isset($options) && is_array($options) && isset($options["related"]))?$options["related"]:'0',
				'thumb_size' => (isset($options) && is_array($options) && isset($options["thumb_size"]))?$options["thumb_size"]:'75',
				'excerpt_length' => (isset($options) && is_array($options) && isset($options["excerpt_length"]))?$options["excerpt_length"]:'15',
				'is_reversed' => (isset($options) && is_array($options) && isset($options["is_reversed"]))?$options["is_reversed"]:'0',
				'is_label' => (isset($options) && is_array($options) && isset($options["is_label"]))?$options["is_label"]:'0',
				'custom_prev_label' => (isset($options) && is_array($options) && isset($options["custom_prev_label"]))?$options["custom_prev_label"]:'',
				'custom_next_label' => (isset($options) && is_array($options) && isset($options["custom_next_label"]))?$options["custom_next_label"]:'',
				'is_custom_bg' => (isset($options) && is_array($options) && isset($options["is_custom_bg"]))?$options["is_custom_bg"]:'0',
				'custom_prev_label_nav_bg' => (isset($options) && is_array($options) && isset($options["custom_prev_label_nav_bg"]))?$options["custom_prev_label_nav_bg"]:'',
				'custom_next_label_nav_bg' => (isset($options) && is_array($options) && isset($options["custom_next_label_nav_bg"]))?$options["custom_next_label_nav_bg"]:'',
				'style' => (isset($options) && is_array($options) && isset($options["style"]))?$options["style"]:'',
				'custom_post_type' => (isset($options) && is_array($options) && isset($options["custom_post_type"]))?$options["custom_post_type"]:'post',
				'custom_taxonomy' => (isset($options) && is_array($options) && isset($options["custom_taxonomy"]))?$options["custom_taxonomy"]:''
			);
			add_option("rp_post_nav_options", serialize($options));
		}
		function handle_rp_post_nav_admin_help() {
			include 'admin/rp-post-nav-admin-help.php';
		}
		function wp_admin_menu() {
			add_menu_page( 'RP Post Nav', 'RP Post Nav', 'manage_options', 'rp-post-nav', array(&$this, 'handle_rp_post_nav_options'), 'dashicons-leftright' );
			add_submenu_page( 'rp-post-nav', 'RP Post Nav Settings', 'Settings', 'manage_options', 'rp-post-nav', array(&$this, 'handle_rp_post_nav_options') );
			add_submenu_page( 'rp-post-nav', 'RP Post Nav Help', 'Help', 'manage_options', 'rp-post-nav-help', array(&$this, 'handle_rp_post_nav_admin_help') );
		}
		function rp_post_nav_admin_stylesheet() {
			wp_register_style( 'rp-post-nav-admin-style', plugins_url('admin/css/style.css', __FILE__ ) );
			wp_enqueue_style( 'rp-post-nav-admin-style' );
		}
		function rp_post_nav_stylesheet() {
			wp_register_style( 'rp-post-nav-style', plugins_url('css/style.css', __FILE__) );
			wp_enqueue_style( 'rp-post-nav-style' );
		}
		function rp_post_nav_custom_css() {
			$settings = $this->get_rp_post_nav_options();
			echo '<style type="text/css">'.$settings['style'].'</style>';
		}
	}
else:
	exit('RP Post Nav Already Exists');
endif;

$RPPostNav = new RPPostNav();
if(isset($RPPostNav)){
	register_activation_hook(__FILE__, array(&$RPPostNav, 'rp_post_nav_install'));
	add_filter('wp_head', array(&$RPPostNav, 'rp_post_nav_custom_css'));
	add_filter('the_content', array(&$RPPostNav, 'rp_post_nav_display'));
	add_action('admin_menu', array(&$RPPostNav, 'wp_admin_menu'));
	add_action( 'admin_enqueue_scripts', array(&$RPPostNav, 'rp_post_nav_admin_stylesheet') );
	add_action( 'wp_enqueue_scripts', array(&$RPPostNav, 'rp_post_nav_stylesheet'));
	add_shortcode('RPPostNav', array(&$RPPostNav, 'rp_post_nav_shortcode'));
}


?>