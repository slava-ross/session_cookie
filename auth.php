<?php
    const DEFAULT_REDIRECT_PAGE = '/page_a.php';

    if (isset($_POST['submit'])) {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $errors = array();

        if (empty($login)) {
            $errors[] = "Укажите Ваш логин!";
        }
        if (empty($password)) {
            $errors[] = "Укажите Ваш пароль!";
        }

        if (count($errors) === 0) {
            if (empty($_COOKIE['user_login']) || $_COOKIE['user_login'] !== $login) {   // Новый пользователь (регистрация) или незарегистрированный (другой) пользователь
                if (!session_start()) {
                    print('<p class="message error">Сессия не запустилась</p>');
                } else {
                    $_SESSION['auth'] = true;
                    setcookie('user_auth_unreg', $_SESSION['auth'], time()+3600);
                }
                setcookie('user_login', $login, time()+3600);
                setcookie('user_password', password_hash($password, PASSWORD_DEFAULT), time()+3600);
                setcookie('current_page', DEFAULT_REDIRECT_PAGE, time()+3600);

                //print('<p class="message">Переход на Default Page</p>');
                //print('<p class="message">' . $_COOKIE['PHPSESSID'] . '</p>');
                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . DEFAULT_REDIRECT_PAGE);
                exit();
            } else {                                                                     // Зарегистрированный пользователь
                setcookie('user_auth_unreg', '', time()-3600);
                setcookie('user_auth_reg', $_SESSION['auth'], time()+3600);
                if (password_verify($password, $_COOKIE['user_password'])) {
                    print('<p class="message error">Неверный пароль</p>');
                } else {
                    header('HTTP/1.1 200 OK');
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_COOKIE['current_page']);
                    exit();
                }
            }
        }
        else {
            foreach ( $errors as $errorMsg ) {
                print('<p class="message error">'.$errorMsg.'</p>');
            }
        }
    }
    else {
?>

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
                            <input type="text" name="login">
                        </label>
                    </p>
                    <p>
                        <label><b>Пароль:</b><br>
                        <input type="password" name="password">
                        </label>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Вход">
                    </p>
                </form>
            </div>
        </main>
    </body>
</html>

<?php
    }
?>