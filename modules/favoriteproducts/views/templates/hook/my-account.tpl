{*
* ___COPY__RIGHT___
*}

<li class="favoriteproducts">
	<a href="{$link->getModuleLink('favoriteproducts', 'account')|escape:'htmlall':'UTF-8'}" title="{l s='您感兴趣的产品' mod='favoriteproducts'}">
		{if !$in_footer}<img {if isset($mobile_hook)}src="{$module_template_dir}img/favorites.png" class="ui-li-icon ui-li-thumb"{else}src="{$module_template_dir}img/favorites.png" class="icon"{/if} alt="{l s='您感兴趣的产品' mod='favoriteproducts'}"/>{/if}
		{l s='您感兴趣的产品' mod='favoriteproducts'}
	</a>
</li>
