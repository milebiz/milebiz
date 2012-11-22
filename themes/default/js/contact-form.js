/*
* ___COPY__RIGHT___
*/

$(document).ready(function () {
	$('select[name=id_order]').change(function () {
		showProductSelect($(this).attr('value'));
	});
});

function showProductSelect(id_order)
{
	$('.product_select').hide().attr('disabled', 'disabled');
	$('#'+id_order+'_order_products').show().removeAttr('disabled');
}