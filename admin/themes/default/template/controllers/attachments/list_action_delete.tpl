{*
* ___COPY__RIGHT___
*}
<script>
	function confirmProductAttached(productList)
	{
		var confirm_text = "{l s='This attachment is associated with the following products:'}";
		if (confirm('{$confirm}'))
			return confirm(confirm_text + product_list);
		return false;
	}
</script>

<a href="{$href}" onclick="{if isset($product_attachements[$id])}return confirmProductAttached('{$product_list[$id]}'){else}return confirm('{$confirm}'){/if}">
	<img src="../img/admin/delete.gif" alt="{$action}" title="{$action}" />
</a>

