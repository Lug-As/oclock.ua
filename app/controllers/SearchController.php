<?php


namespace app\controllers;


use app\controllers\app\AppController;
use app\widgets\pagination\Pagination;
use oclock\App;
use RedBeanPHP\R;

class SearchController extends AppController
{
	public function indexAction()
	{
		if (isset($_GET['query'])) {
			$query = trim($_GET['query']);
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			$perpage = App::$app->getProperty('pagination');
			$total = R::count('product', '`title` LIKE ?', ['%' . $query . '%']);
			$pagination = new Pagination($page, $perpage, $total);
			$offset = $pagination->getOffset();
			$products = R::find('product', '`title` LIKE ? LIMIT ? OFFSET ?', ['%' . $query . '%', $perpage, $offset]);
		} else {
			$query = '';
			$products = [];
		}
		$this->setData(compact('query', 'products', 'pagination'));
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