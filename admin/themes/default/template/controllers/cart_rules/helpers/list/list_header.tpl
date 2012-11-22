{*
* ___COPY__RIGHT___
*}
{extends file="helpers/list/list_header.tpl"}
{block name='override_header'}
{if $submit_form_ajax}
	<script type="text/javascript">
		$('#voucher', window.parent.document).val('{$new_cart_rule->code|escape:htmlall}');
		parent.add_cart_rule({$new_cart_rule->id|intval});
		parent.$.fancybox.close();
	</script>
{/if}
{/block}
