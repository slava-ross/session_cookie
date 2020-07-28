<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Page_A</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <main>
            <h2>This is Page A.</h2>
            <p>
                <a href="/page_b.php">Go to Page B</a>
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
            setcookie('current_page', '/page_a.php', time()+3600);
        ?>
    </body>
</html>