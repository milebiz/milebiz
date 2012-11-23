<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */


class TaxRulesGroupCore extends ObjectModel
{
    public $name;

    /** @var bool active state */
    public $active;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'tax_rules_group',
		'primary' => 'id_tax_rules_group',
		'fields' => array(
			'name' =>	array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 64),
			'active' =>	array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
		),
	);

	protected $webserviceParameters = array(
	'objectsNodeName' => 'tax_rule_groups',
	'objectNodeName' => 'tax_rule_group',
		'fields' => array(
		),
	);

	protected static $_taxes = array();

	public static function getTaxRulesGroups($only_active = true)
	{
		return Db::getInstance()->executeS('
		SELECT *
		FROM `'._DB_PREFIX_.'tax_rules_group` g'
		.($only_active ? ' WHERE g.`active` = 1' : '').'
		ORDER BY name ASC');
	}

	/**
	* @return array an array of tax rules group formatted as $id => $name
	*/
	public static function getTaxRulesGroupsForOptions()
	{
		$tax_rules[] = array('id_tax_rules_group' => 0, 'name' => Tools::displayError('No tax'));
		return array_merge($tax_rules, TaxRulesGroup::getTaxRulesGroups());
	}


	/**
	* @return array
	*/
	public static function getAssociatedTaxRatesByIdCountry($id_country)
	{
	    $rows = Db::getInstance()->executeS('
	    SELECT rg.`id_tax_rules_group`, t.`rate`
	    FROM `'._DB_PREFIX_.'tax_rules_group` rg
   	    LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (tr.`id_tax_rules_group` = rg.`id_tax_rules_group`)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
	    WHERE tr.`id_country` = '.(int)$id_country.'
	    AND tr.`id_state` = 0
	    AND 0 between `zipcode_from` AND `zipcode_to`'
	    );

	    $res = array();
	    foreach ($rows as $row)
	        $res[$row['id_tax_rules_group']] = $row['rate'];

	    return $res;
	}

	/**
	* Returns the tax rules group id corresponding to the name
	*
	* @param string name
	* @return int id of the tax rules
	*/
	public static function getIdByName($name)
	{
	    return Db::getInstance()->getValue(
	    'SELECT `id_tax_rules_group`
	    FROM `'._DB_PREFIX_.'tax_rules_group` rg
	    WHERE `name` = \''.pSQL($name).'\''
	    );
	}

	/**
	* @deprecated since 1.5
	*/
	public static function getTaxesRate($id_tax_rules_group, $id_country, $id_state, $zipcode)
	{
		Tools::displayAsDeprecated();
	    $rate = 0;
	    foreach (TaxRulesGroup::getTaxes($id_tax_rules_group, $id_country, $id_state, $zipcode) as $tax)
	        $rate += (float)$tax->rate;

	    return $rate;
	}

	/**
	 * Return taxes associated to this para
	 * @deprecated since 1.5
	 */
	public static function getTaxes($id_tax_rules_group, $id_country, $id_state, $id_county)
	{
		Tools::displayAsDeprecated();
		return array();
	}

}

