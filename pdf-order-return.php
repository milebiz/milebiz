<?php
/**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

/**
 * This file will be removed in 1.6
 * You have to use index.php?controller=page_name instead of this page
 *
 * @deprecated 1.5.0
 */

include(dirname(__FILE__).'/config/config.inc.php');
Tools::displayFileAsDeprecated();

Tools::redirect('index.php?controller=pdf-order-return'.($_REQUEST ? '&'.http_build_query($_REQUEST, '', '&') : ''), __PS_BASE_URI__, null, 'HTTP/1.1 301 Moved Permanently');