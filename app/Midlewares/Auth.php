<?php
namespace App\Midlewares;
use App\Models\User;

class Auth {
    public static function loginWithTokenAndRedirect($token, $redirect_url_in_success = null, $remember_me = true)
    {
        $login_session_key = getenv('SESSION_ADMIN_KEY');
        $url = getenv('URL');

        if (isset($_SESSION[$login_session_key]) && $_SESSION[$login_session_key]) {
            header('location:' . $url . $redirect_url_in_success);
        }
        elseif (!isset($_SESSION[$login_session_key]) || !$_SESSION[$login_session_key]) {
            if (isset($token)) {
                $user = User::getUserByToken($token);
                if ($user) {
                    self::initSession($user);
                    if($remember_me) {
                        self::RememberMe($user->getId());
                    }
                    header('location:' . $url . $redirect_url_in_success);
                }
                else
                    header('location:' . $url . 'notification/invalidToken');
            }
        }
        else
            header('location:' . $url . 'notification/invalidToken');
    }

    public static function showIfLoginAsAdmin()
    {
        if (
            !isset($_SESSION['is_admin']) || 
            !$_SESSION['is_admin']
        ) {
            header('location:http://kdowlati.ir/login');
            die();
        }
    }

    public static function login($redirect_to = null)
    {
        if (!self::isLogin() && !self::loginIfRemember()) {
            $user_name  = isset($_POST['user_name']) && !empty($_POST['user_name']) ? $_POST['user_name'] : false;
            $password   = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : false;
            $remember_me= isset($_POST['remember_me']) && !empty($_POST['remember_me']) ? $_POST['remember_me'] : false;
            if ($user_name != false && $password != false) {
                if ($user = User::checkUser($user_name, $password)) {
                    if ($remember_me) {
                        self::RememberMe($user->getId());
                    }
                    self::initSession($user);
                    header('location:' . getenv('URL') . $redirect_to);
                    die();
                }
                else {
                    header('location:' . getenv('URL') . 'login');
                    die();
                }
            }
        }
        else {
            header('location:' . getenv('URL') . $redirect_to);
            die();
        }
    }

    public static function redirectIfNotLogin()
    {
        $login_session_key = getenv('SESSION_KEY_LOGIN');
        $url = getenv('URL');

        if (
            (isset($_SESSION[$login_session_key]) && $_SESSION[$login_session_key]) ||
            (!isset($_SESSION[$login_session_key]) && self::loginIfRemember())
        ) //user is logged in
        {
            return true;
        }
        else {
            header('location:' . $url . 'login');
            die();
        }
    }

    public static function loginIfRemember()
    {
        $cookie_key = getenv('COOKIE_KEY_REMEMBER_ME');
        if (isset($_COOKIE[$cookie_key])) {
            $user = User::getUserByCookie($_COOKIE[$cookie_key]);
            if ($user) {
                self::initSession($user);
                return true;
            }
        }
        return false;
    }

    private static function rememberMe($user_id)
    {
        $cookie = null;
        $cookie_key = getenv('COOKIE_KEY_REMEMBER_ME');
        
        do {
            $cookie = self::generateToken(64);
        } while(!User::isValidCookie($cookie));

        User::updateCookie($user_id, $cookie);
        setcookie($cookie_key, $cookie, time() + 60*60*24*30, '/');
    }

    public static function generateToken($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $token;
    }

    /**
     * @param $user Record
     */
    private static function initSession($user)
    {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['name'] = $user->getName();
        $_SESSION['SESSION_KEY_LOGIN'] = true;
    }

    public static function logout($redirect_to = null)
    {
        if (isset($_SESSION['SESSION_KEY_LOGIN']) && $_SESSION['SESSION_KEY_LOGIN']) {
            $cookie_key = getenv('COOKIE_KEY_REMEMBER_ME');
            session_unset();
            setcookie($cookie_key,'', -1, '/');
            header('location:' . getenv('URL') . $redirect_to);
            die();
        }
        else {
            header('location:' . getenv('URL') . 'login');
        }
    }

    public static function isLogin() {
        return isset($_SESSION['SESSION_KEY_LOGIN']) && $_SESSION['SESSION_KEY_LOGIN'];
    }
}
