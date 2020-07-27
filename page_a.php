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
        </main>
        <?php
            setcookie('current_page', '/page_a', time()+3600);
        ?>
    </body>
</html>