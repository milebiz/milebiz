{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<div>
	{if $module_name}
		{if $module_instance && $module_instance->active}
			{$hook}
		{else}
			{l s='Module not found'}
		{/if}
	{else}
		<h3 class="space">{l s='Please select a module in the left column.'}</h3>
	{/if}
</div>
</div>
</div>


