<?php
/**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

ob_start();
$timerStart = microtime(true);

//	$_GET['tab'] = $_GET['controller'];
//	$_POST['tab'] = $_POST['controller'];
//	$_REQUEST['tab'] = $_REQUEST['controller'];
try
{
	$context = Context::getContext();
	if (isset($_GET['logout']))
		$context->employee->logout();

	if (!isset($context->employee) || !$context->employee->isLoggedBack())
		Tools::redirectAdmin('index.php?controller=AdminLogin&redirect='.$_SERVER['REQUEST_URI']);

	// Set current index
	// @deprecated global will be removed in 1.6
	global $currentIndex; // retrocompatibility;
	$currentIndex = $_SERVER['SCRIPT_NAME'].(($controller = Tools::getValue('controller')) ? '?controller='.$controller: '');

	if ($back = Tools::getValue('back'))
		$currentIndex .= '&back='.urlencode($back);
	AdminTab::$currentIndex = $currentIndex;

	$iso = $context->language->iso_code;
	include(_PS_TRANSLATIONS_DIR_.$iso.'/errors.php');
	include(_PS_TRANSLATIONS_DIR_.$iso.'/fields.php');
	include(_PS_TRANSLATIONS_DIR_.$iso.'/admin.php');

	/* Server Params */
	$protocol_link = (Configuration::get('PS_SSL_ENABLED')) ? 'https://' : 'http://';
	$protocol_content = (isset($useSSL) AND $useSSL AND Configuration::get('PS_SSL_ENABLED')) ? 'https://' : 'http://';
	$link = new Link($protocol_link, $protocol_content);
	$context->link = $link;
	if (!defined('_PS_BASE_URL_'))
		define('_PS_BASE_URL_', Tools::getShopDomain(true));
	if (!defined('_PS_BASE_URL_SSL_'))
		define('_PS_BASE_URL_SSL_', Tools::getShopDomainSsl(true));

	$path = dirname(__FILE__).'/themes/';
	// if the current employee theme is not valid (check layout.tpl presence), 
	// reset to default theme
	if (empty($context->employee->bo_theme) ||
		!file_exists($path.$context->employee->bo_theme.'/template/layout.tpl'))
	{
		// default admin theme is "default".
		$context->employee->bo_theme = '';
		if (file_exists($path.'default/template/layout.tpl'))
			$context->employee->bo_theme = 'default';
		else
		{
			// if default theme doesn't exists, try to find one, otherwise throw exception
			foreach (scandir($path) as $theme)
				if ($theme[0] != '.' && file_exists($path.$theme.'/template/layout.tpl'))
				{
					$context->employee->bo_theme = $theme;
					break;
				}
			// if no theme is found, admin can't work.
			if (empty($context->employee->bo_theme))
				throw new MileBizException('Unable to load theme for employee, and no valid theme found');
		}
		$context->employee->update();
	}

	// Change shop context ?
	if (Shop::isFeatureActive() && Tools::getValue('setShopContext') !== false)
	{
		$context->cookie->shopContext = Tools::getValue('setShopContext');
		$url = parse_url($_SERVER['REQUEST_URI']);
		$query = (isset($url['query'])) ? $url['query'] : '';
		parse_str($query, $parseQuery);
		unset($parseQuery['setShopContext']);
		Tools::redirectAdmin($url['path'] . '?' . http_build_query($parseQuery, '', '&'));
	}

	$context->currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));


	if ($context->employee->isLoggedBack())
	{
		$shop_id = '';
		Shop::setContext(Shop::CONTEXT_ALL);
		if ($context->cookie->shopContext)
		{
			$split = explode('-', $context->cookie->shopContext);
			if (count($split) == 2)
			{
				if ($split[0] == 'g')
				{
					if ($context->employee->hasAuthOnShopGroup($split[1]))
						Shop::setContext(Shop::CONTEXT_GROUP, $split[1]);
					else
					{
						$shop_id = $context->employee->getDefaultShopID();
						Shop::setContext(Shop::CONTEXT_SHOP, $shop_id);
					}
				}
				elseif ($context->employee->hasAuthOnShop($split[1]))
				{
					$shop_id = $split[1];
					Shop::setContext(Shop::CONTEXT_SHOP, $shop_id);
				}
				else
				{
					$shop_id = $context->employee->getDefaultShopID();
					Shop::setContext(Shop::CONTEXT_SHOP, $shop_id);
				}
			}
		}

		// Replace existing shop if necessary
		if (!$shop_id)
			$context->shop = new Shop(Configuration::get('PS_SHOP_DEFAULT'));
		else if ($context->shop->id != $shop_id)
			$context->shop = new Shop($shop_id);
	}
}
catch(MileBizException $e)
{
	$e->displayMessage();
}
