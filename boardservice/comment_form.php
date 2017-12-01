<?php
  require_once 'function.php';
  session_start();
    //未ログイン時にログイン、新規登録、コメント一覧へ誘導
  unlogined_session();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント入力画面</title>
  </head>
  <body>
    <!-- コメント入力画面 -->
    <form action="comments_regi.php" method="POST">
      <p>名前: <?php echo h($_SESSION['name']) ?></p>
      <p>タイトル:<input type="title" name="title" size="30" placeholder="タイトル"></p>
      <p><textarea name="text" rows="4" cols="40" placeholder="コメント"></textarea></p>
      <input type="submit" value="コメ確認">
    </form>
  </body>
</html>
