<?php
/*
* ___COPY__RIGHT___
*/

include(dirname(__FILE__).'/../config/config.inc.php');

if (isset($_GET['secure_key']))
{
	$secureKey = md5(_COOKIE_KEY_.Configuration::get('PS_SHOP_NAME'));
	if (!empty($secureKey) AND $secureKey === $_GET['secure_key'])
                Currency::refreshCurrencies();
}