<?php
/*
* ___COPY__RIGHT___
*/

function update_order_details()
{
	$res = Db::getInstance()->executeS('SHOW COLUMNS FROM `'._DB_PREFIX_.'order_detail` LIKE \'reduction_percent\'');

	if (sizeof($res) == 0)
	{
		  Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'order_detail` ADD `reduction_percent` DECIMAL(10, 2) NOT NULL default \'0.00\' AFTER `product_price`');
		  Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'order_detail` ADD `reduction_amount` DECIMAL(20, 6) NOT NULL default \'0.000000\' AFTER `reduction_percent`');
	}
}


