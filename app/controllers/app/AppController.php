<?php


namespace app\controllers\app;


use app\models\app\AppModel;
use oclock\base\Controller;
use app\widgets\currency\Currency;
use oclock\App;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        $currencies = Currency::getCurrencies();
        $curr = Currency::getActiveCurrency($currencies);
	    App::$app->setProperty('currencies', $currencies);
	    App::$app->setProperty('currency', $curr);
    }
}