<?php
  // 名前未入力の場合「名無しに」変更
  if($_POST['name'] == ''){
    $_POST['name'] = '名無し';
  }
 ?>
<!DOCTYPE html>
<html>
  <head lang="ja">
    <meta charset="utf-8">
    <title>コメント確認</title>
  </head>
  <body>
  <?php require_once 'function.php'; ?>
    <!-- コメントの確認と書込かキャンセルの選択画面 -->
  <form action="comments.php" method="post">
    <p>名前 : <?php echo e($_POST['name'])?></p>
    <p>タイトル : <?php echo e($_POST['title'])?></p>
    <p>コメント内容 : <?php echo e($_POST['text'])?></p>
    <input type="hidden" name="name" value="<?php echo e($_POST['name']) ?>">
    <input type="hidden" name="title" value="<?php echo e($_POST['title'])?>">
    <input type="hidden" name="text" value="<?php echo e($_POST['text'])?>">
    <br>
    <p>上記を書き込みます</p>
      <button type="submit" name="action" value="accept">書込</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </form>
  </body>
</html>
