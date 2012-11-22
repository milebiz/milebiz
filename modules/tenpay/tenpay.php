<?php
/*
* ___COPY__RIGHT___
*/

if (!defined('_MB_VERSION_'))
	exit;

class Tenpay extends PaymentModule
{
	private $_html = '';
	private $_postErrors = array();
	private $_fieldsList = array();

	public function __construct()
	{
		$this->name = 'tenpay';
		$this->tab = 'payments_gateways';
		$this->version = '1.0.0';
		$this->author = 'MileBiz';
		parent::__construct();

        $this->_errors = array();
		$this->page = basename(__FILE__, '.php');
	    $this->displayName = $this->l('tenpay');
	    $this->description = $this->l('Accepts payments with tenpay.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details?');
		$this->_fieldsList = array(
			'tenpay_account' => 
				array(
					'name' =>$this->l('tenpay_account'),
					'validate'=>'isString',
					'type'=>'text',
					'value'=>''
				),
			'tenpay_key' => 
				array(
					'name' =>$this->l('tenpay_key'),
					'validate'=>'isString',
					'type'=>'text',
					'value'=>''
				),
			'magic_string' => 
				array(
					'name' =>$this->l('magic_string'),
					'validate'=>'isString',
					'type'=>'text',
					'value'=>''
				)
		);

		foreach($this->_fieldsList as $field => $detail)
		{
			if(Configuration::get($this->_getKey($field)))
			{
				$this->_fieldsList[$field]['value'] = Configuration::get($this->_getKey($field));
			}
		}
	}
	
