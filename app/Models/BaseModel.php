<?php

namespace App\Models;

use App\Services\ModelService;

/**
 * Class BaseModel
 * @package App\Models
 */
abstract class BaseModel {
	/**
	 * @var array $service_instances
	 */
	static private $service_instances;

	/**
	 * Singleton for ModelServices
	 * @param string $tableName
	 * @return ModelService
	 */
	static public function Model($tableName) {
		if(empty(self::$service_instances[$tableName])) {
			self::$service_instances[$tableName] = new ModelService($tableName);
		}
		return self::$service_instances[$tableName];
	}
}