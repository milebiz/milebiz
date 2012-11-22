<?php
/*
* ___COPY__RIGHT___
*/

class AdminAddonsCatalogControllerCore extends AdminController
{
	public function initContent()
	{
		$this->context->smarty->assign('parentDomain', Tools::getHttpHost(true).substr($_SERVER['REQUEST_URI'], 0, -1 * strlen(basename($_SERVER['REQUEST_URI']))));
		parent::initContent();
	}
}


