{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{extends file="helpers/options/options.tpl"}
{block name="input"}
	{if $field['type'] == 'maintenance_ip'}
		{$field['script_ip']}
		<input type="text"{if isset($field['id'])} id="{$field['id']}"{/if} size="{if isset($field['size'])}{$field['size']|intval}{else} 5{/if}" name="{$key}" value="{$field['value']|escape:'htmlall':'UTF-8'}" />
		{$field['link_remove_ip']}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}