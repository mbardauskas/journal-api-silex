<?php

namespace App\Models;

/**
 * Class Entry
 * @package App\Models
 */
class Entry extends BaseModel {
	static private $tableName = "silex_entry";

	/**
	 * @return \App\Services\ModelService
	 */
	static public function Model() {
		return parent::Model(self::$tableName);
	}
}