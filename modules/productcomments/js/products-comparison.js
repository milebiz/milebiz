/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

$(function () {
	$('a.cluetip')
		.cluetip({
			local:true,
			cursor: 'pointer',
			cluetipClass: 'comparison_comments',
			dropShadow: false,
			dropShadowSteps: 0,
			showTitle: false,
			tracking: true,
			sticky: false,
			mouseOutClose: true,
		    width: 450,
			fx: {             
		    open:       'fadeIn',
		    openSpeed:  'fast'
		  }
		})
		.css('opacity', 0.8);
});
