<?php
    const DEFAULT_REDIRECT_PAGE = '/page_a.php';
    $errors = array();
    if (!session_start()) {
        exit('<p class="message error">Сессия не запустилась</p>'); // it was for debug
    }

    // Была отправлена форма аутентификации
    if (isset($_POST['submit'])) {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        if (empty($login)) {
            $errors[] = "Укажите Ваш логин!";
        }
        if (empty($password)) {
            $errors[] = "Укажите Ваш пароль!";
        }
        if (count($errors) === 0) {
            /*
             * Новый пользователь (регистрация) или незарегистрированный (другой) пользователь
             */
            if (empty($_COOKIE['user_login']) || $_COOKIE['user_login'] !== $login) {
                if (!empty($_POST['remember'])) {
                    setcookie('user_login', $login, time()+3600);
                    setcookie('user_password', password_hash($password, PASSWORD_DEFAULT), time()+3600);
                }
                setcookie('current_page', DEFAULT_REDIRECT_PAGE, time()+3600);
                $_SESSION['auth'] = true;
                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . DEFAULT_REDIRECT_PAGE);
                exit();
            } else {
                /* Зарегистрированный пользователь
                 * Если qookie имени пользователя существует и соответствует логину - проверяем
                 * хэш пароля для подтверждения аутентичности пользователя. Можно использовать
                 * информацию в файлах или базе данных.
                 */
                /*if (password_verify($password, $_COOKIE['user_password'])) {
                    $errors[] = "Неверный пароль!";
                    //$_SESSION['auth'] = false;
                } else {*/
                    $_SESSION['auth'] = true;
                    header('HTTP/1.1 200 OK');
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_COOKIE['current_page']);
                    exit();
                //}
            }
        }
    }
    /*
     * Вызов был не при отправке формы - для совершения аутентификации или выхода.
     * Если в GET-запросе передан флаг выхода - завершение сессии и удаление пользовательской информации (qookies).
     */ 
    if (!empty($_GET['logout'])) {
        setcookie('user_login', '', time()-60);
        setcookie('user_password', '', time()-60);
        setcookie('current_page', '', time()-60);
        session_unset();
        session_destroy();
    }
?>
<!-- Форма аутентификации пользователя -->
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Authorisation</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <main>
            <div class="forms">
                <form method="post">
                    <p>
                        <label>
                            <b>Логин:</b><br>
                            <input type="text" name="login" value="<?php if( isset($_POST['login']) ) print $_POST['login']?>">
                        </label>
                    </p>
                    <p>
                        <label>
                            <b>Пароль:</b><br>
                            <input type="password" name="password">
                        </label>
                    </p>
                    <p>
                        <label>
                            <b>Запомнить:</b>
                            <input name="remember" type="checkbox" value="1">
                        </label>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Вход">
                    </p>
                    <?php
                        if (count($errors) !== 0) {
                            foreach ( $errors as $errorMsg ) {
                                print('<p class="message error">'.$errorMsg.'</p>');
                            }
                        }
                    ?>
                </form>
            </div>
        </main>
    </body>
</html>