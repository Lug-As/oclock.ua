<?php


namespace app\controllers;


use app\controllers\app\AppController;
use app\models\Breadcrumbs;
use app\models\Product;
use RedBeanPHP\R;

class ProductController extends AppController
{
	public function viewAction()
	{
		$alias = $this->route['alias'];
		$product = R::findOne('product', "`alias` = ? AND `status` = '1'", [$alias]);
		if (!$product) {
			throw new \Exception('Страница не найдена', 404);
		}
		// Modifications
		$mods = $product->ownModificationList;
		// Gallery
		$photos = R::find('gallery', '`product_id` = ?', [2]);
		// Related products
		$relProducts = R::getAll("SELECT * FROM `related_product` JOIN `product` ON `product`.`id` = `related_product`.`related_id` WHERE `related_product`.`product_id` = ?", [$product->id]);
		// Cookie
		$model = new Product();
		$model->setRecentlyViewed($product->id);
		// Recently viewed
		$r_viewed = $model->getRecentlyViewed();
		// Breadcrumbs
		$breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);
		// Set meta & data
		$this->setMeta($product->title, $product->description, $product->keywords);
		$this->setData(compact('product', 'mods', 'relProducts', 'photos', 'r_viewed', 'breadcrumbs'));
	}
}