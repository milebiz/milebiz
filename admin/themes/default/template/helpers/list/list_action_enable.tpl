{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<a href="{$url_enable}" {if isset($confirm)}onclick="return confirm('{$confirm}');"{/if} title="{if $enabled}{l s='Enabled'}{else}{l s='Disabled'}{/if}">
	<img src="../img/admin/{if $enabled}enabled.gif{else}disabled.gif{/if}" alt="{if $enabled}{l s='Enabled'}{else}{l s='Disabled'}{/if}" />
</a>
