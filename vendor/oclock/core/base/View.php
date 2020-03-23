<?php


namespace oclock\base;


use oclock\App;

class View
{
	protected $route;
	protected $model;
	protected $view;
	protected $controller;
	protected $prefix;
	protected $layout;
	protected $data = [];
	protected $meta = [];

	public function __construct($route, $layout = "", $view = "", $meta = "")
	{
		$this->route = $route;
		$this->model = $route['controller'];
		$this->view = $route['action'];
		$this->controller = $route['controller'];
		$this->prefix = $route['prefix'];
		$this->meta = $meta;
		if ($layout !== false) {
			$this->layout = $layout ?: LAYOUT;
		} else {
			$this->layout = false;
		}
	}

	public function render($data)
	{
		$viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
		if ( file_exists($viewFile) ){
			ob_start();
			require $viewFile;
			$content = ob_get_clean();
		} else {
			throw new \Exception("Не найден вид {$viewFile}", 500);
		}
		if ($this->layout !== false){
			$layoutFile = APP."/views/layouts/{$this->layout}.php";
			if ( file_exists($layoutFile) ){
				require $layoutFile;
			} else {
				throw new \Exception("Не найден шаблон {$layoutFile}", 500);
			}
		}
	}
}