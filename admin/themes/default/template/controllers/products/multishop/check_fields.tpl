{*
* ___COPY__RIGHT___
*}

{if isset($display_multishop_checkboxes) && $display_multishop_checkboxes}
	<label style="float: none">
		<input type="checkbox" style="vertical-align: text-bottom" onclick="$('#product-tab-content-{$product_tab} input[name^=\'multishop_check[\']').attr('checked', this.checked); ProductMultishop.checkAll{$product_tab}()" />
		{l s='Check/uncheck all (you are editing this page for several shops, some fields like "name" or "price" are disabled, you have to check these fields in order to edit them for these shops)'}
	</label>
{/if}