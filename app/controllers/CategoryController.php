<?php


namespace app\controllers;


use app\controllers\app\AppController;
use app\models\Category;
use oclock\App;
use RedBeanPHP\R;

class CategoryController extends AppController
{
	public function viewAction()
	{
		$alias = $this->route['alias'];
		$cats = App::$app->getProperty('category');
		$isExist = in_array($alias, array_column($cats, 'alias'));
		if (!$isExist) {
			throw new \Exception('Такой категории не найдено', 404);
		}
		// Получаем только ID, т.к. все категории уже есть в $cats
		$id = R::getRow('SELECT `id` FROM `category` WHERE `alias` = ?', [$alias]);
		$id = $id['id'];
		$category = $cats[$id];
		// Модель категории
		$cat_model = new Category();
		$ids = $cat_model->getIds($id);
		// Продукты
		$products = R::find('product', '`category_id` IN (?)', [$id]);
		$this->setMeta($category['title'] . " - Товары категории", $category['description'], $category['keywords']);
		$this->setData(compact('products'));
	}
}