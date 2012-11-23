<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

class SearchControllerCore extends FrontController
{
	public $php_self = 'search';
	public $instant_search;
	public $ajax_search;

	/**
	 * Initialize search controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		parent::init();

		$this->instant_search = Tools::getValue('instantSearch');

		$this->ajax_search = Tools::getValue('ajaxSearch');

		if ($this->instant_search || $this->ajax_search)
		{
			$this->display_header = false;
			$this->display_footer = false;
		}
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$query = Tools::replaceAccentedChars(urldecode(Tools::getValue('q')));
		if ($this->ajax_search)
		{
			$searchResults = Search::find((int)(Tools::getValue('id_lang')), $query, 1, 10, 'position', 'desc', true);
			foreach ($searchResults as &$product)
				$product['product_link'] = $this->context->link->getProductLink($product['id_product'], $product['prewrite'], $product['crewrite']);
			die(Tools::jsonEncode($searchResults));
		}

		if ($this->instant_search && !is_array($query))
		{
			$this->productSort();
			$this->n = abs((int)(Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			$this->p = abs((int)(Tools::getValue('p', 1)));
			$search = Search::find($this->context->language->id, $query, 1, 10, 'position', 'desc');
			Hook::exec('actionSearch', array('expr' => $query, 'total' => $search['total']));
			$nbProducts = $search['total'];
			$this->pagination($nbProducts);
			$this->context->smarty->assign(array(
				'products' => $search['result'], // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $search['result'],
				'nbProducts' => $search['total'],
				'search_query' => $query,
				'instant_search' => $this->instant_search,
				'homeSize' => Image::getSize('home_default')));
		}
		else if (($query = Tools::getValue('search_query', Tools::getValue('ref'))) && !is_array($query))
		{
			$this->productSort();
			$this->n = abs((int)(Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			$this->p = abs((int)(Tools::getValue('p', 1)));
			$search = Search::find($this->context->language->id, $query, $this->p, $this->n, $this->orderBy, $this->orderWay);
			Hook::exec('actionSearch', array('expr' => $query, 'total' => $search['total']));
			$nbProducts = $search['total'];
			$this->pagination($nbProducts);
			$this->context->smarty->assign(array(
				'products' => $search['result'], // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $search['result'],
				'nbProducts' => $search['total'],
				'search_query' => $query,
				'homeSize' => Image::getSize('home_default')));
		}
		else if (($tag = urldecode(Tools::getValue('tag'))) && !is_array($tag))
		{
			$nbProducts = (int)(Search::searchTag($this->context->language->id, $tag, true));
			$this->pagination($nbProducts);
			$result = Search::searchTag($this->context->language->id, $tag, false, $this->p, $this->n, $this->orderBy, $this->orderWay);
			Hook::exec('actionSearch', array('expr' => $tag, 'total' => count($result)));
			$this->context->smarty->assign(array(
				'search_tag' => $tag,
				'products' => $result, // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $result,
				'nbProducts' => $nbProducts,
				'homeSize' => Image::getSize('home_default')));
		}
		else
		{
			$this->context->smarty->assign(array(
				'products' => array(),
				'search_products' => array(),
				'pages_nb' => 1,
				'nbProducts' => 0));
		}
		$this->context->smarty->assign(array('add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'), 'comparator_max_item' => Configuration::get('PS_COMPARATOR_MAX_ITEM')));

		$this->setTemplate(_PS_THEME_DIR_.'search.tpl');
	}

	public function displayHeader($display = true)
	{
		if (!$this->instant_search && !$this->ajax_search)
			parent::displayHeader();
		else
			$this->context->smarty->assign('static_token', Tools::getToken(false));
	}

	public function displayFooter($display = true)
	{
		if (!$this->instant_search && !$this->ajax_search)
			parent::displayFooter();
	}

	public function setMedia()
	{
		parent::setMedia();

		if (!$this->instant_search && !$this->ajax_search)
			$this->addCSS(_THEME_CSS_DIR_.'product_list.css');
			
		if (Configuration::get('PS_COMPARATOR_MAX_ITEM'))
			$this->addJS(_THEME_JS_DIR_.'products-comparison.js');
	}
}
