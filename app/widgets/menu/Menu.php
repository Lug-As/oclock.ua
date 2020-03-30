<?php


namespace app\widgets\menu;


use oclock\App;
use oclock\Cache;
use RedBeanPHP\R;

class Menu
{
    protected $data;
    protected $tree;
    protected $tpl;
    protected $table = "category";
    protected $html;
    protected $container = "ul";
    protected $cache = 3600;
    protected $cacheKey = "oclock_main_menu";
    protected $attrs = [];
    protected $prepend = "";

    public function __construct(array $options = [])
    {
        $this->tpl = __DIR__ . "/template/menu_tpl.php";
        $this->setOptions($options);
        $this->run();
    }

    protected function run()
    {
        $this->html = Cache::get($this->cacheKey);
        if (!$this->html) {
            $this->data = App::$app->getProperty("cats");
            if (!$this->data){
                $this->data = R::getAssoc("SELECT * FROM `category`");
            }
        }
        $this->getHtml($this->tree);
        $this->output();
    }

    protected function getTree()
    {
        $tree = [];
    }

    protected function getHtml($tree, $tab = "")
    {

    }

    protected function singleHtml($category, $tab, $id)
    {

    }

    protected function setOptions(array $options = [])
    {
        foreach ($options as $key => $option) {
            if ( property_exists($this, $key) ){
                $this->$key = $option;
            }
        }
    }

    protected function output()
    {
        echo $this->html;
    }
}