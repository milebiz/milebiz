{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{include file="$tpl_dir./breadcrumb.tpl"}

{include file="$tpl_dir./errors.tpl"}

{if !isset($errors) OR !sizeof($errors)}
	<h1>{l s='List of products by supplier:'}&nbsp;{$supplier->name|escape:'htmlall':'UTF-8'}</h1>
	{if !empty($supplier->description)}
		<div class="description_box">
			<p>{$supplier->description}</p>
		</div>
	{/if}

	{if $products}
		<div class="sortPagiBar clearfix">
			{include file="$tpl_dir./product-sort.tpl"}
		</div>
		{include file="./product-compare.tpl"}
		{include file="$tpl_dir./product-list.tpl" products=$products}
		{include file="$tpl_dir./pagination.tpl"}
		{include file="./product-compare.tpl"}
	{else}
		<p class="warning">{l s='No products for this supplier.'}</p>
	{/if}
{/if}
