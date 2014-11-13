<?php

namespace Foosball;

class Db
{
	/**
	 * @var
	 */
	protected static $db;

	public function connect() {
		new \PDO($dsn, $username, $password);
	}
}
