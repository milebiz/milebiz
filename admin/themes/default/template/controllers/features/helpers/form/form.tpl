{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}
{extends file="helpers/form/form.tpl"}

{block name="field"}
	{$smarty.block.parent}
	{if $input.name == 'name'}
		{hook h="displayFeatureForm" id_feature=$form_id}
	{/if}
{/block}
