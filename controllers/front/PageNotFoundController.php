<?php
/*
* ___COPY__RIGHT___
*/

class PageNotFoundControllerCore extends FrontController
{
	public $php_self = '404';
	public $page_name = 'pagenotfound';

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');
		parent::initContent();

		$this->setTemplate(_PS_THEME_DIR_.'404.tpl');
	}
}

