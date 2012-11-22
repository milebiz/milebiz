{*
* ___COPY__RIGHT___
*}

{extends file="helpers/form/form.tpl"}

{block name="input"}
	{if $input.type == 'select_category'}
		<select name="id_parent">
			{$input.options.html}
		</select>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}

