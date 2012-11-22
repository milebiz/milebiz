<?php
/*
* ___COPY__RIGHT___
*/

function id_currency_country_fix()
{
	if (!Db::getInstance()->execute('SELECT `id_currency` FROM `'._DB_PREFIX_.'country` LIMIT 1'))
		return Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'country` ADD `id_currency` INT NOT NULL DEFAULT \'0\' AFTER `id_zone`');
	return true;
}
