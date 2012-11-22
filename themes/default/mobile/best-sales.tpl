{*
* ___COPY__RIGHT___
*}

{include file="$tpl_dir./errors.tpl"}

{if !isset($errors) OR !sizeof($errors)}
	{capture assign='page_title'}{l s='Top sellers'}{/capture}
	{include file='./page-title.tpl'}

	<div data-role="content" id="content">
	{if !empty($manufacturer->description) || !empty($manufacturer->short_description)}
		<div class="category_desc clearfix">
			{if !empty($manufacturer->short_description)}
				<p>{$manufacturer->short_description}</p>
				<p class="hide_desc">{$manufacturer->description}</p>
				<a href="#" data-theme="a" data-role="button" data-mini="true" data-inline="true" data-icon="arrow-d" class="lnk_more" onclick="$(this).prev().slideDown('slow'); $(this).hide(); return false;" data-ajax="false">{l s='More'}</a>
			{else}
				<p>{$manufacturer->description}</p>
			{/if}
		</div><!-- .category_desc -->
	{/if}
	
	{if $products}
			<div class="clearfix">
				{include file="./category-product-sort.tpl" container_class="container-sort"}
			</div>
			<hr width="99%" align="center" size="2"/>
			{include file="./pagination.tpl"}
			{include file="./category-product-list.tpl" products=$products}
			{include file="./pagination.tpl"}
			
	{else}
		<p class="warning">{l s='No top sellers.'}</p>
	{/if}
		{include file='./sitemap.tpl'}
	</div><!-- #content -->
{/if}
