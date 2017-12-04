<?php

  require_once 'function.php';
  require_once 'db_connect.php';
  session_start();
  // var_dump($_SESSION);

try {

  $dbh = db_connect();
  $sql = 'SELECT * FROM threads';
  $pre = $dbh -> prepare($sql);
  $r = $pre->execute();


} catch (PDOException $e) {
    echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
    return ;
}

  ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>スレッド一覧</title>
  </head>
  <body>
    <h1>スレッド一覧</h1>
    <table border="1">
      <tr>
        <th>スレッド名</th>
        <th>作成日時</th>
      </tr>
        <?php
          while($data = $pre->fetch(PDO::FETCH_ASSOC)){
          // echo"<pre>";
          // var_dump($data);
        ?>
          <tr>
            <td><?php echo "<a href='thread_comment.php?id={$data["id"]}&title={$data["title"]}'>".h($data['title'])."</a>"?>
            </td>
            <td><?php echo h($data['created_at']) ?></td>
          </tr>

        <?php
          } ?>
    </table>
    <div class="form_conf">
      <a href="login.php">ログイン</a>
      <a href="user_regi_form.php">新規登録</a>
      <a href="comment_form.php">コメント投稿</a>
      <a href="user_comment_list.php">自分のコメント表示</a>
    </div>
  </body>
</html>
