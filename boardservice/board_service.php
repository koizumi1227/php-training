<?php
  require_once 'function.php';
  require_once 'db_connect.php';
  $dbh = db_connect();
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $sql = 'SELECT * FROM comments';
  $pre = $dbh -> prepare($sql);
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
    <title>コメント一覧</title>
  </head>
  <body>
    <p>コメント内容を変更する場合はIDを、削除したい場合は削除をクリック</p>
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
          // var_dump($data);
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
