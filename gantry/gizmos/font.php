<?php
/**
 * @version   $Id: webfonts.php 59361 2013-03-13 23:10:27Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die();

gantry_import('core.gantrygizmo');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryGizmoFont extends GantryGizmo
{

	var $_name = 'font';
	var $_standard_fonts = array(
		"default",
		"geneva",
		"georgia",
		"helvetica",
		"helveticaneue",
		"lucida",
		"optima",
		"palatino",
		"trebuchet",
		"tahoma"
	);

	private $_value_backup;

	function isEnabled()
	{
		return true;
	}

	function query_parsed_init()
	{
		/** @global $gantry Gantry */
		global $gantry;

		$font_family = $gantry->get('font-family');

		if (strpos($font_family, ':')) {
			$explode = explode(':', $font_family);

			$delimiter = $explode[0];
			$name      = $explode[1];
			$variant   = isset($explode[2]) ? $explode[2] : null;

			// we re-set the font-family to a font-name with no delimiter
			// for backward compatibility
			$this->_backwardCompatibility($name);
		} else {
			$delimiter = false;
			$name      = $font_family;
			$variant   = null;
		}

		if (isset($variant) && $variant) $variant = ':' . $variant;

		switch ($delimiter) {
			// standard fonts
			case 's':
				break;
			// google fonts
			case 'g':
				$this->_addGoogleFont($name, $variant);
				break;
			default:
				if ($this->_isStandardFont($name)) break;
				if ($this->_searchForGoogleFont($name)) $this->_addGoogleFont($name, $variant);
		}
	}

	function _isStandardFont($name)
	{
		/** @var $gantry Gantry */
		global $gantry;
		if (strtolower($name) == strtolower($gantry->templateName) || in_array(strtolower($name), $this->_standard_fonts)) {
			return true;
		} else {
			return false;
		}
	}

	function _addGoogleFont($name, $variant)
	{
		/** @var $gantry Gantry */
		global $gantry;

		$variant = $variant ? $variant : '';

		$protocol = is_ssl() ? 'https' : 'http';
		$gantry->addStyle("{$protocol}://fonts.googleapis.com/css?family=" . str_replace(" ", "+", $name) . $variant . "&amp;subset=latin,latin-ext");
		$gantry->addInlineStyle("h1, h2 { font-family: '" . $name . "', 'Helvetica', arial, serif; }");
	}

	function _searchForGoogleFont($name)
	{
		/** @var $gantry Gantry */
		global $gantry;
		$google_json = $gantry->gantryPath . '/' . 'admin' . '/' . 'widgets' . '/' . 'fonts' . '/' . 'js' . '/' . 'google-fonts.json';
		if (!file_exists($google_json)) return false;

		$fonts = json_decode(file_get_contents($google_json), true);
		$fonts = $fonts['items'];

		return $this->_in_array_r($name, $fonts);
	}

	function _backwardCompatibility($value)
	{
		/** @var $gantry Gantry */
		global $gantry;
		$param = $this->_name . '-family';

		if (in_array($param, $gantry->_bodyclasses)) {
			$position = array_search($param, $gantry->_bodyclasses);
			unset($gantry->_bodyclasses[$position]);
			array_splice($gantry->_bodyclasses, $position, 0, strtolower(str_replace(" ", "-", $param . '-' . $value)));
		}
	}

	function _in_array_r($needle, $haystack, $strict = true)
	{
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->_in_array_r($needle, $item, $strict))) {
				return true;
			}
		}

		return false;
	}
}