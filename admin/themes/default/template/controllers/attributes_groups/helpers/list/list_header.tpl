{*
* ___COPY__RIGHT___
*}

{extends file="helpers/list/list_header.tpl"}
{block name=leadin}
	<script type="text/javascript">
		$(document).ready(function() {
			$(location.hash).click();
		});
	</script>
{/block}