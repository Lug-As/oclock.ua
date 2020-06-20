<?php


namespace app\models;


use app\models\app\AppModel;
use oclock\App;

class Category extends AppModel
{
	public function getIds($id): array
	{
		$cats = App::$app->getProperty('category');
		$out = $this->getParts($cats, $id);
		$out[] = $id;
		return $out;
	}

	protected function getParts($cats, $id): array
	{
		$out = [];
		foreach ($cats as $cat_id => $cat) {
			if ($cat['parent_id'] == $id) {
				$out[] = $cat_id;
			}
		}
		if ($out) {
			foreach ($out as $item) {
				$out = array_merge($out, $this->getParts($cats, $item));
			}
		}
		return $out;
	}
}