<?php
require_once 'function.php';

session_start();

unlogined_session();

$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time()-3600);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=index.php">
    <title>ログアウト処理</title>
  </head>
  <body>
    <p>ログアウトしました。</p>
  </body>
</html>
