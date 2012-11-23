{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{capture name=path}{l s='My account'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h1>{l s='My account'}</h1>
{if isset($account_created)}
	<p class="success">
		{l s='Your account has been created.'}
	</p>
{/if}
<h4>{l s='Welcome to your account. Here, you can manage your addresses and orders.'}</h4>
<ul class="myaccount_lnk_list">
	{if $has_customer_an_address}
	<li><a href="{$link->getPageLink('address', true)}" title="{l s='Add my first address'}"><img src="{$img_dir}icon/addrbook.gif" alt="{l s='Add my first address'}" class="icon" /> {l s='Add my first address'}</a></li>
	{/if}
	<li><a href="{$link->getPageLink('history', true)}" title="{l s='Orders'}"><img src="{$img_dir}icon/order.gif" alt="{l s='Orders'}" class="icon" /> {l s='History and details of my orders'}</a></li>
	{if $returnAllowed}
		<li><a href="{$link->getPageLink('order-follow', true)}" title="{l s='Merchandise returns'}"><img src="{$img_dir}icon/return.gif" alt="{l s='Merchandise returns'}" class="icon" /> {l s='My merchandise returns'}</a></li>
	{/if}
	<li><a href="{$link->getPageLink('order-slip', true)}" title="{l s='Credit slips'}"><img src="{$img_dir}icon/slip.gif" alt="{l s='Credit slips'}" class="icon" /> {l s='My credit slips'}</a></li>
	<li><a href="{$link->getPageLink('addresses', true)}" title="{l s='Addresses'}"><img src="{$img_dir}icon/addrbook.gif" alt="{l s='Addresses'}" class="icon" /> {l s='My addresses'}</a></li>
	<li><a href="{$link->getPageLink('identity', true)}" title="{l s='Information'}"><img src="{$img_dir}icon/userinfo.gif" alt="{l s='Information'}" class="icon" /> {l s='My personal information'}</a></li>
	{if $voucherAllowed}
		<li><a href="{$link->getPageLink('discount', true)}" title="{l s='Vouchers'}"><img src="{$img_dir}icon/voucher.gif" alt="{l s='Vouchers'}" class="icon" /> {l s='My vouchers'}</a></li>
	{/if}
	{$HOOK_CUSTOMER_ACCOUNT}
</ul>
<p><a href="{$base_dir}" title="{l s='Home'}"><img src="{$img_dir}icon/home.gif" alt="{l s='Home'}" class="icon" /></a><a href="{$base_dir}" title="{l s='Home'}">{l s='Home'}</a></p>
