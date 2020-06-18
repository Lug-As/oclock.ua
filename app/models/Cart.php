<?php


namespace app\models;


class Cart extends app\AppModel
{
	public function add($product, $qty = 1, $mod = null)
	{
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}
		$cart = &$_SESSION['cart'];
		if (!isset($cart['list'])) {
			$cart['list'] = [];
		}
		if (!isset($cart['qty'])) {
			$cart['qty'] = 0;
		}
		if (!isset($cart['sum'])) {
			$cart['sum'] = 0;
		}
		$cart_key = $product->id;
		$cart_product = [
			'title' => $product->title,
			'alias' => $product->alias,
			'qty' => $qty,
			'img' => $product->img,
		];
		if ($mod) {
			$cart_key .= "-{$mod->id}";
			$cart_product['title'] .= " ({$mod->title})";
			$cart_product['mod_id'] = $mod->id;
			$cart_product['price'] = $mod->price;
		} else {
			$cart_product['price'] = $product->price;
		}
		if (!isset($cart['list'][$cart_key])) {
			$cart['list'][$cart_key] = $cart_product;
		} else {
			$cart['list'][$cart_key]['qty'] += $qty;
		}
		$cart['sum'] += ($mod ? $mod->price : $product->price) * $qty;
		$cart['qty'] += $qty;
	}

	public function remove($id)
	{
		$cart = &$_SESSION['cart'];
		$product = $cart['list'][$id];
		$cart['qty'] -= $product['qty'];
		$cart['sum'] -= $product['qty'] * $product['price'];
		unset($cart['list'][$id]);
	}

	public function clear()
	{
		if (isset($_SESSION['cart'])) {
			unset($_SESSION['cart']);
		}
	}
}