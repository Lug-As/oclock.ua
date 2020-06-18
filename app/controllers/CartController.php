<?php


namespace app\controllers;


use app\models\Cart;
use RedBeanPHP\R;

class CartController extends app\AppController
{
	public function addAction()
	{
		if (!isset($_GET['id'])) {
			$this->dieOrGoAway();
		}
		$id = (int)trim($_GET['id']);
		$mod_id = isset($_GET['mod']) ? (int)trim($_GET['mod']) : 0;
		$qty = isset($_GET['qty']) ? (int)trim($_GET['qty']) : 1;
		$product = R::findOne('product', '`id` = ?', [$id]);
		if (!$product) {
			$this->dieOrGoAway();
		}
		$mod = null;
		if ($mod_id) {
			$mod = R::findOne('modification', '`id` = ?', [$mod_id]);
		}
		$cart = new Cart();
		$cart->add($product, $qty, $mod);
		$this->viewOrGoAway("cart_modal");
	}

	public function deleteAction()
	{
		if (!isset($_GET['id'])) {
			$this->dieOrGoAway();
		}
		$id = trim($_GET['id']);
		if (isset($_SESSION['cart']['list'][$id])) {
			$cart = new Cart();
			$cart->remove($id);
		}
		$this->viewOrGoAway("cart_modal");
	}

	public function clearAction()
	{
		$cart = new Cart();
		$cart->clear();
		$this->viewOrGoAway("cart_modal");
	}

	public function showAction()
	{
		$this->viewOrGoAway("cart_modal");
	}
}