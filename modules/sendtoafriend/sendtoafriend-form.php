<?php
/**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
require_once(dirname(__FILE__).'/sendtoafriend.php');

$sendtoafriend = new sendToAFriend($dontTranslate = true);
echo $sendtoafriend->displayPageForm();

