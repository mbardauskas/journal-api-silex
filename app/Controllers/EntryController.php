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
	 * Returns one Entry model
	 * @param $id
	 * @return array
	 */
	public static function actionView($id) {
		return Entry::Model()->fetchByPk($id);
	}

	/**
	 * Inserts Entry to DB
	 * @param array $model Array which maps to database fields
	 * @return bool
	 */
	public static function actionInsert($model) {
		return Entry::Model()->insert($model);
	}

	/**
	 * Updates Entry in the DB
	 * @param $id
	 * @param $model
	 * @return bool|mixed
	 */
	public static function actionUpdate($id, $model) {
		$db_model = Entry::Model()->fetchByPk($id);
		if(empty($db_model)) {
			return Entry::Model()->insert($model);
		}

		return Entry::Model()->update($id, $model);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public static function actionDelete($id) {
		return Entry::Model()->delete($id);
	}
}
