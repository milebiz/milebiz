<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function shop_url()
{
	$host = Db::getInstance()->getValue('SELECT value FROM `'._DB_PREFIX_.'configuration`
		WHERE name="CANONICAL_URL"');
	if (!$host)
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
	$res = Db::getInstance()->getValue('REPLACE INTO `'._DB_PREFIX_.'configuration`
		(name, value) VALUES 
		("PS_SHOP_DOMAIN", "'.$host.'"),
		("PS_SHOP_DOMAIN_SSL", "'.$host.'")
		');
	return true;
}