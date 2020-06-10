<?php


namespace app\models;


use app\models\app\AppModel;
use oclock\App;

class Breadcrumbs extends AppModel
{
	public static function getBreadcrumbs($category_id, $title = "")
	{
		$cats = App::$app->getProperty('category');
		self::getParts($cats, $category_id);
	}

	public static function getParts($cats, $id)
	{

	}
}