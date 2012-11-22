<?php
/*
* ___COPY__RIGHT___
*/

function alter_productcomments_guest_index()
{
	$id_productcomments = Db::getInstance()->getValue('SELECT id_module 
		FROM  `'._DB_PREFIX_.'module` WHERE name = "productcomments"');

	if (!$id_productcomments)
		return;
	
	DB::getInstance()->execute('
	ALTER TABLE `'._DB_PREFIX_.'product_comment`
	DROP INDEX `id_guest`, ADD INDEX `id_guest` (`id_guest`);');
}

