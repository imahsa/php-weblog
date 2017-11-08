<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Category;
use App\Midlewares\Auth;

class Blogs extends Controller
{
	public function __construct() {
		Auth::loginIfRemember();
	}
	public function index($cat = null) {
		if(!$cat){
			$blogs = Blog::getAllBlogs();
			$categories = Category:: getAllCategories();
			//creating xml for Blogs
			$xml = $this->createBlogsXml($blogs, $categories);

			$views_chain = array(
	            'blogs' => array('xml' => $xml),
	            'base' => array(
	            	'title' => 'View All Blogs',
	            	'resources' => array(
	            		'js/blogs.js',
	            		'style/css/blogs.css',
	        		),
	            ),
	        );

	        $tpl = new Template($views_chain);
	        $tpl->render();
    	}
        else {
        	$category = Category::getByName($cat);
        	$catId = $category->getId();
        	if($catId == 1){
        		$blogs = Blog::getAllBlogs();
        	}
        	else{
	       		$blogs = Blog::getAllBlogsByCatId($catId);
	    	}
			$categories = Category:: getAllCategories();
			//creating xml for Blogs
			$xml = $this->createBlogsXml($blogs, $categories, $cat);

			$views_chain = array(
	            'blogs' => array('xml' => $xml),
	            'base' => array(
	            	'title' => 'View All Blogs',
	            	'resources' => array(
	            		'js/blogs.js',
	            		'style/css/blogs.css',
	        		),
	            ),
	        );

	        $tpl = new Template($views_chain);
	        $tpl->render();
        }
	}

	function createBlogsXml($blogs, $categories, $cat = null){
		$xml = '<blogsPage>';
		$xml .= '<categories>'; 
		$xml .= '<selected>' . ($cat ? $cat : 'All') . '</selected>';
		foreach ($categories as $cat){
			$xml .= '<cat>' .$cat ->getName() .'</cat>';
		}
		$xml .= '</categories>'; 
		$xml .= '<blogs>';
		foreach ($blogs as $blog) {
			$xml .= '<blog>';
				$xml .= '<name>' .$blog ->getBlogName() . '</name>';
				$xml .= '<author>' .$blog ->getUserName() . '</author>';
				$xml .= '<description>' .$blog ->getDescription() . '</description>';
				$xml .= '<postnum>' .$blog ->getPostsNum() . '</postnum>';
			$xml .= '</blog>';
		}
		$xml .= '</blogs>';
		$xml .= '</blogsPage>';
		return $xml;
	}
}