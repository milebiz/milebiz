{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}
{if isset($orderby) AND isset($orderway)}
	{if !isset($sort_already_display)} 
		{assign var='sort_already_display' value='true' scope="global"}
		<!-- Sort products -->
		{if isset($smarty.get.id_category) && $smarty.get.id_category}
			{assign var='request' value=$link->getPaginationLink('category', $category, false, true)}
		{elseif isset($smarty.get.id_manufacturer) && $smarty.get.id_manufacturer}
			{assign var='request' value=$link->getPaginationLink('manufacturer', $manufacturer, false, true)}
		{elseif isset($smarty.get.id_supplier) && $smarty.get.id_supplier}
			{assign var='request' value=$link->getPaginationLink('supplier', $supplier, false, true)}
		{else}
			{assign var='request' value=$link->getPaginationLink(false, false, false, true)}
		{/if}
		
		<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function()
		{
			$('.selectPrductSort').change(function()
			{
				var requestSortProducts = '{$request}';
				var splitData = $(this).val().split(':');
					document.location.href = requestSortProducts + ((requestSortProducts.indexOf('?') < 0) ? '?' : '&') + 'orderby=' + splitData[0] + '&orderway=' + splitData[1];
			});
		});
		//]]>
		</script>
	{/if}

	<div class="{$container_class}">
		<form id="productsSortForm" action="{$request|escape:'htmlall':'UTF-8'}">
			<select class="selectPrductSort">
				<option value="{$orderbydefault|escape:'htmlall':'UTF-8'}:{$orderwaydefault|escape:'htmlall':'UTF-8'}" {if $orderby eq $orderbydefault}selected="selected"{/if}>{l s='Sort by'}</option>
				{if !$PS_CATALOG_MODE}
					<option value="price:asc" {if $orderby eq 'price' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Price: lowest first'}</option>
					<option value="price:desc" {if $orderby eq 'price' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Price: highest first'}</option>
				{/if}
				<option value="name:asc" {if $orderby eq 'name' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Product Name: A to Z'}</option>
				<option value="name:desc" {if $orderby eq 'name' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Product Name: Z to A'}</option>
				{if !$PS_CATALOG_MODE}
					<option value="quantity:desc" {if $orderby eq 'quantity' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='In-stock first'}</option>
				{/if}
			</select>
		</form>
	</div> <!-- .{$container_class} -->
<!-- /Sort products -->
{/if}
