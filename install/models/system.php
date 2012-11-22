<?php
/*
* ___COPY__RIGHT___
*/

class InstallModelSystem extends InstallAbstractModel
{
	public function checkRequiredTests()
	{
		return self::checkTests(ConfigurationTest::getDefaultTests(), 'required');
	}

	public function checkOptionalTests()
	{
		return self::checkTests(ConfigurationTest::getDefaultTestsOp(), 'optional');
	}

	public function checkTests($list, $type)
	{
		$tests = ConfigurationTest::check($list);
		$success = true;
		foreach ($tests as $result)
			$success &= ($result == 'ok') ? true : false;

		return array(
			'checks' =>		$tests,
			'success' =>	$success,
		);
	}
}
