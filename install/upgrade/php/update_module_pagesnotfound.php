<?php
/*
* ___COPY__RIGHT___
*/

function update_module_pagesnotfound()
{
	$id_pagesnotfound = (int)Db::getInstance()->getValue('SELECT id_module FROM  `'._DB_PREFIX_.'module` WHERE name = \'pagesnotfound\'');
	if ($id_pagesnotfound)
	{
		$id_hook = (int)Db::getInstance()->getValue('SELECT `id_hook` FROM `'._DB_PREFIX_.'hook` WHERE `name` = \'frontCanonicalRedirect\'');
		if ($id_hook)
		{
			$position = (int)Db::getInstance()->getValue('SELECT IFNULL(MAX(`position`), 0) + 1 FROM `'._DB_PREFIX_.'hook_module` WHERE `id_hook` = '.(int)$id_hook);
			if ($position)
				return Db::getInstance()->Execute('INSERT IGNORE INTO `'._DB_PREFIX_.'hook_module` (`id_hook`, `id_module`, `position`) VALUES ('.(int)$id_hook.', '.(int)$id_pagesnotfound.', '.(int)$position.')');
		}
	}
	return true;
}