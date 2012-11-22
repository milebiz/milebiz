<?php
/*
* ___COPY__RIGHT___
*/

class NewProductsControllerCore extends FrontController
{
	public $php_self = 'new-products';

	public function setMedia()
	{
		parent::setMedia();
		$this->addCSS(_THEME_CSS_DIR_.'product_list.css');

		if (Configuration::get('PS_COMPARATOR_MAX_ITEM'))
			$this->addJS(_THEME_JS_DIR_.'products-comparison.js');
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$this->productSort();

		$nbProducts = (int)Product::getNewProducts(
			$this->context->language->id,
			(isset($this->p) ? (int)($this->p) - 1 : null),
			(isset($this->n) ? (int)($this->n) : null),
			true
		);

		$this->pagination($nbProducts);

		$this->context->smarty->assign(array(
			'products' => Product::getNewProducts($this->context->language->id, (int)($this->p) - 1, (int)($this->n), false, $this->orderBy, $this->orderWay),
			'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
			'nbProducts' => (int)($nbProducts),
			'homeSize' => Image::getSize('home_default'),
			'comparator_max_item' => Configuration::get('PS_COMPARATOR_MAX_ITEM')
		));

		$this->setTemplate(_PS_THEME_DIR_.'new-products.tpl');
	}
}

