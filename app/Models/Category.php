<?php
namespace App\Models;

use Zardak\Model;

class Category extends Model
{
	private static $table = 'category';

	public static function getAllCategories() {
		return Model::queryOn(self::$table)
			->get();
	}

	public static function getByName($catName) {
		return Model::queryOn(self::$table)
			->where('name', $catName)
			->first()
			->get();
	}
}