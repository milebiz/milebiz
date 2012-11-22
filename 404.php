<?php
/*
* ___COPY__RIGHT___
*/

/* Send the proper status code in HTTP headers */
header('HTTP/1.1 404 Not Found');
header('Status: 404 Not Found');

if (in_array(substr($_SERVER['REQUEST_URI'], -3), array('png', 'jpg', 'gif')))
{
	require_once(dirname(__FILE__).'/config/settings.inc.php');
	header('Location: '.__PS_BASE_URI__.'img/404.gif');
	exit;
}
elseif (in_array(substr($_SERVER['REQUEST_URI'], -3), array('.js', 'css')))
	die('');

require_once(dirname(__FILE__).'/config/config.inc.php');
Controller::getController('PageNotFoundController')->run();
