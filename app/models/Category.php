<?php


namespace app\models;


use app\models\app\AppModel;
use oclock\App;

class Category extends AppModel
{
	public function getIds($id)
	{
		 $cats = App::$app->getProperty('category');
		 $cat = $cats[$id];
	}
}