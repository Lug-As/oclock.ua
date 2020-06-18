<?php


namespace app\controllers;


use RedBeanPHP\R;

class SearchController extends app\AppController
{
	public function indexAction()
	{
		debug($_GET['query']);
		die;
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
}