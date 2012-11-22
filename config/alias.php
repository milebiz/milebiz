<?php
/*
* ___COPY__RIGHT___
*/

function fd($var)
{
	return (Tools::fd($var));
}

function p($var)
{
	return (Tools::p($var));
}

function d($var)
{
	Tools::d($var);
}

function ppp($var)
{
	return (Tools::p($var));
}

function ddd($var)
{
	Tools::d($var);
}

/**
 * Sanitize data which will be injected into SQL query
 *
 * @param string $string SQL data which will be injected into SQL query
 * @param boolean $htmlOK Does data contain HTML code ? (optional)
 * @return string Sanitized data
 */
function pSQL($string, $htmlOK = false)
{
	// Avoid thousands of "Db::getInstance()"...
	static $db = false;
	if (!$db)
		$db = Db::getInstance();

	return $db->escape($string, $htmlOK);
}

function bqSQL($string)
{
	return str_replace('`', '\`', pSQL($string));
}

/**
 * @deprecated
 */
function nl2br2($string)
{
	Tools::displayAsDeprecated();
	return Tools::nl2br($string);
}