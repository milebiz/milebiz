{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<script type="text/javascript">
$(function() {
	$('body').highlight('{$query}');
});
</script>

{if $show_toolbar}
	{include file="toolbar.tpl" toolbar_btn=$toolbar_btn toolbar_scroll=$toolbar_scroll title=$title}
	<div class="leadin">{block name="leadin"}{/block}</div>
{/if}

{if isset($features)}
	{if !$features}
		<h3>{l s='No features matching your query'} : {$query}</h3>
	{else}
		<h3>{l s='Features matching your query'} : {$query}</h3>
		<table class="table" cellpadding="0" cellspacing="0">
			{foreach $features key=key item=feature }
				{foreach $feature key=k item=val name=feature_list}
					<tr>
						<th>{if $smarty.foreach.feature_list.first}{$key}{/if}</th>
						<td>
							<a href="{$val.link}">{$val.value}</a>
						</td>
					</tr>
				{/foreach}
			{/foreach}
		</table>
		<div class="clear">&nbsp;</div>
	{/if}
{/if}
{if isset($categories)}
	{if !$categories}
		<h3>{l s='No categories matching your query'} : {$query}</h3>
	{else}
		<h3>{l s='Categories matching your query'} : {$query}</h3>
		<table cellspacing="0" cellpadding="0" class="table">
			{foreach $categories key=key item=category }
				<tr class="alt_row">
					<td>{$category}</td>
				</tr>
			{/foreach}
		</table>
		<div class="clear">&nbsp;</div>
	{/if}
{/if}
{if isset($products)}
	{if !$products}
		<h3>{l s='No products matching your query'} : {$query}</h3>
	{else}
		<h3>{l s='Products matching your query'} : {$query}</h3>
		{$products}
	{/if}
{/if}
{if isset($customers)}
	{if !$customers}
		<h3>{l s='There are no customers matching your query'} : {$query}</h3>
	{else}
		<h3>{l s='Customer matching your query'} : {$query}</h3>
		{$customers}
	{/if}
{/if}