<?php
/**
 * @version   $Id: divider.php 61614 2015-12-09 11:12:41Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetDivider", "init"));
add_action('admin_head-widgets.php', array('GantryWidgetDivider', 'addHeaders'), -1000);

class GantryWidgetDivider extends WP_Widget
{
	var $_defaults = array();

	static function init()
	{
		register_widget("GantryWidgetDivider");
	}

	function __construct()
	{
		$widget_ops  = array('classname' => 'widget_gantry_divider', 'description' => _g('Gantry Divider Widget'));
		$control_ops = array('width' => 0, 'height' => 0);
		parent::__construct('gantrydivider', _g('Gantry Divider'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$defaults = $this->_defaults;
	}

	function form($instance)
	{
		return "noform";
	}

	static function addHeaders()
	{
		/** @global $gantry Gantry */
		global $gantry;
		$gantry->addScript('gantrydivider.js');
		$gantry->addStyle('gantrydivider.css');
	}
}
