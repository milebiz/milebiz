{*
* ___COPY__RIGHT___
*}
<a href="{$href}" class="delete" {if isset($confirm)}onclick="if (confirm('{$confirm}')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"{/if} title="{$action}">
	<img src="../img/admin/delete.gif" alt="{$action}" />
</a>