{*
* ___COPY__RIGHT___
*}
{extends file="helpers/list/list_header.tpl"}
{block name='override_header'}
{if $submit_form_ajax}
	<script type="text/javascript">
		parent.getSummary();
		parent.$.fancybox.close();
	</script>
{/if}
{/block}
