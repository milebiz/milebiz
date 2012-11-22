<?php
/*
* ___COPY__RIGHT___
*/

function p15017_add_id_shop_to_primary_key()
{
	// Drop old indexes
	$old_indexes = array(
		'category_lang_index' => 'category_lang',
		'shipper_lang_index' => 'carrier_lang',
		'product_lang_index' => 'product_lang',
		'id_category_shop' => 'category_shop'
	);
	foreach ($old_indexes as $index => $table)
		if (Db::getInstance()->executeS('SHOW INDEX FROM `'._DB_PREFIX_.$table.'` WHERE Key_name = "'.$index.'"'))
			Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.$table.'` DROP KEY `'.$index.'`');

	// The former primary keys where set on id_object and id_lang. They must now be set on id_shop too.
	foreach (array('product', 'category', 'meta', 'carrier') as $table)
	{
		if (Db::getInstance()->executeS('SHOW INDEX FROM `'._DB_PREFIX_.$table.'` WHERE Key_name = "PRIMARY"'))
			Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.$table.'_lang` DROP PRIMARY KEY');
		Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.$table.'_lang` ADD PRIMARY KEY (`id_'.$table.'`, `id_shop`, `id_lang`)');
	}
	
	return true;
}
