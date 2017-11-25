<?php
  require_once 'function.php';
  require_once 'db_connect.php';

  // ユーザー名一致判別
  try{
      $dbh = db_connect();
      $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      $names = $_POST['name'];
      $sql = 'SELECT * FROM users WHERE user_name = :user_name';
      $pre = $dbh -> prepare($sql);

      $pre->bindValue(':user_name', $names, PDO::PARAM_STR);
      $r = $pre->execute();
      // user_nameに該当するものがあるかを数える。なければ０。
      $count = $pre->rowCount();

      if($count == 0){
        echo "該当するユーザー名がありません<br>";
        echo "<a href=user_regi_form.php>こちら</a>からユーザー登録をしてください<br>";
        exit;
      }

  } catch (PDOException $e) {
      echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
      return ;

  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント確認</title>
  </head>
  <body>
  <?php require_once 'function.php'; ?>
    <!-- コメントの確認と書込かキャンセルの選択画面 -->
  <form action="comments.php" method="post">
    <p>名前 : <?php echo h($_POST['name'])?></p>
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
