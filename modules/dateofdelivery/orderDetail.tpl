{*
* ___COPY__RIGHT___
*}
{if $datesDelivery|count}
	<p id="dateofdelivery">{l s='Approximate date of delivery is between %1$s and %2$s' sprintf=[$datesDelivery.0.0, $datesDelivery.1.0] mod='dateofdelivery'} <sup>*</sup></p>
	<p style="font-size:10px;margin:0padding:0;"><sup>*</sup> {l s='with direct payment methods (e.g. credit card)' mod='dateofdelivery'}</p>
{/if}