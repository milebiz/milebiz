<?php
/*
* ___COPY__RIGHT___
*/

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/blocklayered.php');

$blockLayered = new BlockLayered();
echo $blockLayered->ajaxCall();