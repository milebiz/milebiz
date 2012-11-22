{*
* ___COPY__RIGHT___
*}
{if $infos|@count > 0}
<!-- MODULE Block reinsurance -->
<div id="reinsurance_block" class="clearfix">
	<ul class="width{$nbblocks}">	
		{foreach from=$infos item=info}
			<li><img src="{$module_dir}img/{$info.file_name}" alt="{$info.text|escape:html:'UTF-8'}" /> <span>{$info.text|escape:html:'UTF-8'}</span></li>
		{/foreach}
	</ul>
</div>
<!-- /MODULE Block reinsurance -->
{/if}