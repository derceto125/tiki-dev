<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id$

abstract class TikiAddons
{
	private static $available = array();
	private static $paths = array();
	protected static $addons = array();

	public static function refresh()
	{
		self::$available = array();
		self::$paths = array();
		$addon_list = glob(TIKI_PATH . '/addons/*/tikiaddon.json');
		if ( $addon_list != NULL ) {
			foreach ( $addon_list as $file ) {
				try {
					$conf = json_decode(file_get_contents($file));
					$package = str_replace('_', '/', basename(dirname($file)));
					self::$available[$package] = $conf;
					self::$paths[$package] = dirname($file);
					self::initializeGroupApi($package);
					self::initializeNavbarApi($package);
					self::initializeFileGalleryApi($package);
					self::initializeEventsApi($package);
					self::initializeSearchApi($package);
				} catch (InvalidArgumentException $e) {
					// Do nothing, absence of tikiaddon.json
				}
			}
		}
	}

	private static function initializeGroupApi($package) {
		if (!empty(self::$available[$package]->api->group)) {
			$tracker = self::$available[$package]->api->group->tracker;
			$public_catroot = self::$available[$package]->api->group->public_catroot;
			$private_catroot = self::$available[$package]->api->group->private_catroot;
			$managementpage = self::$available[$package]->api->group->managementpage;
			$homepage = self::$available[$package]->api->group->homepage;
			TikiAddons_Api_Group::setTracker($package, $tracker);
			TikiAddons_Api_Group::setPublicCatroot($package, $public_catroot);
			TikiAddons_Api_Group::setPrivateCatroot($package, $private_catroot);
			TikiAddons_Api_Group::setManagementPage($package, $managementpage);
			TikiAddons_Api_Group::setHomePage($package, $homepage);
		}
	}

	private static function initializeNavbarApi($package) {
		if (!empty(self::$available[$package]->api->navbar)) {
			$tpl = self::$available[$package]->api->navbar->tpl;
			TikiAddons_Api_NavBar::setNavBar($package, $tpl);
		}
	}

	private static function initializeFileGalleryApi($package) {
		if (!empty(self::$available[$package]->api->filegallery)) {
			$parent = self::$available[$package]->api->filegallery->parent;
			TikiAddons_Api_FileGallery::setParents($package, $parent);
			$tracker = self::$available[$package]->api->filegallery->tracker;
			TikiAddons_Api_FileGallery::setTrackers($package, $tracker);
		}
	}

	private static function initializeEventsApi($package) {
		if (!empty(self::$available[$package]->api->eventmap)) {
			$eventMap = self::$available[$package]->api->eventmap;
			TikiAddons_Api_Events::setEventMap($package, $eventMap);
		}
	}

	private static function initializeSearchApi($package) {
		if (!empty(self::$available[$package]->api->search->addonSources)) {
			$sources = self::$available[$package]->api->search->addonSources;
			TikiAddons_Api_Search::setAddonSources($package, $sources);
		}
	}

	public static function get($name)
	{
		if (isset(self::$addons[$name])) {
			return self::$addons[$name];
		}

		return new TikiAddons_Addon($name);
	}

	public static function getAvailable()
	{
		return self::$available;
	}

	public static function getPaths()
	{
		return self::$paths;
	}

}
