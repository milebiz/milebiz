<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

/**
 * This file will be removed in 1.6
 */

if (isset(Context::getContext()->controller))
	$controller = Context::getContext()->controller;
else
{
	$controller = new FrontController();
	$controller->init();
}