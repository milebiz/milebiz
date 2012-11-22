{*
* ___COPY__RIGHT___
*}
{extends file="helpers/list/list_header.tpl"}
{block name=override_header}
<div class="filter-stock">
	<form id="stock_instant_state" type="get">
		<input type="hidden" name="controller" value="AdminStockInstantState" />
		<input type="hidden" name="token" value="{$token}" />
	{if count($stock_instant_state_warehouses) > 0}
		<div id="stock_instant_state_form_warehouse">
			<label for="id_warehouse">{l s='Filter by warehouse:'}</label>
			<select name="id_warehouse" onChange="$(this).parent().parent().submit();">
				{foreach from=$stock_instant_state_warehouses key=k item=i}
					<option {if $i.id_warehouse == $stock_instant_state_cur_warehouse} selected="selected"{/if} value="{$i.id_warehouse}">{$i.name}</option>
				{/foreach}
			</select>
		</div>
	{/if}
	</form>
</div>
{/block}