    public function doPayment()
	{
		global $cart,$cookie;
        $cmd_no = '1';

        /* ��ö�������ˮ�ţ����㵽10λ */
        $sp_billno = $cart->id;

        /* �������� */
        $today = date('Ymd');

        /* ���̻���+������+��ˮ�� */
        $bill_no = str_pad($cart->id, 10, 0, STR_PAD_LEFT);
        $transaction_id = $this->_fieldsList['tenpay_account']['value'].$today.$bill_no;

        /* ��������:֧�ִ����غͲƸ�ͨ */
        $bank_type = '0';

        /* �����������ö�������� */
        if (!empty($cart->id))
        {
            $desc = $cart->id;
            $attach = '';
        }
        else
        {
            $desc = $this->l('account_voucher');
            $attach = 'voucher';
        }

        /* ���ص�·�� */
        $return_url = return_url('tenpay');

        /* �ܽ�� */
        $total_fee = floatval(floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''))) * 100;

        /* �������� */
        $fee_type = '1';

        /* ��д�Զ���ǩ�� */
        //$this->_fieldsList['magic_string']['value'] = abs(crc32($this->_fieldsList['magic_string']['value']));

        /* ����ǩ�� */
        $sign_text = "cmdno=" . $cmd_no . "&date=" . $today . "&bargainor_id=" . $this->_fieldsList['tenpay_account']['value'] .
          "&transaction_id=" . $transaction_id . "&sp_billno=" . $sp_billno .
          "&total_fee=" . $total_fee . "&fee_type=" . $fee_type . "&return_url=" . $return_url .
          "&attach=" . $attach . "&key=" . $this->_fieldsList['tenpay_key']['value'];
        $sign = strtoupper(md5($sign_text));

        /* ���ײ��� */
        $parameter = array(
            'cmdno'             => $cmd_no,                     // ҵ�����, �Ƹ�֧ͨ��֧���ӿ���  1
            'date'              => $today,                      // �̻����ڣ���20051212
            'bank_type'         => $bank_type,                  // ��������:֧�ִ����غͲƸ�ͨ
            'desc'              => $desc,                       // ���׵���Ʒ����
            'purchaser_id'      => '',                          // �û�(��)�ĲƸ�ͨ�ʻ�,����Ϊ��
            'bargainor_id'      => $this->_fieldsList['tenpay_account']['value'],  // �̼ҵĲƸ�ͨ�̻���
            'transaction_id'    => $transaction_id,             // ���׺�(������)�����̻���վ����(����˳���ۼ�)
            'sp_billno'         => $sp_billno,                  // �̻�ϵͳ�ڲ��Ķ�����,���10λ
            'total_fee'         => $total_fee,                  // �������
            'fee_type'          => $fee_type,                   // �ֽ�֧������
            'return_url'        => $return_url,                 // ���ղƸ�ͨ���ؽ����URL
            'attach'            => $attach,                     // �û��Զ���ǩ��
            'sign'              => $sign                        // MD5ǩ��

        );

        $button  = '<br /><form style="text-align:center;" action="https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi" target="_blank" style="margin:0px;padding:0px" >';

        foreach ($parameter AS $key=>$val)
        {
            $button  .= "<input type='hidden' name='$key' value='$val' />";
        }

        $button  .= '<input type="image" src="'. $GLOBALS['ecs']->url() .'images/tenpay.gif" value="' .$this->l('pay_button'). '" /></form><br />';

        return $button;
    }

    /**
     * ��Ӧ����
     */
	public function analyzeReturn(&$redirectLink = '')
	{
		$redirectLink = 'order-confirmation.php?';
        /*ȡ���ز���*/
        $cmd_no         = $_GET['cmdno'];
        $pay_result     = $_GET['pay_result'];
        $pay_info       = $_GET['pay_info'];
        $bill_date      = $_GET['date'];
        $bargainor_id   = $_GET['bargainor_id'];
        $transaction_id = $_GET['transaction_id'];
        $sp_billno      = $_GET['sp_billno'];
        $total_fee      = $_GET['total_fee'];
        $fee_type       = $_GET['fee_type'];
        $attach         = $_GET['attach'];
        $sign           = $_GET['sign'];

        //$order_sn   = $bill_date . str_pad(intval($sp_billno), 5, '0', STR_PAD_LEFT);
        //$log_id = preg_replace('/0*([0-9]*)/', '\1', $sp_billno); //ȡ��֧����log_id
        if ($attach == 'voucher')
        {
            $log_id = get_order_id_by_sn($sp_billno, "true");
        }
        else
        {
            $log_id = get_order_id_by_sn($sp_billno);
        }

        /* ���pay_result����0���ʾ֧��ʧ�� */
        if ($pay_result > 0)
        {
            return false;
        }

        /* ���֧���Ľ���Ƿ���� */
        if (!$this->_checkReturnMoney($log_id, $total_fee / 100))
        {
            return false;
        }

        /* �������ǩ���Ƿ���ȷ */
        $sign_text  = "cmdno=" . $cmd_no . "&pay_result=" . $pay_result .
                          "&date=" . $bill_date . "&transaction_id=" . $transaction_id .
                            "&sp_billno=" . $sp_billno . "&total_fee=" . $total_fee .
                            "&fee_type=" . $fee_type . "&attach=" . $attach .
                            "&key=" . $this->_fieldsList['tenpay_key']['value'];
        $sign_md5 = strtoupper(md5($sign_text));
        if ($sign_md5 != $sign)
        {
            return false;
        }
        else
        {
            /* �ı䶩��״̬ */
            $this->createSuccessedOrder($log_id);
            return true;
        }
    }

	
	public function createSuccessedOrder($cart_id)
	{
		global $cookie;
		$cart = new Cart((int)$cart_id);
	    if(!$cart->OrderExists()){
			$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));
			$tenpay = new Tenpay();
			$tenpay->validateOrder($cart->id, _PS_OS_PAYMENT_, $total, $tenpay->displayName);
		}
		$order = new Order((int)($alipay->currentOrder));
		
		return 'id_cart='.$cart_id.'&id_module='.$this->id.'&key='.$order->secure_key;
	}

	public function install()
	{
		/* Install and register on hook */
		if (!parent::install()
			OR !$this->registerHook('payment')
			OR !$this->registerHook('paymentReturn'))
			return false;
		return true;
	}
	
	public function uninstall()
	{
		if(!$this->unregisterHook('payment') || !$this->unregisterHook('paymentReturn'))
			return false;
		return parent::uninstall();
	}
	
	public function hookPayment($params)
	{
		
		if (!$this->active)
			return ;
		$this->smarty->assign('payment_link',$this->doPayment());

		return $this->display(__FILE__, 'payment.tpl');
	}

	public function hookPaymentReturn($params)
	{
		if (!$this->active)
			return ;

		return $this->display(__FILE__, 'payment-return.tpl');
	}
	
	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

		if (!empty($_POST))
		{
			if (!$this->_postValidation())
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error">'. $err .'</div>';
		}
		else
			$this->_html .= '<br />';

		$this->_displayForm();

		return $this->_html;
	}
	
	private function _postValidation()
	{
		if (!isset($_POST['btnSubmit'])) return;
		$validate = new Validate();
		foreach($this->_fieldsList as $field => $detail)
		{
			$method = $detail['validate'];
			if (!method_exists($validate, $method))
				die (Tools::displayError('Validation function not found.').' '.$method);
			if(!call_user_func(array('Validate', $method), Tools::getValue($field)))
				$this->_postErrors[] = $detail['name'].$this->l(' format Incorrect .');
		}
		if(sizeof($this->_postErrors))
			return false;
		
		foreach($this->_fieldsList as $field => $detail)
		{
			$this->_fieldsList[$field]['value'] = Tools::getValue($field);
			Configuration::updateValue($this->_getKey($field), Tools::getValue($field));
		}
		return true;
	}

	private function _displayForm()
	{
		$this->_html .=
		'<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="../img/admin/contact.gif" />'.$this->l('Configuration information').'</legend>
				<table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
					<tr><td colspan="2">'.$this->l('Please enter the tenpay configuration information').'.<br /><br /></td></tr>';
		foreach($this->_fieldsList as $field => $detail){
			$this->_html .= '
			<tr>
				<td width="130" style="height: 35px;">'.$detail['name'].'</td>
				<td>';
				$value = htmlentities(Tools::getValue($field,isset($detail['value'])?$detail['value']:''));
				if($detail['type'] == 'text'){
					$this->_html .= '
					<input type="text" name="'.$field.'" value="'.$value.'" size="40" />
					';
				}
				else if($detail['type'] == 'textarea'){
					$this->_html .= '
					<textarea name="'.$field.'" cols="80" rows="5">'.$value.'</textarea>
					';
				}
				else if($detail['type'] == 'select'){
					$this->_html .= '<select name="'.$field.'">';
					foreach($detail['range'] as $key => $option){
						if($key == $value){
							$this->_html .= '<option value="'.$key.'" selected="selected">'.$option.'</option>';
						}else{
							$this->_html .= '<option value="'.$key.'">'.$option.'</option>';
						}
      				}
      				$this->_html .= '</select>';
				}else{
					$this->_html .= '
						type error!
					';
				}
			$this->_html .= '
				</td>
			</tr>
			';
		}
		$this->_html .= '
					<tr><td colspan="2" align="center"><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
				</table>
		  </fieldset>
		</form>';
	}
	private function _getKey($field)
	{
		return $this->name.'_'.$field;
	}
	
	private function _checkReturnMoney($cart_id,$total_fee)
	{
		$cart = new Cart( $cart_id );
        $total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));
        /* ���֧���Ľ���Ƿ���� */
        if ($total!== floatval($total_fee))
        {
            return false;
        }
		return true;
	}	
}
