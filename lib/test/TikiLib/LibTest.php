<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: LibTest.php 57964 2016-03-17 20:04:05Z jonnybradley $

class TikiLib_LibTest extends PHPUnit_Framework_TestCase
{
	public function testLib_shouldReturnInstanceOfTikiLib()
	{
		$this->assertEquals('TikiLib', get_class(TikiLib::lib('tiki')));
	}
	
	public function testLib_shouldReturnInstanceOfCalendar()
	{
		$this->assertEquals('CalendarLib', get_class(TikiLib::lib('calendar')));
	}
	
	public function testLib_shouldReturnNullForInvalidClass()
	{
		$this->assertNull(TikiLib::lib('invalidClass'));
	}
}