<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function update_module_blocklayered()
{
	if (Db::getInstance()->getValue('SELECT id_module FROM `'._DB_PREFIX_.'module` WHERE name = \'blocklayered\''))
		@Db::getInstance()->Execute('ALTER TABLE `'._DB_PREFIX_.'layered_price_index` ADD INDEX id_product (`id_product`)');

	return true;
}