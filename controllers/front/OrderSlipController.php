<?php
/*
* ___COPY__RIGHT___
*/

class OrderSlipControllerCore extends FrontController
{
	public $auth = true;
	public $php_self = 'order-slip';
	public $authRedirection = 'order-slip';
	public $ssl = true;

	public function setMedia()
	{
		parent::setMedia();
		$this->addCSS(_THEME_CSS_DIR_.'history.css');
		$this->addCSS(_THEME_CSS_DIR_.'addresses.css');
		$this->addJqueryPlugin('scrollTo');
		$this->addJS(_THEME_JS_DIR_.'history.js');
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$this->context->smarty->assign('ordersSlip', OrderSlip::getOrdersSlip((int)$this->context->cookie->id_customer));
		$this->setTemplate(_PS_THEME_DIR_.'order-slip.tpl');
	}
}

