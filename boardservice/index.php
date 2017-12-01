<?php
  require_once 'function.php';
  require_once 'db_connect.php';
  session_start();
  // var_dump($_SESSION);

  try {

    $dbh = db_connect();
    $sql = 'SELECT comments.*, users.name FROM users INNER JOIN comments ON comments.user_id = users.id';
    // $sql = 'SELECT * FROM comments';
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
    <title>コメント一覧</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">

  </head>
  <body>
    <h1>コメント一覧</h1>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>作成日時</th>
        <th>変更日時</th>
        <th>タイトル</th>
        <th>コメント内容</th>
      </tr>
      <?php
        while($data = $pre->fetch(PDO::FETCH_ASSOC)){
          // echo"<pre>";
          // var_dump($data);
          // h関数(htmlspecialchars)

        ?>
        <tr>
          <td><?php echo h($data['id'])?></td>
          <td><?php echo h($data['name']) ?></td>
          <td><?php echo h($data['created_at']) ?></td>
          <td><?php echo h($data['updated_at']) ?></td>
          <td><?php echo h($data['title']) ?></td>
          <td><?php echo h($data['text']) ?></td>
        </tr>
      <?php } ?>

    </table>
    <div class="form_conf">
      <a href="login.php">ログイン</a>
      <a href="user_regi_form.php">新規登録</a>
      <a href="comment_form.php">コメント投稿</a>
      <a href="user_comment_list.php">自分のコメント表示</a>
    </div>

  </body>
</html>
