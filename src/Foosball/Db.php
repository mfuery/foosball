<?php

namespace Foosball;

use \Zend\Db\Adapter;

class Db
{
	/**
	 * @var \Zend\Db\Adapter
	 */
	protected static $db;

	/**
	 *
	 */
	public static function get() {
		if (!static::$db) {
			static::$db = new Adapter\Adapter(array(
				'driver' => 'Pdo_Mysql',
				'database' => 'foosball',
				'username' => 'root',
				'password' => 'root'
			));
		}

		return static::$db;
	}
}
