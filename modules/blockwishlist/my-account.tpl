{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<!-- MODULE WishList -->
<li class="lnk_wishlist">
	<a href="{$wishlist_link}" title="{l s='My wishlists' mod='blockwishlist'}">
		<img {if isset($mobile_hook)} src="{$module_template_dir}img/gift.png" class="ui-li-icon ui-li-thumb" {else} src="{$module_template_dir}img/gift.gif" class="icon"{/if}  alt="{l s='wishlist' mod='blockwishlist'}" /> {l s='My wishlists' mod='blockwishlist'}
	</a>
</li>
<!-- END : MODULE WishList -->