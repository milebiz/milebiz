<?php
/*
* ___COPY__RIGHT___
*/

function update_module_product_comments()
{
	if (Db::getInstance()->getValue('SELECT `id_module` FROM `'._DB_PREFIX_.'module` WHERE `name`="productcomments"'))
	{
		Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_comment_usefulness` (
			  `id_product_comment` int(10) unsigned NOT NULL,
			  `id_customer` int(10) unsigned NOT NULL,
			  `usefulness` tinyint(1) unsigned NOT NULL,
			  PRIMARY KEY (`id_product_comment`, `id_customer`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8');

		Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_comment_report` (
			  `id_product_comment` int(10) unsigned NOT NULL,
			  `id_customer` int(10) unsigned NOT NULL,
			  PRIMARY KEY (`id_product_comment`, `id_customer`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8');
	}
}

