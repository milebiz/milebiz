<?php
/*
* ___COPY__RIGHT___
*/

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/trackingfront.php');

$tf = new TrackingFront();
if (!$tf->active)
	Tools::redirect('index.php?controller=404');
$tf->postProcess();
echo $tf->isLogged() ? $tf->displayAccount() : $tf->displayLogin();

