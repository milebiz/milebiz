{*
* ___COPY__RIGHT___
*}
<script type="text/javascript">
	var favorite_products_url_add = '{$link->getModuleLink('favoriteproducts', 'actions', ['process' => 'add'], true)}';
	var favorite_products_url_remove = '{$link->getModuleLink('favoriteproducts', 'actions', ['process' => 'remove'], true)}';
{if isset($smarty.get.id_product)}
	var favorite_products_id_product = '{$smarty.get.id_product|intval}';
{/if} 
</script>
