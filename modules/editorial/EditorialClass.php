<?php
/**
 * MILEBIZ 米乐商城
 * ============================================================================
 * 版权所有 2011-20__ 米乐网。
 * 网站地址: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

class EditorialClass extends ObjectModel
{
	/** @var integer editorial id*/
	public $id;
	
	/** @var integer editorial id shop*/
	public $id_shop;
	
	/** @var string body_title*/
	public $body_home_logo_link;

	/** @var string body_title*/
	public $body_title;

	/** @var string body_title*/
	public $body_subheading;

	/** @var string body_title*/
	public $body_paragraph;

	/** @var string body_title*/
	public $body_logo_subheading;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'editorial',
		'primary' => 'id_editorial',
		'multilang' => true,
		'fields' => array(
			'id_shop' =>				array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			'body_home_logo_link' =>	array('type' => self::TYPE_STRING, 'validate' => 'isUrl'),
			// Lang fields
			'body_title' =>				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName'),
			'body_subheading' =>		array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName'),
			'body_paragraph' =>			array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'),
			'body_logo_subheading' =>	array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName'),
		)
	);

	static public function getByIdShop($id_shop)
	{
		$id = Db::getInstance()->getValue('SELECT `id_editorial` FROM `'._DB_PREFIX_.'editorial` WHERE `id_shop` ='.(int)$id_shop);
		if ($id)
			return new EditorialClass((int)$id);
		else
			return false;
	}

	public function copyFromPost()
	{
		/* Classical fields */
		foreach ($_POST AS $key => $value)
			if (key_exists($key, $this) AND $key != 'id_'.$this->table)
				$this->{$key} = $value;

		/* Multilingual fields */
		if (sizeof($this->fieldsValidateLang))
		{
			$languages = Language::getLanguages(false);
			foreach ($languages AS $language)
				foreach ($this->fieldsValidateLang AS $field => $validation)
					if (isset($_POST[$field.'_'.(int)($language['id_lang'])]))
						$this->{$field}[(int)($language['id_lang'])] = $_POST[$field.'_'.(int)($language['id_lang'])];
		}
	}
}
