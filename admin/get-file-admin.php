<?php
/*
* ___COPY__RIGHT___
*/

define('_PS_ADMIN_DIR_', getcwd());
require(dirname(dirname(__FILE__)).'/config/config.inc.php');
Controller::getController('GetFileController')->run();