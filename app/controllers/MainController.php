<?php


namespace app\controllers;


use app\controllers\app\AppController;
use oclock\App;

class MainController extends AppController
{
	public function indexAction()
	{
		$name = 'Bogdan';
		$age = 19;
		$this->setData( compact('name', 'age') );
		$this->setMeta(App::$app->getProperty('shop_name'), "Магазин часов", ['Часы']);
	}
}