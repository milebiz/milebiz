{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<!-- Block permanent links module -->
<div id="permanent_links">
	<!-- Sitemap -->
	<div class="sitemap">
		<a href="{$link->getPageLink('sitemap')}"><img src="{$img_dir}icon/sitemap.gif" alt="{l s='sitemap' mod='blockpermanentlinks'}" title="{l s='sitemap' mod='blockpermanentlinks'}" /></a>&nbsp;
		<a href="{$link->getPageLink('sitemap')}">{l s='sitemap' mod='blockpermanentlinks'}</a>
	</div>
	<!-- Contact -->
	<div class="contact">
		<a href="{$link->getPageLink('contact', true)}"><img src="{$img_dir}icon/contact.gif" alt="{l s='contact' mod='blockpermanentlinks'}" title="{l s='contact' mod='blockpermanentlinks'}" /></a>&nbsp;
		<a href="{$link->getPageLink('contact', true)}">{l s='contact' mod='blockpermanentlinks'}</a>
	</div>
	<!-- Bookmark -->
	<div class="add_bookmark">
		<script type="text/javascript">
		writeBookmarkLink('{$come_from}', '{$shop_name|addslashes|addslashes}', '{l s='bookmark this page' mod='blockpermanentlinks'}', '{$img_dir}icon/star.gif');</script>&nbsp;
	</div>
</div>
<!-- /Block permanent links module -->
