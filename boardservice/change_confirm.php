<?php
require_once 'function.php';
if ($_POST['action'] == 'cancel') {
  header('Location: index.php');
exit;
}
session_start();
unlogined_session();
// var_dump($_POST);
 ?>
<!DOCTYPE html>
<html  lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント変更</title>
  </head>
  <body>
  <form action="update.php" method="post">
    <p>タイトル : <?php echo h($_POST['title'])?></p>
    <p>コメント内容 : <?php echo h($_POST['text'])?></p>
    <input type="hidden" name="title" value="<?php echo h($_POST['title'])?>">
    <input type="hidden" name="text" value="<?php echo h($_POST['text'])?>">
    <input type="hidden" name="id" value="<?php echo h($_POST['id'])?>">
    <input type="hidden" name="user_id" value="<?php echo ($_POST['user_id'])?>">
    <br>
    <p>コメントを変更しますか</p>
      <button type="submit" name="action" value="accept">変更</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </form>
  </body>
</html>
