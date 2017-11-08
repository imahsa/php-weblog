<?php
namespace App\Models;

use Zardak\Model;
use App\Models\Blog;

class Post extends Model
{
	private static $table = 'post';

	public static  function createNewPost($blogId, $title, $content)
	{
		$date = date('Y_m_d');
		$hash = $date . '_' . str_replace(' ', '_', $title);
		$id = Model::QueryOn(self::$table)
			->insert(
				array(
					'blog_id' 	=> $blogId,
					'title' 	=> $title,
					'content' 	=> $content,
					'hash'		=> $hash,
					'date'		=> date('M j, Y'),
				)
			);

		if ($id) {
			Blog::incresePostNum($blogId);
		}
	}

	public static  function getAllPostsByBlogId($blog_id){
		return Model::QueryOn(self::$table)
					->where('blog_id', $blog_id)
					->get();
	}

	public static  function getAllPostsByOffset($blog_id, $offset, $items_per_page){
		return Model::QueryOn(self::$table)
					->where('blog_id', $blog_id)
					->limit($offset,$items_per_page)
					->get();
	}

	public static  function getPostByHash($hash){
		return Model::QueryOn(self::$table)
					->where('hash', $hash)
					->first()
					->get();
	}

		public static function increseCommentsNum($id) {
		$post = Model::queryOn(self::$table)
					->where('id', $id)
					->first()
					->get();

		Model::queryOn(self::$table)
			->where('id', $id)
			->update(array(
				'comments_num' => $post->getCommentsNum() + 1,
			));
	}


}