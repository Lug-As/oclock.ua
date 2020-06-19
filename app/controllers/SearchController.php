<?php


namespace app\controllers;


use RedBeanPHP\R;

class SearchController extends app\AppController
{
	public function indexAction()
	{
		if (isset($_GET['query'])) {
			$query = trim($_GET['query']);
			$products = R::find('product', '`title` LIKE ?', ['%' . $query . '%']);
		} else {
			$query = '';
			$products = [];
		}
		$this->setData(compact('query', 'products'));
		$this->setMeta('Поиск по запросу "' . safeHtmlChars($query) . '"');
	}

	public function previewAction()
	{
		if ($this->isAjax() and isset($_GET['query']) and trim($_GET['query'])) {
			$query = trim($_GET['query']);
			$products = R::getAll('SELECT `id`, `title` FROM `product` WHERE `title` LIKE ? LIMIT 11', ["%{$query}%"]);
			echo json_encode($products);
		}
		$this->dieOrGoAway();
	}

	public static function getMatchedString($str, $query)
	{
		$str = str_ireplace($query, "<span style='color: #2979ff'>{$query}</span>", $str);
		return $str;
	}
}