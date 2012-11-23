<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

abstract class InstallAbstractModel
{
	/**
	 * @var InstallLanguages
	 */
	public $language;

	/**
	 * @var array List of errors
	 */
	protected $errors = array();

	public function __construct()
	{
		$this->language = InstallLanguages::getInstance();
	}

	public function setError($errors)
	{
		if (!is_array($errors))
			$errors = array($errors);

		$this->errors[] = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}
