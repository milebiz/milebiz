<?php
/*
* ___COPY__RIGHT___
*/

// Include some alias functions
require_once(dirname(__FILE__).'/alias.php');
require_once(dirname(__FILE__).'/../classes/Autoload.php');

spl_autoload_register(array(Autoload::getInstance(), 'load'));
