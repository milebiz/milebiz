{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{extends file="helpers/list/list_content.tpl"}

{block name="td_content"}
	{if $key == 'url'}
		<a href="{$tr.$key}" onmouseover="$(this).css('text-decoration', 'underline')" onmouseout="$(this).css('text-decoration', 'none')" target="_blank">{$tr.$key}</a>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}