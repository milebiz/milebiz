<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */
function cms_block()
{
	if (!Db::getInstance()->execute('SELECT `display_store` FROM `'._DB_PREFIX_.'cms_block` LIMIT 1'))
		return Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'cms_block` ADD `display_store` TINYINT NOT NULL DEFAULT \'1\'');
	return true;
}

