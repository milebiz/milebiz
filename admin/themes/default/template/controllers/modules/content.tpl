{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}


{if isset($module_content)}
	{$module_content}
{else}
	{if !isset($smarty.get.configure)}
		{include file='controllers/modules/js.tpl'}
		{if isset($smarty.get.select) && $smarty.get.select eq 'favorites'}
			{include file='controllers/modules/favorites.tpl'}
		{else}
			{include file='controllers/modules/page.tpl'}
		{/if}
	{/if}
{/if}
