<?php
    session_start();
    if (!empty($_SESSION['auth'])) {
        $redirectPage = $_COOKIE['current_page'];
    }
    else {
        $redirectPage = '/auth.php';
    }
    header('HTTP/1.1 200 OK');
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $redirectPage);
?>