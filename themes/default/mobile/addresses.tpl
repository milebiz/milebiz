{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{capture assign='page_title'}{l s='My addresses'}{/capture}
{include file='./page-title.tpl'}

<div data-role="content" id="content">
	<a data-role="button" data-icon="arrow-l" data-theme="a" data-mini="true" data-inline="true" href="{$link->getPageLink('my-account', true)}" data-ajax="false">{l s='My account'}</a>
	<p>{l s='Please configure your default billing and delivery addresses when placing an order. You may also add additional addresses, which can be useful for sending gifts or receiving an order at your office.'}</p>
	<div>
		{if isset($multipleAddresses) && $multipleAddresses}
		<h3>{l s='Your addresses are listed below.'}</h3>
		<p>{l s='Be sure to update them if they have changed.'}</p>
		{assign var="adrs_style" value=$addresses_style}
		<form action="opc.html" method="post">
			<ul data-role="listview" data-theme="g">
				{foreach from=$multipleAddresses item=address name=myLoop}
				<li>
					<a href="{$link->getPageLink('address', true, null, "id_address={$address.object.id|intval}")}" title="{l s='Update'}" data-ajax="false">
						<h4>{$address.object.alias}</h4>
						{foreach from=$address.ordered name=adr_loop item=pattern}
							{assign var=addressKey value=" "|explode:$pattern}
							{foreach from=$addressKey item=key name="word_loop"}
								{$address.formated[$key|replace:',':'']|escape:'htmlall':'UTF-8'}
							{/foreach}
							<br />
						{/foreach}
					</a>
				</li>
				{/foreach}
			</ul>
		</form>
		{else}
		<p class="warning">{l s='No addresses available.'}</p>
	{/if}
		<a href="{$link->getPageLink('address', true)}" data-role="button" data-theme="a" data-ajax="false">{l s='Add new address'}</a>
	</div>
	
	{include file='./sitemap.tpl'}
</div><!-- /content -->
