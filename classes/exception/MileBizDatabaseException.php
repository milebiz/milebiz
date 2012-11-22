<?php
/*
* ___COPY__RIGHT___
*/

/**
 * @since 1.5.0
 */
class MileBizDatabaseExceptionCore extends MileBizException
{
	public function __toString()
	{
		return $this->message;
	}
}

