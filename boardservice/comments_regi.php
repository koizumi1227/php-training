<?php
  require_once 'function.php';
  session_start();
  unlogined_session();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント確認</title>
  </head>
  <body>
    <!-- コメントの確認と書込かキャンセルの選択画面 -->
  <form action="comments.php" method="post">
    <p>名前 : <?php echo h($_SESSION['name'])?></p>
    <p>タイトル : <?php echo h($_POST['title'])?></p>
    <p>コメント内容 : <?php echo h($_POST['text'])?></p>
    <input type="hidden" name="name" value="<?php echo h($_POST['name']) ?>">
    <input type="hidden" name="title" value="<?php echo h($_POST['title'])?>">
    <input type="hidden" name="text" value="<?php echo h($_POST['text'])?>">
    <br>
    <p>上記を書き込みます</p>
      <button type="submit" name="action" value="accept">書込</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </form>
  </body>
</html>
