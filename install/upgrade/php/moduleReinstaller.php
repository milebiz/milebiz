<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function moduleReinstaller($moduleName, $force = false)
{
	$module = Module::getInstanceByName($moduleName);
	if (!is_object($module))
		die(Tools::displayError());
	if ($module->uninstall() OR $force)
		return $module->install();
	return false;
}

