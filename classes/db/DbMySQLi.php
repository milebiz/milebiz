<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

/**
 * @since 1.5.0
 */
class DbMySQLiCore extends Db
{
	/**
	 * @see DbCore::connect()
	 */
	public function	connect()
	{
		if (strpos($this->server, ':') !== false)
		{
			list($server, $port) = explode(':', $this->server);
			$this->link = @new mysqli($server, $this->user, $this->password, $this->database, $port);
		}
		else
			$this->link = @new mysqli($this->server, $this->user, $this->password, $this->database);

		// Do not use object way for error because this work bad before PHP 5.2.9
		if (mysqli_connect_error())
			throw new MileBizDatabaseException(sprintf(Tools::displayError('Link to database cannot be established: %s'), mysqli_connect_error()));

		// UTF-8 support
		if (!$this->link->query('SET NAMES \'utf8\''))
			throw new MileBizDatabaseException(Tools::displayError('MileBiz Fatal error: no utf-8 support. Please check your server configuration.'));

		return $this->link;
	}

	/**
	 * @see DbCore::disconnect()
	 */
	public function	disconnect()
	{
		@$this->link->close();
	}

	/**
	 * @see DbCore::_query()
	 */
	protected function _query($sql)
	{
		return $this->link->query($sql);
	}

	/**
	 * @see DbCore::nextRow()
	 */
	public function nextRow($result = false)
	{
		if (!$result)
			$result = $this->result;
		return $result->fetch_assoc();
	}

	/**
	 * @see DbCore::_numRows()
	 */
	protected function _numRows($result)
	{
		return $result->num_rows;
	}

	/**
	 * @see DbCore::Insert_ID()
	 */
	public function	Insert_ID()
	{
		return $this->link->insert_id;
	}

	/**
	 * @see DbCore::Affected_Rows()
	 */
	public function	Affected_Rows()
	{
		return $this->link->affected_rows;
	}

	/**
	 * @see DbCore::getMsgError()
	 */
	public function getMsgError($query = false)
	{
		return $this->link->error;
	}

	/**
	 * @see DbCore::getNumberError()
	 */
	public function getNumberError()
	{
		return $this->link->errno;
	}

	/**
	 * @see DbCore::getVersion()
	 */
	public function getVersion()
	{
		return $this->getValue('SELECT VERSION()');
	}

	/**
	 * @see DbCore::_escape()
	 */
	public function _escape($str)
	{
		return $this->link->real_escape_string($str);
	}

	/**
	 * @see DbCore::set_db()
	 */
	public function set_db($db_name)
	{
		return $this->link->query('USE '.pSQL($db_name));
	}

	/**
	 * @see Db::hasTableWithSamePrefix()
	 */
	public static function hasTableWithSamePrefix($server, $user, $pwd, $db, $prefix)
	{
		$link = @new mysqli($server, $user, $pwd, $db);
		if (mysqli_connect_error())
			return false;

		$sql = 'SHOW TABLES LIKE \''.$prefix.'%\'';
		$result = $link->query($sql);
		return (bool)$result->fetch_assoc();
	}

	/**
	 * @see Db::checkConnection()
	 */
	public static function tryToConnect($server, $user, $pwd, $db, $newDbLink = true, $engine = null, $timeout = 5)
	{
		$link = mysqli_init();
		if (!$link)
			return -1;

		if (!$link->options(MYSQLI_OPT_CONNECT_TIMEOUT, $timeout))
			return 1;

		if (!$link->real_connect($server, $user, $pwd, $db))
			return (mysqli_connect_errno() == 1049) ? 2 : 1;

		if (strtolower($engine) == 'innodb')
		{
			$sql = 'SHOW VARIABLES WHERE Variable_name = \'have_innodb\'';
			$result = $link->query($sql);
			if (!$result)
				return 4;
			$row = $result->fetch_assoc();
			if (!$row || strtolower($row['Value']) != 'yes')
				return 4;
		}
		$link->close();
		return 0;
	}

	/**
	 * @see Db::checkEncoding()
	 */
	static public function tryUTF8($server, $user, $pwd)
	{
		$link = @new mysqli($server, $user, $pwd, $db);
		$ret = $link->query("SET NAMES 'UTF8'");
		$link->close();
		return $ret;
	}
}
