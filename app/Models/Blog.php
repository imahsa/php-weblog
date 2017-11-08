<?php
namespace App\Models;

use Zardak\Model;
use App\Models\User;

class Blog extends Model
{
	private static $table = 'blog';

	public static function getAllBlogs() {
		return Model::queryOn('blog,user')
			->constraint('blog.user_id', 'user.id')
			// ->limit(1,2)
			->get('*, blog.id as blog_id');

	}

	public static function getAllBlogsByCatId($catId) {
		return Model::queryOn('blog,user')
			->constraint('user_id', 'user.id')
			->where('category_id', $catId)
			->get();
	}

	public static function getByAddress($address){
		return Model::QueryOn(self::$table)
			->where('blog_address', $address)
			->first()
			->get();

	}

	public static function getBlogsByUserId($user_id){
		return Model::QueryOn(self::$table)
			->where('user_id', $user_id)
			->get();
	}

	/*public static function getBlogsByOffset($offset, $items_per_page) {
		return Model::queryOn('blog,user')
			->constraint('blog.user_id', 'user.id')
			->limit($offset,$items_per_page)
			->get('*, blog.id as blog_id');

	}*/

	public static  function createNewBlog($userId, $categoryId, $blogName, $blogAddress, $description, $header)
	{
		Model::QueryOn(self::$table)
			->insert(
				array(
					'user_id' 	=> $userId,
					'category_id' 	=> $categoryId,
					'blog_name' 	=> $blogName,
					'blog_address' 	=> $blogAddress,
					'description' 	=> $description,
					'header'		=> $header,
				)
			);
		//post num is 0 by default
	}

	public static function incresePostNum($id) {
		$blog = Model::queryOn(self::$table)
					->where('id', $id)
					->first()
					->get();

		Model::queryOn(self::$table)
			->where('id', $id)
			->update(array(
				'posts_num' => $blog->getPostsNum() + 1,
			));
	}

	public static function getIdByBlogAddress($address){
		$blog = getByAddress($address);
		return $blog ->getId();
	}

	public static function getCreatorById($id){
		$blog = Model::queryOn(self::$table)
					->where('id', $id)
					->first()
					->get();
		$user_id = $blog ->getUserId();

	}

}