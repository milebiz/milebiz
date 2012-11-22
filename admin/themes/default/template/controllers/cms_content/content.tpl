{*
* ___COPY__RIGHT___
*}
{if isset($cms_breadcrumb)}
	<div class="cat_bar">
		<span style="color: #3C8534;">{l s='Current category'} :</span>&nbsp;&nbsp;&nbsp;{$cms_breadcrumb}
	</div>
{/if}

{$content}
