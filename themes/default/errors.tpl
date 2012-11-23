{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{if isset($errors) && $errors}
	<div class="error">
		<p>{if $errors|@count > 1}{l s='There are %d errors' sprintf=$errors|@count}{else}{l s='There is %d error' sprintf=$errors|@count}{/if}</p>
		<ol>
		{foreach from=$errors key=k item=error}
			<li>{$error}</li>
		{/foreach}
		</ol>
		{if isset($smarty.server.HTTP_REFERER) && !strstr($request_uri, 'authentication') && preg_replace('#^https?://[^/]+/#', '/', $smarty.server.HTTP_REFERER) != $request_uri}
			<p class="lnk"><a href="{$smarty.server.HTTP_REFERER|escape:'htmlall':'UTF-8'|secureReferrer}" title="{l s='Back'}">&laquo; {l s='Back'}</a></p>
		{/if}
	</div>
{/if}