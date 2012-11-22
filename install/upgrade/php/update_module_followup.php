<?php
/*
* ___COPY__RIGHT___
*/

function update_module_followup()
{
	$id_followup = Db::getInstance()->getValue('SELECT id_module FROM  `'._DB_PREFIX_.'module` WHERE name = "followup"');
	if (!$id_followup)
		return;

	Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'log_email` ADD INDEX `date_add`(`date_add`), ADD INDEX `id_cart`(`id_cart`);');
}

