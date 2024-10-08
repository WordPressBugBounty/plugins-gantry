<?php
/**
 * @version   $Id: compatibility.php 60974 2014-06-18 12:01:07Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined( 'GANTRY_VERSION' ) or die();

gantry_import( 'core.gantrygizmo' );

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryGizmoCompatibility extends GantryGizmo {

	var $_name = 'compatibility';

	function isEnabled() {
		return true;
	}

	function init() {
		/** @global $gantry Gantry */
		global $gantry;

		/**
		 * WP E-Commerce Compatibility
		 */

		if( defined( 'WPSC_VERSION' ) ) {
			add_action( 'init', array( &$this, 'wpsc_filter_template_parts' ), 20 );
		}

		/**
		 * Jigoshop Compatibility
		 */

		remove_action( 'jigoshop_sidebar', 'jigoshop_get_sidebar', 10 );

		/**
		 * WP SEO Compatibility
		 */
		
		if( function_exists( 'get_wpseo_options' ) ) {
			add_action( 'init', array( &$this, 'wp_seo_fix_force_rewrite_titles' ) );
		}

		/**
		 * Cart66 Compatibility
		 */
		
		if( class_exists( 'Cart66' ) ) {
			add_action( 'template_redirect', array( 'Cart66', 'enqueueScripts' ) );
		}

		/**
		 * NextGen Gallery Compatibility
		 */
		
		if( class_exists( 'C_Photocrati_Resource_Manager' ) ) {
			define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
		}

	}

	/**
	 * WP E-Commerce  - Ability to override plugin theme files
	 */

	function wpsc_filter_template_parts() {
		foreach ( wpsc_get_theme_files() as $template ) {
			add_filter( WPEC_TRANSIENT_THEME_PATH_PREFIX . $template, array( &$this, 'wpsc_template_part' ) );
		}
	}

	/**
	 * WP E-Commerce  - Ability to override plugin theme files
	 */

	function wpsc_template_part( $tmpl ) {
		$file = basename( $tmpl );
		if( file_exists( trailingslashit( get_template_directory() ) . $file ) ) {
			return trailingslashit( get_template_directory() ) . $file;
		}
		return $tmpl;
	}

	/**
	 * WP SEO - Fix for the bad rendering of page when "Force Rewrite Titles" is enabled
	 */
	
	function wp_seo_fix_force_rewrite_titles() {
		global $wpseo_front;

		remove_action( 'get_header', array( $wpseo_front, 'force_rewrite_output_buffer' ) );
		remove_action( 'wp_footer', array( $wpseo_front, 'flush_cache' ) );
	}

}