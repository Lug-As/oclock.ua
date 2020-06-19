<?php


namespace app\controllers\app;


use app\models\app\AppModel;
use app\models\User;
use app\widgets\currency\Currency;
use oclock\App;
use oclock\base\Controller;
use oclock\Cache;
use RedBeanPHP\R;

class AppController extends Controller
{
	public function __construct($route)
	{
		parent::__construct($route);
		new AppModel();
		User::authentication();
		App::$app->setProperty('currencies', Currency::getCurrencies());
		App::$app->setProperty('currency', Currency::getActiveCurrency(App::$app->getProperty('currencies')));
		App::$app->setProperty('category', self::cacheCategory());
	}

	public static function cacheCategory()
	{
		$cats = Cache::get('categories');
		if (!$cats) {
			$cats = R::getAssoc("SELECT * FROM `category`");
			Cache::set('categories', $cats);
		}
		return $cats;
	}
}