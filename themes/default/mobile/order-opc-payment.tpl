{*
* ___COPY__RIGHT___
*}

{capture assign='page_title'}{l s='Payment'}{/capture}
{include file='./page-title.tpl'}

<div data-role="content">
	<fieldset data-role="controlgroup">
		{$HOOK_PAYMENT}
	</fieldset>
</div>
