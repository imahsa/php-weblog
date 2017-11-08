<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Category;
use App\Midlewares\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class View extends Controller
{
	public function __construct() {

		Auth::loginIfRemember();
	}
	public function index($blog_address, $page = null, $post_hash = null) {
		if(($post_hash == null)){
			// show the weblog with this $blog_address posts
			$xml = $this->createBlogPostsXml($blog_address, $page);
			$views_chain = array(
            'view_blog' => array('xml' => $xml),
            'base' => array(
            	'title' => $blog_address,
            	'resources' => array(
            		'js/view_blog.js',
            		'style/css/view_blog.css',

        		),
            ),
        );
			$tpl = new Template($views_chain);
       		$tpl->render();
		}

		else if (($page == 0) && ($post_hash != null)){
			//show the weblog with this $blog_address and this $post_hash, post
			$xml = $this->createPostXml($blog_address, $post_hash);
			$post = Post::getPostByHash($post_hash);
			$post_title = $post ->getTitle();
			$title = $blog_address . ' | ' .$post_title;
			$views_chain = array(
            'view_post' => array('xml' => $xml),
            'base' => array(
            	'title' => $title,
            	'resources' => array(
            		'js/view_post.js',
            		'style/css/view_post.css',
        		),
            ),
        );
			$tpl = new Template($views_chain);
       		$tpl->render();
		}
	}

	public  function createBlogPostsXml($blog_address, $page_num){
		$items_per_page = 2;
		$offset = 0; 
		if($page_num == null)
			$page = 1;
		else
			$page = $page_num;
		$blog = Blog::getByAddress($blog_address);
		$posts_num = $blog ->getPostsNum();
		$blog_id = $blog ->getId();
		$author_id = $blog ->getUserId();
		$author_name = User::getNameById($author_id);
		$offset = ($page - 1) * $items_per_page; 
		$posts = Post::getAllPostsByOffset($blog_id, $offset, $items_per_page);
		$number_of_pages =ceil($posts_num/2);
		$more = false;
		$xml = '<blogPostsPage>';
		$xml .= '<blogAddress>' . $blog_address . '</blogAddress>';
		$xml .= '<number_of_pages>' . $number_of_pages . '</number_of_pages>';
		$xml .= '<page>' . $page . '</page>';
		$xml .= '<posts>';
		foreach ($posts as $post) {
			if(strlen($post ->getContent()) > 20){
				$more = true; 
			}
			else{
				$more = false;
			}

			$xml .= '<post>';
				$xml .= '<title>' .$post ->getTitle() . '</title>';
				$xml .= '<content>' . substr($post ->getContent(), 0, 20) . '</content>';
				$xml .= '<author>' . 'By ' .$author_name . '</author>';
				$xml .= '<date>' .$post ->getDate() . '</date>';
				$xml .= '<commentsNum>' .$post ->getCommentsNum() . '</commentsNum>';
				$xml .= '<hash>' .$post ->getHash() . '</hash>';
				$xml .= '<more>' . $more . '</more>';
			$xml .= '</post>';
		}
		$xml .= '</posts>';
		$xml .= '</blogPostsPage>';
		return $xml;
	}

	public  function createPostXml($blog_address, $post_hash){
		$blog = Blog::getByAddress($blog_address);
		$blog_id = $blog ->getId();
		$author_id = $blog ->getUserId();
		$author_name = User::getNameById($author_id);
		$post = Post::getPostByHash($post_hash);
		$post_id = $post ->getId();
		$comments = Comment::getByPostId($post_id);

		$xml = '<c>';
		$xml .= '<postPage>';
		$xml .= '<blogAddress>' . $blog_address . '</blogAddress>';
		$xml .= '<post>';
				$xml .= '<title>' .$post ->getTitle() . '</title>';
				$xml .= '<content>' .$post ->getContent() . '</content>';
				$xml .= '<author>' . 'By ' .$author_name . '</author>';
				$xml .= '<date>' .$post ->getDate() . '</date>';
				$xml .= '<commentsNum>' .$post ->getCommentsNum() . '</commentsNum>';
				$xml .= '<hash>' .$post ->getHash() . '</hash>';
		$xml .= '</post>';
		$xml .= '</postPage>';

		$xml .= '<comments>';
		foreach ($comments as $comment) {
			$xml .= '<comment>';
				$xml .= '<author>' .$comment ->getCreatorName() . '</author>';
				$xml .= '<content>' .$comment ->getContent() . '</content>';
				$xml .= '<date>' .$comment ->getDate() . '</date>';
			$xml .= '</comment>';
		}
		$xml .= '</comments>';
		$xml .= '</c>';

		return $xml;
	}

}