<?php
  require_once 'function.php';
  require_once 'db_connect.php';
  $dbh = db_connect();
  // board_service.phpから名前選択からidを取得。
  $user_id = $_GET['id'];
  var_dump($user_id);
  $sql = 'SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id WHERE user_id = :user_id';
  $pre = $dbh -> prepare($sql);
  $pre->bindValue(':user_id', $user_id);
  $r = $pre->execute();

  if (false === $r) {
      var_dump($pre->errorInfo());
      return;
  }
  ?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ユーザーコメント一覧</title>
  </head>
  <body>
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
        // echo"<pre>";
        // h関数(htmlspecialchars)
      ?>
      <tr>
        <td>
          <?php echo "<a href=detail.php?id={$data['id']}>".$data['id']."</a>";?>
        </td>
        <td><?php echo h($data['name']) ?></td>
        <td><?php echo h($data['created_at']) ?></td>
        <td><?php echo h($data['updated_at']) ?></td>
        <td><?php echo h($data['title']) ?></td>
        <td><?php echo h($data['text']) ?></td>
        <td>
          <?php echo "<a href=delete_regi.php?id={$data['id']}>削除</a>";?>
        </td>
      </tr>
    <?php } ?>

  </table>
  </body>
</html>
