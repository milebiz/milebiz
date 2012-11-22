<?php
/*
* ___COPY__RIGHT___
*/

require_once 'init.php';

try
{
	require_once _PS_INSTALL_PATH_.'classes/controllerHttp.php';
	InstallControllerHttp::execute();
}
catch (MileBizInstallerException $e)
{
	$e->displayMessage();
}
