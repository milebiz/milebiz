{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{* Generate HTML code for printing Invoice Icon with link *}
<span style="width:20px; margin-right:5px;">
	<a href="{$link->getAdminLink('AdminPdf')|escape:'htmlall':'UTF-8'}&submitAction=generateInvoicePDF&id_order_invoice={$id_invoice}"><img src="../img/admin/tab-invoice.gif" alt="invoice" /></a>
</span>