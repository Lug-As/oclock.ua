<?php


namespace app\widgets\menu;


use oclock\App;
use oclock\Cache;
use RedBeanPHP\R;

class Menu
{
    protected $data;
    protected $tree;
    protected $html;
    protected $tpl;
    protected $table = "category";
    protected $container = "ul";
    protected $containerClass = "menu";
    protected $attrs = [];
    protected $cache = 3600;
    protected $cacheKey = "oclock_main_menu";
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
            $this->data = App::$app->getProperty($this->table);
            if (!$this->data) {
                $this->data = R::getAssoc("SELECT * FROM ?", [$this->table]);
            }
            $this->tree = $this->getTree();
            $this->html = $this->getHtml($this->tree);
            if ($this->cache > 0) {
                Cache::set($this->cacheKey, $this->html, $this->cache);
            }
        }
        $this->output();
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$item) {
            if (!$item['parent_id']) {
                $tree[$id] = &$item;
            } else {
                $data[$item['parent_id']]['childs'][$id] = &$item;
            }
        }
        return $tree;
    }

    protected function getHtml($tree, $tab = "")
    {
        $out = "";
        foreach ($tree as $key => $item) {
            $out .= $this->singleHtml($item, $tab, $key);
        }
        return $out;
    }

    protected function singleHtml($category, $tab, $id)
    {
        ob_start();
        include $this->tpl;
        return ob_get_clean();
    }

    protected function setOptions(array $options = [])
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, $key)) {
                $this->$key = $option;
            }
        }
    }

    protected function output()
    {
        $attrs = '';
        if (!empty($this->attrs)) {
            foreach ($this->attrs as $key => $attr) {
                $attrs .= "{$key}='$attr' ";
            }
        }
        $attrs = trim($attrs);
        echo "<{$this->container} class='{$this->containerClass}' {$attrs}>";
        echo $this->prepend;
        echo $this->html;
        echo "</{$this->container}>";
    }
}