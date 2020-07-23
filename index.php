<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    print_r($_COOKIE);

    if (!isset($_COOKIE['currentPage']))
    {
        echo "auth";
    }
    elseif ($_COOKIE['currentPage'] === 'page_a') {

    }
    else
    {

    }

    switch ($user_type){
      case "subscriber": $redirect_url = "/blog.html";
        break;
      case "author": $redirect_url = "/page_a.html";
        break;
      case "admin": $redirect_url = "/admin-panel.html";
        break;
      default: $redirect_url = "/registration-form.html";
    }

    header('HTTP/1.1 200 OK');
    header('Location: http://'.$_SERVER['HTTP_HOST'].$redirect_url);
    exit();


$redirect_url = array (
  "subscriber" => "/blog.html",
  "author" => "/author-panel.html",
  "admin" => "/admin-panel.html",
  "newuser" => "/registration-form.html"
);

header('HTTP/1.1 200 OK');
header('Location: http://'.$_SERVER['HTTP_HOST'].$redirect_url[$user_type]);
exit();

?>

