{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}
{assign var='header_file' value='./header.tpl'}
{assign var='footer_file' value='./footer.tpl'}

{if !empty($display_header)}
	{include file=$header_file}
{/if}
{if !empty($template)}
	{$template}
{/if}
{if !empty($display_footer)}
	{include file=$footer_file}
{/if}
{if !empty($live_edit)}
	{$live_edit}
{/if}
