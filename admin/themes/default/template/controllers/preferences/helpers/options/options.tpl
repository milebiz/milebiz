{*
* ___COPY__RIGHT___
*}

{extends file="helpers/options/options.tpl"}
{block name="input"}
	{if $field['type'] == 'disabled'}
		{$field['disabled']}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}
