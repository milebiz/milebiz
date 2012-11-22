<?php
/*
* ___COPY__RIGHT___
*/

class AliasCore extends ObjectModel
{
	public $alias;
	public $search;
	public $active = true;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'alias',
		'primary' => 'id_alias',
		'fields' => array(
			'search' => array('type' => self::TYPE_STRING, 'validate' => 'isValidSearch', 'required' => true, 'size' => 255),
			'alias' => 	array('type' => self::TYPE_STRING, 'validate' => 'isValidSearch', 'required' => true, 'size' => 255),
			'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
		),
	);

	public function __construct($id = null, $alias = null, $search = null, $id_lang = null)
	{
		$this->def = Alias::getDefinition($this);
		$this->setDefinitionRetrocompatibility();

		if ($id)
			parent::__construct($id);
		else if ($alias && Validate::isValidSearch($alias))
		{
			if (!Alias::isFeatureActive())
			{
				$this->alias = trim($alias);
				$this->search = trim($search);
			}
			else
			{
				$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
				SELECT a.id_alias, a.search, a.alias
				FROM `'._DB_PREFIX_.'alias` a
				WHERE `alias` LIKE \''.pSQL($alias).'\' AND `active` = 1');

				if ($row)
				{
				 	$this->id = (int)($row['id_alias']);
				 	$this->search = $search ? trim($search) : $row['search'];
					$this->alias = $row['alias'];
				}
				else
				{
					$this->alias = trim($alias);
					$this->search = trim($search);
				}
			}
		}
	}

	public function add($autodate = true, $nullValues = false)
	{
		if (parent::add($autodate, $nullValues))
		{
			// Set cache of feature detachable to true
			Configuration::updateGlobalValue('PS_ALIAS_FEATURE_ACTIVE', '1');
			return true;
		}
		return false;
	}

	public function delete()
	{
		if (parent::delete())
		{
			// Refresh cache of feature detachable
			Configuration::updateGlobalValue('PS_ALIAS_FEATURE_ACTIVE', Alias::isCurrentlyUsed($this->def['table'], true));
			return true;
		}
		return false;
	}

	public function getAliases()
	{
		if (!Alias::isFeatureActive())
			return '';

		$aliases = Db::getInstance()->executeS('
		SELECT a.alias
		FROM `'._DB_PREFIX_.'alias` a
		WHERE `search` = \''.pSQL($this->search).'\'');

		$aliases = array_map('implode', $aliases);
		return implode(', ', $aliases);
	}

	/**
	 * This method is allow to know if a feature is used or active
	 * @since 1.5.0.1
	 * @return bool
	 */
	public static function isFeatureActive()
	{
		return Configuration::get('PS_ALIAS_FEATURE_ACTIVE');
	}
}

