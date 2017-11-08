<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Models\Blog;
use App\Models\Category;
use App\Midlewares\Auth;

class New_Blog extends Controller
{
	public function __construct() {
		Auth::redirectIfNotLogin();
		Auth::loginIfRemember();
	}
	public function index() {
		//createing category xml 
		$categories = Category:: getAllCategories();
		$xml = '<newBlogPage>';
		$xml .= '<categories>'; 
		foreach ($categories as $cat){
			$xml .= '<cat>' .$cat ->getName() .'</cat>';
		}
		$xml .= '</categories>';
		$xml .= '</newBlogPage>';

		$views_chain = array(
            'new_blog' => array('xml' => $xml),
            'base' => array(
            	'title' => 'Create a New Blog',
            	'resources' => array(
            		'js/new_blog.js',
                    'style/css/new_blog.css',
        		),
            ),
        );
        $tpl = new Template($views_chain);
        $tpl->render();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        	$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			$user_id = $_SESSION['user_id'];
			$category = $this -> getField('category');
			$cat = Category:: getByName($category);
			$categoryId = $cat -> getId();
			$blogName = $this -> getField('blogName');
			$blogAddress = $this -> getField('blogAddress');
			$description = $this -> getField('description');  
			Blog:: createNewBlog($user_id, $categoryId, $blogName, $blogAddress, $description, $target_file);
        }
	}
}