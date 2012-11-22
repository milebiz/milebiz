<?php
/*
* ___COPY__RIGHT___
*/

class HelperViewCore extends Helper
{
	public $id;
	public $toolbar = true;
	public $table;
	public $token;

	/** @var if not null, a title will be added on that list */
	public $title = null;

	public function __construct()
	{
		$this->base_folder = 'helpers/view/';
		$this->base_tpl = 'view.tpl';
		parent::__construct();
	}

	public function generateView()
	{
		$this->tpl = $this->createTemplate($this->base_tpl);

		$this->tpl->assign(array(
			'title' => $this->title,
			'current' => $this->currentIndex,
			'token' => $this->token,
			'table' => $this->table,
			'show_toolbar' => $this->show_toolbar,
			'toolbar_scroll' => $this->toolbar_scroll,
			'toolbar_btn' => $this->toolbar_btn,
			'link' => $this->context->link
		));

		return parent::generate();
	}
}
