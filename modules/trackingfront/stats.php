<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/trackingfront.php');

$tf = new TrackingFront();
if (!$tf->active)
	Tools::redirect('index.php?controller=404');
$tf->postProcess();
echo $tf->isLogged() ? $tf->displayAccount() : $tf->displayLogin();

