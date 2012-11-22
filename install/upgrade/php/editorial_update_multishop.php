<?php
/*
* ___COPY__RIGHT___
*/

function editorial_update_multishop()
{
	$res = true;
	if (Db::getInstance()->getValue('SELECT `id_module` FROM `'._DB_PREFIX_.'module` WHERE `name`="editorial"'))
	{
		$res = Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'editorial` ADD `id_shop` INT(10) UNSIGNED NOT NULL AFTER `id_editorial`');
		$res &= Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'editorial` SET `id_shop` = 1');
	}
	return $res;
}