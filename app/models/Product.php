<?php


namespace app\models;


use app\models\app\AppModel;
use RedBeanPHP\R;

class Product extends AppModel
{
	public function setRecentlyViewed($id)
	{
		$recently = $this->getAllRecentlyViewed();
		if ($recently) {
			$recently = explode(',', $recently);
			if (!in_array($id, $recently)) {
				$recently[] = $id;
				$recently = implode(',', $recently);
				setcookie('recently_viewed', $recently, time() + 3600 * 24, "/");
			}
		} else {
			setcookie('recently_viewed', $id, time() + 3600 * 24, "/");
		}
	}

	public function getRecentlyViewed()
	{
		if (isset($_COOKIE['recently_viewed'])) {
			$recently_ids = explode(",", $_COOKIE['recently_viewed']);
			$recently_ids = (array_slice($recently_ids, -3));
			$recently_viewed = R::find('product', "`id` IN (" . R::genSlots($recently_ids) . ")", $recently_ids);
			$recently_viewed = array_reverse($recently_viewed, true);
			return $recently_viewed;
		}
		return null;
	}

	public function getAllRecentlyViewed()
	{
		if (isset($_COOKIE['recently_viewed'])) {
			return $_COOKIE['recently_viewed'];
		}
		return false;
	}
}