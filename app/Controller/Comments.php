<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Post;
use App\Models\Comment;
use App\Midlewares\Auth;

class Comments extends Controller
{
	public function __construct() {
		Auth::loginIfRemember();
	}
	public function index($blog_address, $post_hash) {
		$views_chain = array(
            'comment' => array('blog_address' => $blog_address,
            					'post_hash' => $post_hash
            ),
            'base' => array(
            	'title' => 'Comment to Post',
            	'resources' => array(
            		'style/css/comments.css',

        		),
            ),
        );

		$tpl = new Template($views_chain);
        $tpl->render();

		// get the post_id with this hash
		$post = Post::getPostByHash($post_hash);
		$post_id = $post -> getId();
		
		// create new comment for this post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$creator_name =  $this -> getField('name');
			$content =  $this -> getField('content');
			Comment::createNewComment($post_id, $creator_name, $content);
		}
	}

}

?>