<?php


namespace app\models\app;


use oclock\base\Model;
use app\widgets\currency\Currency;
use oclock\App;
use oclock\Cache;
use RedBeanPHP\R;

class AppModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        App::$app->setProperty('currencies', Currency::getCurrencies());
	    App::$app->setProperty('currency', Currency::getActiveCurrency( App::$app->getProperty('currencies') ));
	    App::$app->setProperty('cats', self::cacheCategory());
    }

    public static function cacheCategory()
    {
        $cats = Cache::get('categories');
        if (!$cats) {
            $cats = R::getAssoc("SELECT * FROM `category`");
            Cache::set('categories', $cats);
            $cats['data'] = $cats;
        }
        return $cats['data'];
    }
}