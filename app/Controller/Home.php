<?php
namespace App\Controller;

use Zardak\Controller;
use Zardak\Template;
class Home extends Controller
{
    public function index() {
        $views_chain = array(
            'home',
            'base' => array(
                'title' => 'خانه',
            ),
        );
        $tpl = new Template($views_chain);
        $tpl->render();
    }
}