{**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网络科技有限公司。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<h3>{l s='Referral program rules' mod='referralprogram'}</h3>

{if isset($xml)}
<div id="referralprogram_rules">
	{if isset($xml->body->$paragraph)}<div class="rte">{$xml->body->$paragraph|replace:"\'":"'"|replace:'\"':'"'}</div>{/if}
</div>
{/if}
