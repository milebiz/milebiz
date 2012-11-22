{*
* ___COPY__RIGHT___
*}

{extends file="helpers/form/form.tpl"}

{block name="field"}
	{$smarty.block.parent}
	{if $input.name == 'public_name'}
		{hook h="displayAttributeGroupForm" id_attribute_group=$form_id}
	{/if}
{/block}
