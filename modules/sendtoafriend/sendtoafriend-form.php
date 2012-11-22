<?php
/*
* ___COPY__RIGHT___
*/

include(dirname(__FILE__).'/../../config/config.inc.php');
require_once(dirname(__FILE__).'/sendtoafriend.php');

$sendtoafriend = new sendToAFriend($dontTranslate = true);
echo $sendtoafriend->displayPageForm();

