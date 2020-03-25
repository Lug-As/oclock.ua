<?php


namespace app\controllers;


use app\controllers\app\AppController;
use oclock\App;
use oclock\Cache;

class MainController extends AppController
{
	public function indexAction()
	{
	    $posts = \RedBeanPHP\R::findAll('post');
		$name = 'Bogdan';
		$age = 19;
		$this->setData( compact('name', 'age', 'posts') );
		$this->setMeta(App::$app->getProperty('shop_name'), "Магазин часов", ['Часы']);
	}
}