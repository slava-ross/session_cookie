<?php
    session_start();
    // Переменная auth существует и равна true (сессия активна и пользователь прошёл аутентификацию), а также qookie текущей страницы не просрочена.
    if (!empty($_SESSION['auth']) && !empty($_COOKIE['current_page'])) {
        $redirectPage = $_COOKIE['current_page'];
    }
    else {
        $redirectPage = '/auth.php';
    }
    header('HTTP/1.1 200 OK');
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $redirectPage);
?>