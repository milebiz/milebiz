<?php
/*
* ___COPY__RIGHT___
*/

function drop_image_type_non_unique_index()
{
	$index = Db::getInstance()->getValue('SHOW index FROM `'._DB_PREFIX_.'image_type` where column_name = "name" and non_unique=1');
	Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'image_type` DROP INDEX "'.pSQL($index).'"');
}

