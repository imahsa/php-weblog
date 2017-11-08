<?php
namespace App\Controller;

use Zardak\Controller;
use App\Midlewares\Auth;

class Logout extends Controller
{
    public function index()
    {
        Auth::logout('blogs');
    }
}