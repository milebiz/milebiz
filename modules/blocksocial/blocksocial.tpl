{*
* ___COPY__RIGHT___
*}

<div id="social_block">
	<h4>{l s='Follow us' mod='blocksocial'}</h4>
	<ul>
		{if $weibo_url != ''}<li class="facebook"><a href="{$weibo_url|escape:html:'UTF-8'}">{l s='我的微博' mod='blocksocial'}</a></li>{/if}
		{if $boke_url != ''}<li class="twitter"><a href="{$boke_url|escape:html:'UTF-8'}">{l s='我的博客' mod='blocksocial'}</a></li>{/if}
		{if $rss_url != ''}<li class="rss"><a href="{$rss_url|escape:html:'UTF-8'}">{l s='RSS' mod='blocksocial'}</a></li>{/if}
	</ul>
</div>
