<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

require_once 'init.php';

try
{
	require_once _PS_INSTALL_PATH_.'classes/controllerHttp.php';
	InstallControllerHttp::execute();
}
catch (MileBizInstallerException $e)
{
	$e->displayMessage();
}
