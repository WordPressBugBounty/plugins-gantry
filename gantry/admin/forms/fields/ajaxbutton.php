<?php
/**
 * @version   $Id: ajaxbutton.php 59361 2013-03-13 23:10:27Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('GANTRY_VERSION') or die;

/**
 * Form Field class for the Joomla Platform.
 * Supports a one line text field.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.text.html#input.text
 * @since       11.1
 */
class GantryFormFieldAjaxButton extends GantryFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  11.1
	 */
	protected $type = 'ajaxbutton';
	//static $assets_loaded = false;

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	public function getInput(){
		global $gantry;

		$html = array();

		//if (!self::$assets_loaded) {
		//	$gantry->addScript($gantry->gantryUrl . '/admin/widgets/ajaxbutton/js/ajaxbutton.js');
		//	self::$assets_loaded = true;
		//}

		// Initialize some field attributes.
		$model 			= $this->element['model'] ? $this->element['model'] : '';
		$action 		= 'gantry_admin';
		$gantry_action 	= $this->element['action'] ? $this->element['action'] : '';
		$text 		= $this->element['text'] ? $this->element['text'] : '';

		$data = "{model: '".$model."', action: '".$action."', gantry_action: '".$gantry_action."'}";

		$datasets  = ' data-ajaxbutton="'.$data.'"';

		$html[] = '<div class="rok-button rok-button-primary"'.$datasets.'>' . _g((string)$text) . '</div>';

		return implode("\n", $html);
	}
}
