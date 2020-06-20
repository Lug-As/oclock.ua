<?php


namespace app\controllers;


use app\controllers\app\AppController;
use app\models\Breadcrumbs;
use app\models\Category;
use app\widgets\pagination\Pagination;
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
		// Пагинация
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = App::$app->getProperty('pagination');
		$total = R::count('product', '`category_id` IN (' . R::genSlots($ids) . ')', $ids);
		$pagination = new Pagination($page, $perpage, $total);
		$offset = $pagination->getOffset();
		// Продукты
		$bindings = array_merge($ids, [$perpage, $offset]);
		$products = R::find('product', '`category_id` IN (' . R::genSlots($ids) . ') LIMIT ? OFFSET ?', $bindings);
		// Крошки
		$breadcrumbs = Breadcrumbs::getBreadcrumbs($id);
		$this->setMeta($category['title'] . " - Товары категории", $category['description'], $category['keywords']);
		$this->setData(compact('products', 'breadcrumbs', 'total', 'pagination'));
	}
}