<?php
/**
 * @version   $Id: yoast.php 60800 2017-08-28 13:08:13Z jakub $
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
class GantryGizmoYOAST extends GantryGizmo {

	var $_name = 'yoast';

	function isEnabled() {
		if( class_exists( 'WPSEO_Admin' ) ) {
			return true;
		}

		return false;
	}

	/**
	 *  Copyright (C) 2017 Jakub Baran
	 */
	function admin_init() {
		global $gantry, $pagenow, $wpseo_admin;

		if( isset( $pagenow ) && isset( $wpseo_admin ) ) {
			if ( ( $pagenow == 'admin.php' && ( isset( $_GET['page'] ) && $_GET['page'] === 'gantry-theme-settings' ) ) ||
			     ( $pagenow == 'admin.php' && ( isset( $_GET['page'] ) && strpos($_GET['page'],'rokgallery') !== false ) ) ||
			     ( $pagenow == 'admin.php' && ( isset( $_GET['page'] ) && strpos($_GET['page'],'roksprocket') !== false ) ) ||
			     ( $pagenow == 'widgets.php' && $gantry->get('yoastwidgets-enabled') === '1' )
			) {
				$this->remove_class_action('admin_enqueue_scripts', 'WPSEO_Admin', 'config_page_scripts');
				$this->remove_class_action('admin_enqueue_scripts', 'Yoast_Modal', 'enqueue_assets');
				$this->remove_class_action('admin_enqueue_scripts', 'WPSEO_Admin_Asset_Manager', 'register_wp_assets');
			}
		}
	}

	// remove_class_action made by Digerkam
	function remove_class_action($action, $class, $method) {
		global $wp_filter;
		if (isset($wp_filter[$action])) {
			$len = strlen($method);
			foreach ($wp_filter[$action] as $pri => $actions) {
				foreach ($actions as $name => $def) {
					if (substr($name,-$len) == $method) {
						if (is_array($def['function'])) {
							if (get_class($def['function'][0]) == $class) {
								if (is_object($wp_filter[$action]) && isset($wp_filter[$action]->callbacks)) {
									unset($wp_filter[$action]->callbacks[$pri][$name]);
								} else {
									unset($wp_filter[$action][$pri][$name]);
								}
							}
						}
					}
				}
			}
		}
	}
}
