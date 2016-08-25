<?php
/**
 * Plugin Name: MediaPress - Lightbox Colorbox Bridge
 * Plugin URI: https://buddydev.com/support/forums/topic/how-to-use-third-party-lightbox-plugin-to-open-images/
 * Version: 1.0.0
 * Author: BuddyDev Team
 * Author URI: https://buddydev.com
 * Description: Use the colorbox instead of our default lightbox on single gallery
 * It is just an example
 * 
 * License: GPL2 or Above
 * 
 */

class MPP_Addon_Lightbox_Colorbox_Helper {
	/**
	 * Singleton Instance
	 * 
	 * @var MPP_Addon_Lightbox_Colorbox_Helper
	 */
	private static $instance = null;
	
	private $path;
	private $url;
	
	
	private function __construct () {
		
		$this->setup();
	}
	
	/**
	 * Get the singleton instance
	 * 
	 * @return MPP_Addon_Lightbox_Colorbox_Helper
	 */
	public static function get_instance() {
		
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
		
	}
	/**
	 * Setup hooks 
	 */
	private function setup() {
		
		//setup plugin path
		$this->path = plugin_dir_path( __FILE__ );
		$this->url = plugin_dir_url( __FILE__ );


		//load files when MediaPress is loaded
		add_action( 'mpp_loaded', array( $this, 'load' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_js' ) );
	}
	
	/**
	 * Load required files
	 */
	public function load() {
		
		//$files array is an array of file paths(relative to this plugin's directory) to the files we want to include
		$files = array(

			'core/filters.php',

		);

		foreach ( $files as $file ) {
			require_once $this->path . $file ;
		}
		
	}

	/**
	 *	Get the plugin directory absolute url
	 *  
	 * @return string url to the plugin directory e.g. http://example.com/wp-content/plugins/xyz-addon/
	 */
	public function get_url() {
		return $this->url;
	}
	
	/**
	 * Get absolute path to this plugin directory
	 * 
	 * @return string the real path tot his plugin directory e.g /var/www/xyz/wp/wp-content/plugins/mpp-skeleton-addon/
	 */
	public function get_path() {
		return $this->path;
	}

	//load js
	public function load_js() {

		if ( ! function_exists( 'mpp_is_single_gallery' ) || ! mpp_is_single_gallery() ) {
			return ;
		}
		wp_enqueue_script( 'mpp-colorbox-bridge', $this->url . 'assets/js/mpp-lightbox-bridge.js', array( 'jquery' ) );

	}
	
}
//initialize
MPP_Addon_Lightbox_Colorbox_Helper::get_instance();
