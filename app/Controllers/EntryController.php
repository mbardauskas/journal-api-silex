<?php

namespace App\Controllers;

use Silex\Application;
use App\Models\Entry;

class EntryController extends BaseController {
	public static function actionList() {
		$model = Entry::Model()->fetchAll();
		return $model;
	}
}
