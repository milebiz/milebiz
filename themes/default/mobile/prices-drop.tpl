{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{capture assign='page_title'}{l s='Price drop'}{/capture}
{include file='./page-title.tpl'}

{if $products}
	<div data-role="content" id="content">
		<div class="clearfix">
			{include file="./category-product-sort.tpl" container_class="container-sort"}
		</div>
		<hr width="99%" align="center" size="2"/>
		{include file="./pagination.tpl"}
		{include file="./category-product-list.tpl" products=$products}
		{include file="./pagination.tpl"}
		
		{include file='./sitemap.tpl'}
	</div><!-- #content -->
{else}
	<p class="warning">{l s='No price drop.'}</p>
{/if}