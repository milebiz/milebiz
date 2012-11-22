<?php
/*
* ___COPY__RIGHT___
*/

/**
 * This file will be removed in 1.6
 */

if (isset(Context::getContext()->controller))
	$controller = Context::getContext()->controller;
else
{
	$controller = new FrontController();
	$controller->init();
}