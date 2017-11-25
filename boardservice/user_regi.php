<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ユーザー登録確認</title>
  </head>
  <body>
  <?php require_once 'function.php'; ?>
  <form action="user.php" method="post">
    <h1>登録内容確認</h2>
    <p>名前 : <?php echo h($_POST['name'])?></p>
    <input type="hidden" name="name" value="<?php echo h($_POST['name']) ?>">
    <!--  パスワードとメールアドレスを追加した場合-->
    <!-- h($_POST['mail']) -->
    <!-- h($_POST['password']) -->
    <br>
      <button type="submit" name="action" value="accept">登録</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </form>
  </body>
</html>
