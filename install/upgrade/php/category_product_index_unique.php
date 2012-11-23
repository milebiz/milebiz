<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function category_product_index_unique()
{
	$res = true;
	$key_exists = Db::getInstance()->executeS('SHOW INDEX
		FROM `'._DB_PREFIX_.'category_product`
		WHERE Key_name = "category_product_index"');
	if ($key_exists)
		$res &= Db::getInstance()->execute('ALTER TABLE 
		`'._DB_PREFIX_.'category_product` 
		DROP INDEX `category_product_index`');
	$res &= Db::getInstance()->execute('ALTER TABLE 
	`'._DB_PREFIX_.'category_product` 
	ADD UNIQUE `category_product_index` (`id_category`, `id_product`)');

	return $res;
}
