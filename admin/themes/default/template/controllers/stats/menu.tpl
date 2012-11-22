{*
* ___COPY__RIGHT___
*}
<div id="container">
	<div class="sidebar navigation">
	<h3>{l s='Navigation'}</h3>
		<ul class="categorieList">
		{if count($modules)}
			{foreach $modules as $module}
				{if $module_instance[$module.name]}
					<li>
						<a href="{$current}&token={$token}&module={$module.name}">{$module_instance[$module.name]->displayName}</a>
					</li>
				{/if}
			{/foreach}
		{else}
			{l s='No module installed'}
		{/if}
		</ul>



