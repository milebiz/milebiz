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
	{if $input.name == 'id_feature'}
		{hook h="displayFeatureValueForm" id_feature_value=$feature_value->id}
	{/if}
{/block}
