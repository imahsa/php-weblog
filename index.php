<?php
/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

require __DIR__ . '/bootstrap/autoload.php';
session_name('sec_session_id');
session_start();
$app = require_once __DIR__ . '/bootstrap/app.php';