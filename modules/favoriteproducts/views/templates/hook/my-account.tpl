{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<li class="favoriteproducts">
	<a href="{$link->getModuleLink('favoriteproducts', 'account')|escape:'htmlall':'UTF-8'}" title="{l s='鎮ㄦ劅鍏磋叮鐨勪骇鍝�' mod='favoriteproducts'}">
		{if !$in_footer}<img {if isset($mobile_hook)}src="{$module_template_dir}img/favorites.png" class="ui-li-icon ui-li-thumb"{else}src="{$module_template_dir}img/favorites.png" class="icon"{/if} alt="{l s='鎮ㄦ劅鍏磋叮鐨勪骇鍝�' mod='favoriteproducts'}"/>{/if}
		{l s='鎮ㄦ劅鍏磋叮鐨勪骇鍝�' mod='favoriteproducts'}
	</a>
</li>
