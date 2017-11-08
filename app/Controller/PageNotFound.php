<?php
namespace App\Controller;

class PageNotFound
{
    public static function index()
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 ERROR!</h1>";
    }
}