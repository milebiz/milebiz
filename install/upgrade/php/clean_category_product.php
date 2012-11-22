<?php
/*
* ___COPY__RIGHT___
*/

/* Remove duplicate entries from ps_category_product */
function clean_category_product()
{
	$list = Db::getInstance()->ExecuteS('
	SELECT id_category, id_product, COUNT(*) n
	FROM '._DB_PREFIX_.'category_product
	GROUP BY CONCAT(id_category,\'|\',id_product)
	HAVING n > 1');

	$result = true;
	if ($list)
		foreach ($list as $l)
			$result &= Db::getInstance()->Execute('DELETE FROM '._DB_PREFIX_.'category_product
			WHERE id_product = '.(int)$l['id_product'].' AND id_category = '.(int)$l['id_category'].' LIMIT '.(int)($l['n'] - 1));

	return $result;
}