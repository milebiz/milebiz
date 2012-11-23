{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<!-- Block links module -->
<div id="links_block_left" class="block">
	<h4>
	{if $url}
		<a href="{$url|escape}">{$title|escape}</a>
	{else}
		{$title|escape}
	{/if}
	</h4>
	<ul class="block_content bullet">
	{foreach from=$blocklink_links item=blocklink_link}
		{if isset($blocklink_link.$lang)} 
			<li><a href="{$blocklink_link.url|escape}"{if $blocklink_link.newWindow} onclick="window.open(this.href);return false;"{/if}>{$blocklink_link.$lang|escape}</a></li>
		{/if}
	{/foreach}
	</ul>
</div>
<!-- /Block links module -->
