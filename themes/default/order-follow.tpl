{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Return Merchandise Authorization (RMA)'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h1>{l s='Return Merchandise Authorization (RMA)'}</h1>
{if isset($errorQuantity) && $errorQuantity}<p class="error">{l s='You do not have enough products to request another merchandise return.'}</p>{/if}
{if isset($errorMsg) && $errorMsg}
	<p class="error">
		{l s='Please provide an explanation for your RMA.'}
	</p>
	<p>
		<h2>{l s='Please specify an explanation for your RMA:'}</h2>
		<form method="POST"  id="returnOrderMessage"/>
			<p class="textarea">
				<textarea name="returnText"></textarea>
			</p>
			{foreach $ids_order_detail as $id_order_detail}
				<input type="hidden" name="ids_order_detail[{$id_order_detail}]" value="{$id_order_detail}"/>
			{/foreach}
			{foreach $order_qte_input as $key => $value}
				<input type="hidden" name="order_qte_input[{$key}]" value="{$value}"/>
			{/foreach}
			<input type="hidden" name="id_order" value="{$id_order}"/>
			<input class="button_large" type="submit" name="submitReturnMerchandise" value="{l s='Make an RMA slip'}"/>
		</form>
	</p>
{/if}
{if isset($errorDetail1) && $errorDetail1}<p class="error">{l s='Please check at least one product you would like to return.'}</p>{/if}
{if isset($errorDetail2) && $errorDetail2}<p class="error">{l s='Please provide a quantity for the product you checked.'}</p>{/if}
{if isset($errorNotReturnable) && $errorNotReturnable}<p class="error">{l s='This order cannot be returned.'}</p>{/if}

<p>{l s='Here are the merchandise returns you have made'}.</p>
<div class="block-center" id="block-history">
	{if $ordersReturn && count($ordersReturn)}
	<table id="order-list" class="std">
		<thead>
			<tr>
				<th class="first_item">{l s='Return'}</th>
				<th class="item">{l s='Order'}</th>
				<th class="item">{l s='Package status'}</th>
				<th class="item">{l s='Date issued'}</th>
				<th class="last_item">{l s='Return slip'}</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$ordersReturn item=return name=myLoop}
			<tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
				<td class="bold"><a class="color-myaccount" href="javascript:showOrder(0, {$return.id_order_return|intval}, '{$link->getPageLink('order-return')}');">{l s='#'}{$return.id_order_return|string_format:"%06d"}</a></td>
				<td class="history_method"><a class="color-myaccount" href="javascript:showOrder(1, {$return.id_order|intval}, '{$link->getPageLink('order-detail')}');">{l s='#'}{$return.id_order|string_format:"%06d"}</a></td>
				<td class="history_method"><span class="bold">{$return.state_name|escape:'htmlall':'UTF-8'}</span></td>
				<td class="bold">{dateFormat date=$return.date_add full=0}</td>
				<td class="history_invoice">
				{if $return.state == 2}
					<a href="{$link->getPageLink('pdf-order-return', true, NULL, "id_order_return={$return.id_order_return|intval}")}" title="{l s='Order return'} {l s='#'}{$return.id_order_return|string_format:"%06d"}"><img src="{$img_dir}icon/pdf.gif" alt="{l s='Order return'} {l s='#'}{$return.id_order_return|string_format:"%06d"}" class="icon" /></a>
					<a href="{$link->getPageLink('pdf-order-return', true, NULL, "id_order_return={$return.id_order_return|intval}")}" title="{l s='Order return'} {l s='#'}{$return.id_order_return|string_format:"%06d"}">{l s='Print out'}</a>
				{else}
					--
				{/if}
				</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
	<div id="block-order-detail" class="hidden">&nbsp;</div>
	{else}
		<p class="warning">{l s='You have no return merchandise authorizations.'}</p>
	{/if}
</div>

<ul class="footer_links">
	<li><a href="{$link->getPageLink('my-account', true)}"><img src="{$img_dir}icon/my-account.gif" alt="" class="icon" /></a><a href="{$link->getPageLink('my-account', true)}">{l s='Back to your account'}</a></li>
	<li class="f_right"><a href="{$base_dir}"><img src="{$img_dir}icon/home.gif" alt="" class="icon" /></a><a href="{$base_dir}">{l s='Home'}</a></li>
</ul>
