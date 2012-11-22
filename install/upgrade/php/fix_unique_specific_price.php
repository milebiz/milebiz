<?php

/*
* ___COPY__RIGHT___
*/

function fix_unique_specific_price()
{
	$result = Db::getInstance()->executeS('
	SELECT MIN(id_specific_price) id_specific_price
	FROM '._DB_PREFIX_.'specific_price
	GROUP BY `id_product`, `id_shop`, `id_currency`, `id_country`, `id_group`, `from_quantity`, `from`, `to`');
	if (!$result || !count($result))
		return true; // return tru if there is not any specific price in the database
		
	$sql = '';
	foreach ($result as $row)
		$sql .= (int)$row['id_specific_price'].',';
	$sql = rtrim($sql, ',');

	return Db::getInstance()->execute('
	DELETE FROM '._DB_PREFIX_.'specific_price 
	WHERE id_specific_price NOT IN ('.$sql.')');
}