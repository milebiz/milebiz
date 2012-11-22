<?php
/*
* ___COPY__RIGHT___
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
