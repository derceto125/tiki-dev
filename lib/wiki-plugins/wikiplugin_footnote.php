<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_footnote.php 58071 2016-03-24 22:58:02Z jyhem $

function wikiplugin_footnote_info()
{
	return array(
		'name' => tra('Footnote'),
		'documentation' => 'PluginFootnote',
		'description' => tra('Create automatically numbered footnotes (together with PluginFootnoteArea)'),
		'prefs' => array('wikiplugin_footnote'),
		'body' => tra('The footnote'),
		'iconname' => 'superscript',
		'filter' => 'wikicontent',
		'introduced' => 3,
		'params' => array(
			'sameas' => array(
				'required' => false,
				'name' => tra('Same as'),
				'description' => tra('Tag to existing footnote'),
				'since' => '5.0',
				'default' => '',
				'filter' => 'int',
			),
			'tip' => array(
				'required' => false,
				'name' => tra('Show text on mouseover'),
				'description' => tra('Extra text which is shown on mouse over'),
				'since' => '16.0',
				'default' => '',
				'filter' => 'text',
			),
			'class' => array(
				'required' => false,
				'name' => tra('Class'),
				'description' => tra('Add class to footnotearea'),
				'since' => '14.0',
				'default' => '',
				'accepted' => tra('Valid CSS class'),
			),
		)
	);
}

function wikiplugin_footnote($data, $params)
{
	if (! isset($GLOBALS['footnoteCount'])) {
		$GLOBALS['footnoteCount'] = 0;
		$GLOBALS['footnotesData'] = array();
		$GLOBALS['footnotesClass'] = array();
	}

	if (! empty($data)) {
		$data = trim($data);
		if (! isset($GLOBALS['footnotesData'][$data])) {
			$GLOBALS['footnoteCount']++;
			$GLOBALS['footnotesData'][$GLOBALS['footnoteCount']] = $data;
			$GLOBALS['footnotesClass'][$GLOBALS['footnoteCount']] = $params["class"];
		}

		$number = $GLOBALS['footnoteCount'];
	} elseif (isset($params['sameas'])) {
		$number = $params['sameas'];
	}
	if (isset($params["class"])){
		$class= ' class="tips '.$params["class"].'"';
	} else {
		$class= ' class="tips"';
	}
	$html = '~np~' . "<sup class=\"footnote$number\"><a id=\"ref_footnote$number\" href=\"#footnote$number\"$class title=\":" . htmlspecialchars($params["tip"],ENT_QUOTES) . "\" >[$number]</a></sup>" . '~/np~';

	return $html;
}
