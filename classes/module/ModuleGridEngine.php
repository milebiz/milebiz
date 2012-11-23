<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

abstract class ModuleGridEngineCore extends Module
{
	protected $_type;

	public function __construct($type)
	{
		$this->_type = $type;
	}

	public function install()
	{
		if (!parent::install())
			return false;
		return Configuration::updateValue('PS_STATS_GRID_RENDER', $this->name);
	}

	public static function getGridEngines()
	{
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
	    	SELECT m.`name`
	    	FROM `'._DB_PREFIX_.'module` m
	    	LEFT JOIN `'._DB_PREFIX_.'hook_module` hm ON hm.`id_module` = m.`id_module`
	    	LEFT JOIN `'._DB_PREFIX_.'hook` h ON hm.`id_hook` = h.`id_hook`
	    	WHERE h.`name` = \'displayAdminStatsGridEngine\'
	    ');

		$array_engines = array();
		foreach ($result as $module)
		{
			$instance = Module::getInstanceByName($module['name']);
			if (!$instance)
				continue;
			$array_engines[$module['name']] = array($instance->displayName, $instance->description);
		}

		return $array_engines;
	}

	abstract public function setValues($values);
	abstract public function setTitle($title);
	abstract public function setSize($width, $height);
	abstract public function setTotalCount($totalCount);
	abstract public function setLimit($start, $limit);
	abstract public function render();
}

