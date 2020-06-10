<?php


namespace app\controllers;


use app\controllers\app\AppController;
use oclock\App;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $code = $_GET['curr'] ?? null;
        if ($code) {
            $all_currencies = App::$app->getProperty('currencies');
            if ( array_key_exists($code, $all_currencies) ){
                setcookie('currency', $code, time()+60*60*24*30, "/");
            }
        }
        redirect();
    }

    public static function getPriceString($price)
    {
        $curr = App::$app->getProperty('currency');
        $out = $curr['symbol_left'] . round($price * $curr['value']) . $curr['symbol_right'];
        return $out;
    }
}