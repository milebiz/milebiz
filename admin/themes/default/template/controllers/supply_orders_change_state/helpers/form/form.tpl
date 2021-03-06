{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}
{extends file="helpers/form/form.tpl"}

{block name="other_input"}

{if isset($supply_order) && $supply_order->id > 0 && isset($supply_order_states)}
<script>
$(document).ready(function() {
	$('#id_supply_order_state option').each(function () {
		
		if ($(this).attr('disabled') == false)
			$(this).attr('selected', true);
		
		return ($(this).attr('disabled') == true);
		
	});
});
</script>
<input type="hidden" name="id_supply_order" id="id_supply_order" value="{$supply_order->id}">
<label>{l s='Status of the order:'}</label>						

<div class="margin-form">
	<select name="id_supply_order_state" id="id_supply_order_state">
	{foreach $supply_order_states as $state}
		<option value="{$state['id_supply_order_state']}" {if $state['allowed'] == 0} disabled="disabled" {/if}>{$state['name']}</option>
	{/foreach}
	</select>
	<p class="preference_description">
		{l s='Choose the new status for your order'}
	</p>
</div>

<div class="margin-form">
<input type="submit" id="_form_submit_btn" value="{l s='Save'}" name="submitChangestate" class="button" style="display: none;">
</div>
{/if}
{/block}

{block name="other_fieldsets"}							
<br />
{if isset($supply_order_state) && $supply_order_state->editable == false && isset($supply_order)}
<fieldset>
<legend>
	<img src="../img/admin/pdf.gif" alt="{l s='Supply Order State'}">
	{l s='Print the supply order form'}
</legend>
<a href="{$link->getAdminLink('AdminPdf')|escape:'htmlall':'UTF-8'}&submitAction=generateSupplyOrderFormPDF&id_supply_order={$supply_order->id}" target="_blank" title="Export as PDF">{l s='Click here to download the supply order form'}.</a>
</fieldset>
{/if}

{/block}
