<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: TypeFactory.php 58052 2016-03-22 12:57:51Z patrick-proulx $

class Search_Elastic_TypeFactory implements Search_Type_Factory_Interface
{
	function plaintext($value)
	{
		// Elasticsearch does not like boolean values
		if (is_bool($value)) {
			$value = (int) $value;
		}
		return new Search_Type_PlainText($value);
	}

	function wikitext($value)
	{
		return new Search_Type_WikiText($value);
	}

	function timestamp($value)
	{
		return new Search_Type_DateTime($value);
	}

	function identifier($value)
	{
		return new Search_Type_Whole($value);
	}

	function numeric($value)
	{
		return new Search_Type_Numeric($value);
	}

	function multivalue($values)
	{
		return new Search_Type_MultivaluePlain(array_values((array) $values));
	}

	function object($value)
	{
		return new Search_Type_Object($value);
	}

	function nested($value)
	{
		return new Search_Type_Nested($value);
	}

	function sortable($value)
	{
		return new Search_Type_PlainShortText($value);
	}
}

