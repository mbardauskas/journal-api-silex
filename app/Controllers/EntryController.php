<?php

namespace App\Controllers;

use App\Models\Entry;

/**
 * Class EntryController
 * @package App\Controllers
 */
class EntryController extends BaseController {

	/**
	 * Returns all Entry models
	 * @return array
	 */
	public static function actionList() {
		$model = Entry::Model()->fetchAll();
		return $model;
	}

	/**
	 * Inserts Entry to DB
	 * @param array $model Array which maps to database fields
	 * @return bool
	 */
	public static function actionInsert($model) {
		return Entry::Model()->insert($model);
	}
}
