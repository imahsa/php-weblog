<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Post;
use App\Midlewares\Auth;

class New_Post extends Controller
{
	public function __construct() {
		Auth::redirectIfNotLogin();
		Auth::loginIfRemember();
	}
	public function index($blog_address) {
		$views_chain = array(
            'new_post' => array('blog_address' => $blog_address),
            'base' => array(
            	'title' => 'Create a New Post',
            	'resources' => array(
                    'style/css/new_post.css',
        		),
            ),
        );

		$tpl = new Template($views_chain);
        $tpl->render();

		// get the blog_id with this address
		$blog = Blog::getByAddress($blog_address);
		$blog_id = $blog -> getId();
		
		// create new post for this blog
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$title =  $this -> getField('title');
			$content =  $this -> getField('content');
			Post::createNewPost($blog_id, $title, $content);
		}
	}

}