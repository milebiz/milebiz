<?php
/*
* ___COPY__RIGHT___
*/

class PdfOrderSlipControllerCore extends FrontController
{
	protected $display_header = false;
	protected $display_footer = false;

	protected $order_slip;


	public function postProcess()
	{
		if (!$this->context->customer->isLogged())
			Tools::redirect('index.php?controller=authentication&back=order-follow');

		if (isset($_GET['id_order_slip']) && Validate::isUnsignedId($_GET['id_order_slip']))
			$this->order_slip = new OrderSlip($_GET['id_order_slip']);

		if (!isset($this->order_slip) || !Validate::isLoadedObject($this->order_slip))
			die(Tools::displayError('Order return not found'));

		else if ($this->order_slip->id_customer != $this->context->customer->id)
			die(Tools::displayError('Order return not found'));

	}

	public function display()
	{
		$pdf = new PDF($this->order_slip, PDF::TEMPLATE_ORDER_SLIP, $this->context->smarty);
		$pdf->render();
	}
}

