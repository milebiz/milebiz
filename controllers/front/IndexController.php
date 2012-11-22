<?php
/*
* ___COPY__RIGHT___
*/

class IndexControllerCore extends FrontController
{
	public $php_self = 'index';

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$this->context->smarty->assign('HOOK_HOME', Hook::exec('displayHome'));
		$this->setTemplate(_PS_THEME_DIR_.'index.tpl');
	}
}
