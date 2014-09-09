<?php

namespace App\Models;

use Silex\Application;

class Entry extends BaseModel {
	static private $tableName = "silex_entry";

	static public function Model() {
		return parent::Model(self::$tableName);
	}
}