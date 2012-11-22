<?php
/*
* ___COPY__RIGHT___
*/

abstract class ModuleGridCore extends Module
{
	protected $_employee;

	/** @var string array graph data */
	protected $_values = array();

	/** @var integer total number of values **/
	protected $_totalCount = 0;

	/**@var string graph titles */
	protected $_title;

	/**@var integer start */
	protected $_start;

	/**@var integer limit */
	protected $_limit;

	/**@var string column name on which to sort */
	protected $_sort = null;

	/**@var string sort direction DESC/ASC */
	protected $_direction = null;

	/** @var ModuleGridEngine grid engine */
	protected $_render;

	abstract protected function getData();

	public function setEmployee($id_employee)
	{
		$this->_employee = new Employee($id_employee);
	}

	public function setLang($id_lang)
	{
		$this->_id_lang = $id_lang;
	}

	public function create($render, $type, $width, $height, $start, $limit, $sort, $dir)
	{
		if (!Validate::isModuleName($render))
			die(Tools::displayError());
		if (!Tools::file_exists_cache($file = _PS_ROOT_DIR_.'/modules/'.$render.'/'.$render.'.php'))
			die(Tools::displayError());
		require_once($file);
		$this->_render = new $render($type);

		$this->_start = $start;
		$this->_limit = $limit;
		$this->_sort = $sort;
		$this->_direction = $dir;

		$this->getData();

		$this->_render->setTitle($this->_title);
		$this->_render->setSize($width, $height);
		$this->_render->setValues($this->_values);
		$this->_render->setTotalCount($this->_totalCount);
		$this->_render->setLimit($this->_start, $this->_limit);
	}

	public function render()
	{
		$this->_render->render();
	}

	public function engine($params)
	{
		if (!($render = Configuration::get('PS_STATS_GRID_RENDER')))
			return Tools::displayError('No grid engine selected');
		if (!Validate::isModuleName($render))
			die(Tools::displayError());
		if (!file_exists(_PS_ROOT_DIR_.'/modules/'.$render.'/'.$render.'.php'))
			return Tools::displayError('Grid engine selected is unavailable.');

		$grider = 'grider.php?render='.$render.'&module='.Tools::safeOutput(Tools::getValue('module'));

		$context = Context::getContext();
		$grider .= '&id_employee='.(int)$context->employee->id;
		$grider .= '&id_lang='.(int)$context->language->id;

		if (!isset($params['width']) || !Validate::IsUnsignedInt($params['width']))
			$params['width'] = 600;
		if (!isset($params['height']) || !Validate::IsUnsignedInt($params['height']))
			$params['height'] = 920;
		if (!isset($params['start']) || !Validate::IsUnsignedInt($params['start']))
			$params['start'] = 0;
		if (!isset($params['limit']) || !Validate::IsUnsignedInt($params['limit']))
			$params['limit'] = 40;

		$grider .= '&width='.$params['width'];
		$grider .= '&height='.$params['height'];
		if (isset($params['start']) && Validate::IsUnsignedInt($params['start']))
			$grider .= '&start='.$params['start'];
		if (isset($params['limit']) && Validate::IsUnsignedInt($params['limit']))
			$grider .= '&limit='.$params['limit'];
		if (isset($params['type']) && Validate::IsName($params['type']))
			$grider .= '&type='.$params['type'];
		if (isset($params['option']) && Validate::IsGenericName($params['option']))
			$grider .= '&option='.$params['option'];
		if (isset($params['sort']) && Validate::IsName($params['sort']))
			$grider .= '&sort='.$params['sort'];
		if (isset($params['dir']) && Validate::isSortDirection($params['dir']))
			$grider .= '&dir='.$params['dir'];

		require_once(_PS_ROOT_DIR_.'/modules/'.$render.'/'.$render.'.php');
		return call_user_func(array($render, 'hookGridEngine'), $params, $grider);
	}

	protected function csvExport($datas)
	{
		$this->_sort = $datas['defaultSortColumn'];
		$this->setLang(Context::getContext()->language->id);
		$this->getData();

		$layers = isset($datas['layers']) ?  $datas['layers'] : 1;

		if (isset($datas['option']))
			$this->setOption($datas['option'], $layers);

		if (count($datas['columns']))
		{
			foreach ($datas['columns'] as $column)
				$this->_csv .= $column['header'].';';
			$this->_csv = rtrim($this->_csv, ';')."\n";

			foreach ($this->_values as $value)
			{
				foreach ($datas['columns'] as $column)
					$this->_csv .= $value[$column['dataIndex']].';';
				$this->_csv = rtrim($this->_csv, ';')."\n";
			}
		}
		$this->_displayCsv();
	}

	protected function _displayCsv()
	{
		ob_end_clean();
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$this->displayName.' - '.time().'.csv"');
		echo $this->_csv;
		exit;
	}

	public function getDate()
	{
		return ModuleGraph::getDateBetween($this->_employee);
	}

	public function getLang()
	{
		return $this->_id_lang;
	}
}
