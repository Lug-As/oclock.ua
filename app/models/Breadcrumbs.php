<?php


namespace app\models;


use app\models\app\AppModel;
use oclock\App;

class Breadcrumbs extends AppModel
{
	public static function getBreadcrumbs($category_id, $title = "")
	{
		$cats = App::$app->getProperty('category');
		$breadcrumbs_array = self::getParts($cats, $category_id);
		$breadcrumbs = implode("", $breadcrumbs_array);
		if ($title) {
			$breadcrumbs .= "<li class='active'>" . $title . "</li>";
		}
		return $breadcrumbs;
	}

	protected static function getParts($cats, $id)
	{
		if (!isset($cats[$id])) {
			return false;
		}
		$out = [];
		$category = $cats[$id];
		$parent = $category['parent_id'];
		$go = true;
		while ($go) {
			$out[] = "<li><a href='category/{$category['alias']}'>{$category['title']}</a></li>";
			if ($category['parent_id'] != 0 and isset($cats[$parent])) {
				$category = $cats[$parent];
				$parent = $category['parent_id'];
			} else {
				$go = false;
			}
		}
		$out = array_reverse($out);
		return $out;
	}
}