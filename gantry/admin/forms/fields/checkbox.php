<?php
/**
 * @version   $Id: checkbox.php 58623 2012-12-15 22:01:32Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die;

gantry_import('core.config.gantryformfield');


class GantryFormFieldCheckbox extends GantryFormField
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since    1.6
	 */
	protected $type = 'checkbox';
	protected $basetype = 'checkbox';

	/**
	 * Method to get the field input markup.
	 *
	 * @return    string    The field input markup.
	 * @since    1.6
	 */
	public function getInput()
	{
		// Initialize some field attributes.
		$class    = $this->element['class'] ? ' class="' . (string)$this->element['class'] . '"' : '';
		$disabled = ((string)$this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$checked  = ((string)$this->element['value'] == $this->value) ? ' checked="checked"' : '';

		// Initialize JavaScript field attributes.
		$onclick = $this->element['onclick'] ? ' onclick="' . (string)$this->element['onclick'] . '"' : '';

		return '<input type="checkbox" name="' . $this->name . '" id="' . $this->id . '"' . ' value="' . htmlspecialchars((string)$this->element['value'], ENT_COMPAT, 'UTF-8') . '"' . $class . $checked . $disabled . $onclick . '/>';
	}
}
