<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Page_B</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <main>
            <h2>This is Page B.</h2>
            <p>
                <a href="/page_a.php">Go to Page A</a>
            </p>
        </main>
        <?php
            var_dump($_SESSION);
            echo "<br>";
            echo $_COOKIE['user_login'] ;
            echo "<br>";
            echo $_COOKIE['user_password'];
            echo "<br>";
            echo $_COOKIE['current_page'];
            echo "<br>";
            echo $_COOKIE['PHPSESSID'];
            setcookie('current_page', '/page_b.php', time()+3600);
        ?>
    </body>
</html>