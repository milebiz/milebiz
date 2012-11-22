<?php
/*
* ___COPY__RIGHT___
*/

/**
 * @since 1.5.0
 */
class ReferralprogramRulesModuleFrontController extends ModuleFrontController
{
	public $content_only = true;
	
	public $display_header = false;
	
	public $display_footer = false;
	
	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();
		$xmlFile = _PS_MODULE_DIR_.'referralprogram/referralprogram.xml';
		if (file_exists($xmlFile))
		{
			if ($xml = @simplexml_load_file($xmlFile))
			{
				$this->context->smarty->assign(array(
					'xml' => $xml,
					'paragraph' => 'paragraph_'.$this->context->language->id
				));
			}
		}
		$this->setTemplate('rules.tpl');
	}
}