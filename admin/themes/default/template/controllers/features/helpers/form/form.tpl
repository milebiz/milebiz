{*
* ___COPY__RIGHT___
*}
{extends file="helpers/form/form.tpl"}

{block name="field"}
	{$smarty.block.parent}
	{if $input.name == 'name'}
		{hook h="displayFeatureForm" id_feature=$form_id}
	{/if}
{/block}
