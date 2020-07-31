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
            <p>
                <a href="/auth.php?logout=1">Exit</a>
            </p>
        </main>
        <?php
            setcookie('current_page', '/page_b.php', time()+3600);
        ?>
    </body>
</html>