<?php

namespace App\Services;

use Silex\Application;
use Doctrine\DBAL\DriverManager;

class ModelService {
	/**
	 * @var array
	 * @TODO: move to a separate config file
	 */
	protected static $config = array(
		'driver'    => 'pdo_mysql',
		'host'      => 'localhost',
		'dbname'    => 'silex_journal',
		'user'      => 'silex_journal',
		'password'  => '',
		'charset'   => 'utf8',
	);

	/**
	 * @var \Doctrine\DBAL\Connection
	 */
	private $db;

	/**
	 * @var string Database table name
	 */
	private $table_name;

	public function __construct($table_name) {
		$this->table_name = $table_name;
		$this->db = DriverManager::getConnection(self::$config);
	}

	public function fetchByPk($id) {
		$query = "SELECT * FROM {$this->table_name} WHERE id = ?";
		$result = $this->db->fetchAssoc($query, array((int) $id));

		return $result;
	}

	public function fetchAll() {
		$query = "SELECT * FROM {$this->table_name}";
		$result = $this->db->fetchAll($query);

		return $result;
	}
}