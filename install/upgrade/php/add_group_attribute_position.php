<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function add_group_attribute_position()
{
	$groups = Db::getInstance()->executeS('
	SELECT *
	FROM `'._DB_PREFIX_.'attribute_group`');
	$i = 0;
	if (sizeof($groups) && is_array($groups))
		foreach ($groups as $group)
		{
			Db::getInstance()->execute('
				UPDATE `'._DB_PREFIX_.'attribute_group` 
				SET `position` = '.$i++.'
				WHERE `id_attribute_group` = '.(int)$group['id_attribute_group']);
		}
}