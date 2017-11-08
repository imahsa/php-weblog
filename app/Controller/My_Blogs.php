<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Category;
use App\Midlewares\Auth;

class My_Blogs extends Controller
{
	public function __construct() {
		Auth::redirectIfNotLogin();
		Auth::loginIfRemember();
	}

	public function index($cat = null) {

	$user_id = $_SESSION['user_id'];
	$xml = $this->createMyBlogsXml($user_id);
	$views_chain = array(
            'my_blogs' => array('xml' => $xml),
            'base' => array(
            	'title' => 'My Blogs',
            	'resources' => array(
            		'js/my_blogs.js',
            		'style/css/my_blogs.css',
        		),
            ),
        );

        $tpl = new Template($views_chain);
        $tpl->render();

	}

	public function createMyBlogsXml($user_id){
		$blogs = Blog::getBlogsByUserId($user_id);
		$xml = '<myBlogsPage>';
		$xml .= '<myBlogs>';
		foreach ($blogs as $blog) {
			$xml .= '<blog>';
				$xml .= '<name>' .$blog ->getBlogName() . '</name>';
				$xml .= '<description>' .$blog ->getDescription() . '</description>';
				$xml .= '<postnum>' .$blog ->getPostsNum() . '</postnum>';
			$xml .= '</blog>';
		}
		$xml .= '</myBlogs>';
		$xml .= '</myBlogsPage>';
		return $xml;

	}
}

?>