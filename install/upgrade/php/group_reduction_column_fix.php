<?php
/**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function group_reduction_column_fix()
{
	if (!Db::getInstance()->execute('SELECT `group_reduction` FROM `'._DB_PREFIX_.'order_detail` LIMIT 1'))
		return Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'order_detail` ADD `group_reduction` DECIMAL(10, 2) NOT NULL AFTER `reduction_amount`');
	return true;
}
