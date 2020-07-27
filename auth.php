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
                            <input type="text" name="login" value="<?php if (isset($_POST['login'])) print $_POST['login']?>">
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

                    <?php
                        const DEFAULT_REDIRECT_PAGE = '/page_a.php';
                        if (isset($_POST['submit'])) {
                            $login = trim($_POST['login']);
                            $password = trim($_POST['password']);

                            $errors = array();

                            if (empty($login)) {
                                $errors[] = "Укажите Ваш логин!";
                            } elseif (empty($pass)) {
                                $errors[] = "Укажите Ваш пароль!";
                            }

                            if (empty($_COOKIE['user_login'])) {                // Новый пользователь (регистрация)
                                setcookie('user_login', $login, time()+3600);
                                setcookie('user_password', password_hash($password, PASSWORD_DEFAULT), time()+3600);
                                setcookie('current_page', DEFAULT_REDIRECT_PAGE, time()+3600);
                                $redirectPage = DEFAULT_REDIRECT_PAGE;
                            } elseif ($_COOKIE['user_login'] === $login) {      // Зарегистрированный пользователь
                                if ($_COOKIE['user_password'] !== password_hash($password, PASSWORD_DEFAULT)) {
                                    $errors[] = "Неверный пароль!";
                                } else {
                                    $redirectPage = $_COOKIE['current_page'];   
                                }
                            }
                    
                            if (count($errors) === 0) {
                                header('HTTP/1.1 200 OK');
                                header('Location: http://' . $_SERVER['HTTP_HOST'] . $redirectPage);
                                exit();
                            }
                            else {
                                foreach ( $errors as $errorMsg ) {
                                    print('<p class="message error">'.$errorMsg.'</p>');
                                }
                            }
                        }
/*
    public function logout( $key_session ) {
            $deleted = false;
            $errors = array();

                        
            if ( $res['success'] ) {
                setcookie("user_session", '', time()-3600);
                unset( $_SESSION['cart'] );

                $deleted = true;
            
        }
*/                        
                    ?>



                </form>
            </div>
        </main>
    </body>
</html>