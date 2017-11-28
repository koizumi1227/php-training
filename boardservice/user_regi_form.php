<?php
  require_once 'function.php';

  session_start();
  if (isset($_SESSION['name'])) {
    echo $_SESSION['name']."でログインされています<br>";
    echo "<a href=board_service.php>コメント一覧へ戻る</a>";
    exit;
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ユーザー登録画面</title>
  </head>
  <body>
    <h1>ユーザー登録</h1>
    <form action="user_regi.php" method="post">
      <p>名前:<input type="name" name="name" size="30" placeholder="名前"></p>
      <p>メールアドレス:<input type="text" name="mail" size="30" placeholder="example@example.com"></p>
      <p>パスワード:<input type="password" name="password" size="10" placeholder="パスワード"></p>
      <input type="submit" value="登録">

    </form>
  </body>
</html>
