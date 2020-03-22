<?php


namespace oclock;


class Router
{
	protected static $routes = [];
	protected static $route = [];

	public static function add($regexp, $route = [])
	{
		self::$routes[$regexp] = $route;
	}

	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function getRoute()
	{
		return self::$route;
	}

	public static function dispatch($url)
	{
		if ( self::matchRoute($url) ){
			$controllerName = self::camelCase(self::$route["controller"], true)."Controller";
			$action = self::camelCase(self::$route["action"])."Action";
			$prefix = self::camelCase(self::$route["prefix"]);
			$controller = "app\controllers\\{$prefix}{$controllerName}";
			if ( class_exists($controller) ){
				$controller = new $controller(self::$route);
				if ( method_exists($controller, $action) ){
					$controller->$action();
				} else {
					throw new \Exception("Экшен $controllerName::$action не найден", 404);
				}
			} else {
				throw new \Exception("Контроллер $controllerName не найден", 404);
			}
		} else {
			throw new \Exception("Страница не найдена", 404);
		}
	}

	protected static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route) {
			if ( preg_match("#{$pattern}#", $url, $matches) ){
				foreach ($matches as $key => $value) {
					if ( is_string($key) ){
						$route[$key] = $value;
					}
				}
				if ( !isset($route["action"]) ){
					$route["action"] = "index";
				}
				if ( !isset($route["prefix"]) ){
					$route["prefix"] = "";
				}
				else {
					$route["prefix"] .= "\\";
				}
				self::$route = $route;
				return true;
			}
		}
		return false;
	}

	protected static function camelCase($string, $upperfirst = false)
	{
		$words = explode("-", $string);
		$out = "";
		foreach ($words as $key => $word) {
			if ($key != 0 or ($key == 0 and $upperfirst)) {
				$out .= ucfirst($word);
			}
			else {
				$out .= $word;
			}
		}
		return $out;
	}
}