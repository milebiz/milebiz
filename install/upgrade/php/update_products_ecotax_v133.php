<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function update_products_ecotax_v133()
{
	global $oldversion;
	if ($oldversion < '1.3.3.0')
	{
		Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'product` SET `ecotax` = \'0\' WHERE 1');
		Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'order_detail` SET `ecotax` = \'0\' WHERE 1;');
	}
}
