<?php
/*
* ___COPY__RIGHT___
*/

function module_blockwishlist_multishop()
{
	$id_module = Db::getInstance()->getValue('SELECT id_module FROM '._DB_PREFIX_.'module where name="blockwishlist"');
	if ($id_module)
	{
		$res = Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'wishlist`
		ADD `id_shop` INTEGER NOT NULL default \'1\' AFTER `counter`,
		ADD `id_group_shop` INTEGER NOT NULL default \'1\' AFTER `id_shop`');
		
		return $res;
	}
	return true;
}


