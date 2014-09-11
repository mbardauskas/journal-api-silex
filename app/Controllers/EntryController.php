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
}
