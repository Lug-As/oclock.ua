<?php


namespace app\widgets\currency;


use oclock\App;
use RedBeanPHP\R;

class Currency
{
    protected $tpl;
    protected $currencies;
    protected $currency;

    public function __construct()
    {
        $this->tpl = __DIR__ . "/tpl/currency_tpl.php";
        $this->run();
    }

    protected function run()
    {
        $this->currencies = App::$app->getProperty('currencies');
        $this->currency = App::$app->getProperty('currency');
        echo $this->getHtml();
    }

    public static function getCurrencies()
    {
        $curr = R::getAssoc("SELECT `code`, `title`, `symbol_left`, `symbol_right`, `value`, `base` FROM `currency` ORDER BY `base` DESC");
        return $curr;
    }

    public static function getActiveCurrency($currencies)
    {
        if ( isset($_COOKIE['currency']) and array_key_exists($_COOKIE['currency'], $currencies) ){
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies);
        }
        $curr = $currencies[$key];
        $curr['code'] = $key;
        return $curr;
    }

    protected function getHtml()
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}