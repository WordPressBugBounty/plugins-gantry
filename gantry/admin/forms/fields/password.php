<?php
/**
 * @version   $Id: password.php 58623 2012-12-15 22:01:32Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die;

gantry_import('core.config.gantryformfield');


class GantryFormFieldPassword extends GantryFormField
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since    1.6
	 */
	protected $type = 'password';
	protected $basetype = 'password';

	/**
	 * Method to get the field input markup.
	 *
	 * @return    string    The field input markup.
	 * @since    1.6
	 */
	public function getInput()
	{
		// Initialize some field attributes.
		$size      = $this->element['size'] ? ' size="' . (int)$this->element['size'] . '"' : '';
		$maxLength = $this->element['maxlength'] ? ' maxlength="' . (int)$this->element['maxlength'] . '"' : '';
		$class     = $this->element['class'] ? ' class="' . (string)$this->element['class'] . '"' : '';
		$auto      = ((string)$this->element['autocomplete'] == 'off') ? ' autocomplete="off"' : '';
		$readonly  = ((string)$this->element['readonly'] == 'true') ? ' readonly="readonly"' : '';
		$disabled  = ((string)$this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';

		// Initialize JavaScript field attributes.
		$onchange = $this->element['onchange'] ? ' onchange="' . (string)$this->element['onchange'] . '"' : '';

		return '<input type="password" name="' . $this->name . '" id="' . $this->id . '"' . ' value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' . $auto . $class . $readonly . $disabled . $size . $maxLength . '/>';
	}
}
