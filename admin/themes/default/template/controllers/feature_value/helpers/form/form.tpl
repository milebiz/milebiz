{*
* ___COPY__RIGHT___
*}
{extends file="helpers/form/form.tpl"}

{block name="field"}
	{$smarty.block.parent}
	{if $input.name == 'id_feature'}
		{hook h="displayFeatureValueForm" id_feature_value=$feature_value->id}
	{/if}
{/block}
