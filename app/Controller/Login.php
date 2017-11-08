<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
use App\Midlewares\Auth;

class Login extends Controller
{
	public function __construct() {
		Auth::login('blogs');
	}

    public function index()
    {
        $views_chain = array(
            'login',
            'base' => array(
            	'title' => 'Login',
                'resources' => array(
                    'style/css/login.css',
                ),
            ),
        );

        $tpl = new Template($views_chain);
        $tpl->render();
    }
}