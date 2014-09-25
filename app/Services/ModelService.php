<?php

namespace App\Services;

use Doctrine\DBAL\Connection;
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
	 * @var Connection
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
		$queryBuilder = $this->db->createQueryBuilder();
		$queryBuilder
			->select('*')
			->from($this->table_name, 't1')
			->where('t1.'.$field_name.' = :val')
			->setParameter(':val', $field_value)
		;
		$result = $queryBuilder->execute()->fetchAll();

		return $result;
	}

	/**
	 * Returns all entries from the given database table
	 * @return array
	 */
	public function fetchAll() {
		$queryBuilder = $this->db->createQueryBuilder();
		$queryBuilder
			->select('*')
			->from($this->table_name, 't1')
		;
		$result = $queryBuilder->execute()->fetchAll();

		return $result;
	}

	/**
	 * Inserts model to the database.
	 * @TODO: upgrade to dbal 2.5 and implement insert method
	 * @param array $model Array of data which maps to database array
	 * @return bool
	 */
	public function insert($model) {
		$fields = implode('`, `', array_keys($model));
		$values = array_values($model);
		$query = "INSERT INTO {$this->table_name} (`{$fields}`) VALUES (?)";

		$result = $this->db->executeQuery($query, array($values), array(Connection::PARAM_INT_ARRAY));
		return $result;
	}

	/**
	 * Updates DB entry
	 * @param $id
	 * @param $model
	 * @return bool|mixed
	 */
	public function update($id, $model) {
		/**
		 * @TODO: Add checking of user and owner_id in the db, otherwise it is possible to change any user's entries
		 */

		if(!empty($model['id'])) {
			if($model['id'] != $id) {
				return false;
			};

			// otherwise it interferes with update query
			unset($model['id']);
		}

		$queryBuilder = $this->db->createQueryBuilder();
		$queryBuilder
			->update($this->table_name)
			->where("id = $id")
		;

		foreach($model as $model_key => $model_val) {
			$queryBuilder->set($model_key, ":".$model_key);
			$queryBuilder->setParameter($model_key, $model_val);
		}

		$result = $queryBuilder->execute();
		return $result;
	}

	/**
	 * Removes DB entry
	 * @param $id
	 * @return mixed
	 */
	public function delete($id) {
		$queryBuilder = $this->db->createQueryBuilder();

		$queryBuilder
			->delete($this->table_name)
			->where("id = $id")
		;

		$result = $queryBuilder->execute();
		return $result;
	}
}