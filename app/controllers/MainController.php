<?php


namespace app\controllers;


use app\controllers\app\AppController;
use oclock\App;
use oclock\Cache;
use RedBeanPHP\R;

class MainController extends AppController
{
	public function indexAction()
	{
	    $brands = R::find('brand', 'LIMIT 3');
	    $hits = R::find('product', "`hit` = '1' AND `status` = '1' LIMIT 8");
	    $this->setData( compact('brands', 'hits') );
		$this->setMeta(App::$app->getProperty('shop_name'), "Магазин часов", 'Часы');
	}
}