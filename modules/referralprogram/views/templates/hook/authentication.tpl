{*
* ___COPY__RIGHT___
*}

<!-- MODULE ReferralProgram -->
<fieldset class="account_creation">
	<h3>{l s='Referral program' mod='referralprogram'}</h3>
	<p class="text">
		<label for="referralprogram">{l s='E-mail address of your sponsor' mod='referralprogram'}</label>
		<input type="text" size="52" maxlength="128" id="referralprogram" name="referralprogram" value="{if isset($smarty.post.referralprogram)}{$smarty.post.referralprogram|escape:'htmlall':'UTF-8'}{/if}" />
	</p>
</fieldset>
<!-- END : MODULE ReferralProgram -->