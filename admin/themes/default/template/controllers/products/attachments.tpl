{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

{if isset($obj->id)}
	<input type="hidden" name="submitted_tabs[]" value="Attachments" />
	<h4>{l s='Attachment'}</h4>
	<div class="separation"></div>
	<fieldset style="border:none;">
		<label>{l s='Filename:'} </label>
		<div class="margin-form translatable">
			{foreach $languages as $language}
				<div class="lang_{$language.id_lang}" style="{if $language.id_lang != $default_form_language}display:none;{/if}float: left;">
					<input type="text" name="attachment_name_{$language.id_lang}" value="{$attachment_name[$language.id_lang]|escape:'htmlall':'UTF-8'}" />
				</div>
			{/foreach}
			<sup>&nbsp;*</sup>
		</div>
		<p class="margin-form preference_description">{l s='Maximum 32 characters.'}</p>
		<div class="clear">&nbsp;</div>
		<label>{l s='Description:'} </label>
		<div class="margin-form translatable">
			{foreach $languages as $language}
				<div class="lang_{$language.id_lang}" style="display: {if $language.id_lang == $default_form_language}block{else}none{/if}; float: left;">
					<textarea name="attachment_description_{$language.id_lang}">{$attachment_description[$language.id_lang]|escape:'htmlall':'UTF-8'}</textarea>
				</div>
			{/foreach}
		</div>
		<div class="clear">&nbsp;</div>
		<label>{l s='File'}</label>
		<div class="margin-form">
			<p><input type="file" name="attachment_file" /></p>
			<p class="preference_description">{l s='Upload a file from your computer'} ({$PS_ATTACHMENT_MAXIMUM_SIZE|string_format:"%.2f"} {l s='MB max.'})</p>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="margin-form">
			<input type="submit" value="{l s='Upload attachment file'}" name="submitAddAttachments" class="button" />
		</div>
		<div class="small"><sup>*</sup> {l s='Required field'}</div>
	</fieldset>
	<div class="separation"></div>
	<div class="clear">&nbsp;</div>
	<table>
		<tr>
			<td>
                <p>{l s='Available attachments:'}</p>
                <select multiple id="selectAttachment2" style="width:300px;height:160px;">
                    {foreach $attach2 as $attach}
                        <option value="{$attach.id_attachment}">{$attach.name}</option>
                    {/foreach}
                </select><br /><br />
                <a href="#" id="addAttachment" style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px">
                    {l s='Add'} &gt;&gt;
                </a>
            </td>
            <td style="padding-left:20px;">
                <p>{l s='Attachments for this product:'}</p>
                <select multiple id="selectAttachment1" name="attachments[]" style="width:300px;height:160px;">
                    {foreach $attach1 as $attach}
                        <option value="{$attach.id_attachment}">{$attach.name}</option>
                    {/foreach}
                </select><br /><br />
                <a href="#" id="removeAttachment" style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px">
                    &lt;&lt; {l s='Remove'}
                </a>
			</td>
		</tr>
	</table>
	<div class="clear">&nbsp;</div>
	<input type="hidden" name="arrayAttachments" id="arrayAttachments" value="{foreach $attach1 as $attach}{$attach.id_attachment},{/foreach}" />

	<script type="text/javascript">
		var iso = '{$iso_tiny_mce}';
		var pathCSS = '{$smarty.const._THEME_CSS_DIR_}';
		var ad = '{$ad}';
	</script>
{/if}
