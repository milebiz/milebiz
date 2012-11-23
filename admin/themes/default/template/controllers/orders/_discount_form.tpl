{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

	<label>{l s='Name'}</label>
	<div class="margin-form">
		<input type="text" name="discount_name" value="" />
	</div>

	<label>{l s='Type'}</label>
	<div class="margin-form">
		<select name="discount_type" id="discount_type">
			<option value="1">{l s='Percent'}</option>
			<option value="2">{l s='Amount'}</option>
			<option value="3">{l s='Free shipping'}</option>
		</select>
	</div>

	<div id="discount_value_field">
		<label>{l s='Value'}</label>
		<div class="margin-form">
			{if ($currency->format % 2)}
				<span id="discount_currency_sign" style="display: none;">{$currency->sign}</span>
			{/if}
			<input type="text" name="discount_value" size="3" />
			{if !($currency->format % 2)}
				<span id="discount_currency_sign" style="display: none;">{$currency->sign}</span>
			{/if}
			<span id="discount_percent_symbol">%</span>
			<p class="preference_description" id="discount_value_help" style="width: 95%;display: none;">
				{l s='This value must be taxes included.'}
			</p>
		</div>
	</div>

	{if $order->hasInvoice()}
	<label>{l s='Invoice'}</label>
	<div class="margin-form">
		<select name="discount_invoice">
			{foreach from=$invoices_collection item=invoice}
				<option value="{$invoice->id}" selected="selected">{$invoice->getInvoiceNumberFormatted($current_id_lang)} - {displayPrice price=$invoice->total_paid_tax_incl currency=$order->id_currency}</option>
			{/foreach}
		</select><br />
		<input type="checkbox" name="discount_all_invoices" id="discount_all_invoices" value="1" /> <label class="t" for="discount_all_invoices">{l s='Apply on all invoices'}</label>
		<p class="preference_description" style="width: 95%">
			{l s='If you select to create this discount for all invoices, one discount will be created per order invoice.'}
		</p>
	</div>
	{/if}

	<p class="center">
		<input class="button" type="submit" name="submitNewVoucher" value="{l s='Add'}" />&nbsp;
		<a href="#" id="cancel_add_voucher">{l s='Cancel'}</a>
	</p>

