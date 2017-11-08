<?php
namespace App\Models;

use Zardak\Model;
use Damev\Damev;

class Comment extends Model
{	
	private static $table = 'Comment';

	public static function getById($id)
	{
		return Model::QueryOn(self::$table)
			->where('id', $id)
			->first()
			->get();
	}

	
	public static function getByPostId($id)
	{
		return Model::QueryOn(self::$table)
			->where('post_id', $id)
			->orderBy('id', 'desc')
			->get();
	}

	public static function createNewComment($post_id, $creator_name, $content){
		$id = Model::QueryOn(self::$table)
			->insert(
				array(
					'post_id' 	=> $post_id,
					'creator_name' 	=> $creator_name,
					'content' 	=> $content,
					'date'		=> date('M j, Y'),
				)
			);

		if ($id) {
			Post::increseCommentsNum($post_id);
		}
	}
	
}

?>