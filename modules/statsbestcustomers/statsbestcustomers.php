<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

if (!defined('_MB_VERSION_'))
	exit;

class StatsBestCustomers extends ModuleGrid
{
	private $_html;
	private $_query;
	private $_columns;
	private $_defaultSortColumn;
	private $_defaultSortDirection;
	private $_emptyMessage;
	private $_pagingMessage;

	public function __construct()
	{
		$this->name = 'statsbestcustomers';
		$this->tab = 'analytics_stats';
		$this->version = 1.0;
		$this->author = 'MileBiz';
		$this->need_instance = 0;
		
		parent::__construct();
		
		$this->_defaultSortColumn = 'totalMoneySpent';
		$this->_defaultSortDirection = 'DESC';
		$this->_emptyMessage = $this->l('Empty recordset returned');
		$this->_pagingMessage = sprintf($this->l('Displaying %1$s of %2$s'), '{0} - {1}', '{2}');

		$this->_columns = array(
			array(
				'id' => 'lastname',
				'header' => $this->l('Lastname'),
				'dataIndex' => 'lastname',
				'width' => 50
			),
			array(
				'id' => 'firstname',
				'header' => $this->l('Firstname'),
				'dataIndex' => 'firstname',
				'width' => 50
			),
			array(
				'id' => 'email',
				'header' => $this->l('Email'),
				'dataIndex' => 'email',
				'width' => 120
			),
			array(
				'id' => 'totalVisits',
				'header' => $this->l('Visits'),
				'dataIndex' => 'totalVisits',
				'width' => 80,
				'align' => 'right'),
			array(
				'id' => 'totalMoneySpent',
				'header' => $this->l('Money spent'),
				'dataIndex' => 'totalMoneySpent',
				'width' => 80,
				'align' => 'right')
		);

		$this->displayName = $this->l('Best customers');
		$this->description = $this->l('A list of the best customers');
	}

	public function install()
	{
		return (parent::install() && $this->registerHook('AdminStatsModules'));
	}

	public function hookAdminStatsModules($params)
	{
		$engineParams = array(
			'id' => 'id_customer',
			'title' => $this->displayName,
			'columns' => $this->_columns,
			'defaultSortColumn' => $this->_defaultSortColumn,
			'defaultSortDirection' => $this->_defaultSortDirection,
			'emptyMessage' => $this->_emptyMessage,
			'pagingMessage' => $this->_pagingMessage
		);
		if (Tools::getValue('export'))
			$this->csvExport($engineParams);
		$this->_html = '
		<div class="blocStats"><h2 class="icon-'.$this->name.'"><span></span>'.$this->displayName.'</h2>
			'.$this->engine($engineParams).'
		<p><a class="button export-csv" href="'.htmlentities($_SERVER['REQUEST_URI']).'&export=1"><span>'.$this->l('CSV Export').'</span></a></p>
		</div><br />
		<div class="blocStats"><h2 class="icon-guide"><span></span>'.$this->l('Guide').'</h2>
			<h2 >'.$this->l('Develop clients\' loyalty').'</h2>
			<p class="space">
				'.$this->l('Keeping a client is more profitable than gaining a new one. Thus, it is necessary to develop their loyalty, in other words to make them want to come back to your webshop.').' <br />
				'.$this->l('Word of mouth is also a means to of getting new, satisfied clients; a dissatisfied one won\'t attract new clients.').'<br />
				'.$this->l('In order to achieve this goal you can organize: ').'
				<ul>
					<li>'.$this->l('Punctual operations: commercial rewards (personalized special offers, product or service offered),
						non commercial rewards (priority handling of an order or a product), pecuniary rewards (bonds, discount coupons, payback).').'</li>
					<li>'.$this->l('Sustainable operations: loyalty points or cards, which not only justify communication between merchant and client,
						 but also offer advantages to clients (private offers, discounts).').'</li>
				</ul>
				'.$this->l('These operations encourage clients to buy products and visit your webshop regularly.').' <br />
			</p><br />
		</div>';
		return $this->_html;
	}

	public function getData()
	{
		$this->_query = '
		SELECT SQL_CALC_FOUND_ROWS c.`id_customer`, c.`lastname`, c.`firstname`, c.`email`,
			COUNT(co.`id_connections`) as totalVisits,
			IFNULL((
				SELECT ROUND(SUM(IFNULL(o.`total_paid_real`, 0) / cu.conversion_rate), 2) 
				FROM `'._DB_PREFIX_.'orders` o
				LEFT JOIN `'._DB_PREFIX_.'currency` cu ON o.id_currency = cu.id_currency
				WHERE o.id_customer = c.id_customer
				AND o.invoice_date BETWEEN '.$this->getDate().'
				AND o.valid
			), 0) as totalMoneySpent
		FROM `'._DB_PREFIX_.'customer` c
		LEFT JOIN `'._DB_PREFIX_.'guest` g ON c.`id_customer` = g.`id_customer`
		LEFT JOIN `'._DB_PREFIX_.'connections` co ON g.`id_guest` = co.`id_guest`
		WHERE co.date_add BETWEEN '.$this->getDate()
			.Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'c').
		'GROUP BY c.`id_customer`, c.`lastname`, c.`firstname`, c.`email`';
		if (Validate::IsName($this->_sort))
		{
			$this->_query .= ' ORDER BY `'.$this->_sort.'`';
			if (isset($this->_direction) && Validate::isSortDirection($this->_direction))
				$this->_query .= ' '.$this->_direction;
		}
		if (($this->_start === 0 || Validate::IsUnsignedInt($this->_start)) && Validate::IsUnsignedInt($this->_limit))
			$this->_query .= ' LIMIT '.$this->_start.', '.($this->_limit);
		$this->_values = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($this->_query);
		$this->_totalCount = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT FOUND_ROWS()');
	}
}
