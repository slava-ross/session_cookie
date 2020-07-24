<?php

    if (empty($_SESSION['auth'])) {
        if (!empty($_COOKIE['user_login']) and !empty($_COOKIE['user_password'])) {
            $userLogin = $_COOKIE['user_login']; 
            $userPassword = $_COOKIE['user_password'];
            $redirectPage = $_COOKIE['current_page'];
            
            session_start(); 
            $_SESSION['auth'] = true; 
        }
        else {
            $redirectPage = '/auth.php';

        }
        header('HTTP/1.1 200 OK');
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $redirectPage);
        exit();
    }

setcookie("user_login", $userLogin, strtotime("+30 days"));
setcookie("user_password", $userPassword, strtotime("+30 days"));

            $key = md5 ( uniqid() );
                    setcookie("user_session", $key_session, time()+3600);
                    $_COOKIE['user_session'] = $key_session;
?>

