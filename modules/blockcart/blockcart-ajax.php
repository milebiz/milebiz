<?php
/*
* ___COPY__RIGHT___
*/
// @TODO Find the reason why the blockcart.php is includ multiple time
include_once(dirname(__FILE__).'/blockcart.php');
$context = Context::getContext();
$blockCart = new BlockCart();
echo $blockCart->hookAjaxCall(array('cookie' => $context->cookie, 'cart' => $context->cart));