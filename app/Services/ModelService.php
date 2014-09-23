<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;

/**
 * Class ModelService
 * @package App\Services
 */
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

	/**
	 * @param $table_name
	 */
	public function __construct($table_name) {
		$this->table_name = $table_name;
		$this->db = DriverManager::getConnection(self::$config);
	}

	/**
	 * Returns an entry from the given database table by primary key.
	 * @param $id
	 * @return array
	 */
	public function fetchByPk($id) {
		/**
		 * @TODO: Make queries with queryBuilder
		 */
		$query = "SELECT * FROM {$this->table_name} WHERE id = ?";
		$result = $this->db->fetchAssoc($query, array((int) $id));

		return $result;
	}

	/**
	 * Returns entries by field and its value.
	 * @param $field_name
	 * @param $field_value
	 * @return array
	 */
	public function fetchByField($field_name, $field_value) {
		/**
		 * @TODO: Make queries with queryBuilder
		 */
		$query = "SELECT * FROM {$this->table_name} WHERE {$field_name} = :val";
		$result = $this->db->fetchAssoc($query, array(':val' => $field_value));

		return $result;
	}

	/**
	 * Returns all entries from the given database table
	 * @return array
	 */
	public function fetchAll() {
		/**
		 * @TODO: Make queries with queryBuilder
		 */
		$query = "SELECT * FROM {$this->table_name}";
		$result = $this->db->fetchAll($query);

		return $result;
	}
}