<?php

/**
 * @version   $Id: cacheDriver.interface.php 59361 2013-03-13 23:10:27Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 *
 *
 * Original Author and Licence
 * @author    Mateusz 'MatheW' Wójcik, <mat.wojcik@gmail.com>
 * @link      http://mwojcik.pl
 * @version   1.0
 * @license   GPL
 */
interface GantryCacheLibDriver
{
	/**
	 * Sets data to cache
	 *
	 * @param string $groupName  Name of group of cache
	 * @param string $identifier Identifier of data
	 * @param mixed  $data       Data
	 *
	 * @return boolean
	 */
	public function set($groupName, $identifier, $data);

	/**
	 * Gets data from cache
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier of data
	 *
	 * @return mixed
	 */
	public function get($groupName, $identifier);

	/**
	 * Clears cache of specified identifier of group
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return boolean
	 */
	public function clearCache($groupName, $identifier);

	/**
	 * Clears cache of specified group
	 *
	 * @param string $groupName Name of group
	 *
	 * @return boolean
	 */
	public function clearGroupCache($groupName);

	/**
	 * Clears all cache generated by this class with this driver
	 *
	 * @return boolean
	 */
	public function clearAllCache();

	/**
	 * Gets last modification time of specified cache data
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return int
	 */
	public function modificationTime($groupName, $identifier);

	/**
	 * Check if cache data exists
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return boolean
	 */
	public function exists($groupName, $identifier);


	/**
	 * Sets the lifetime of the cache
	 *
	 * @abstract
	 *
	 * @param  int $lifeTime Lifetime of the cache
	 *
	 * @return void
	 */
	public function setLifeTime($lifeTime);

} /* end of interface CacheDriver */
