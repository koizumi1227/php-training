<?php
// 選択されたIDから詳細を表示
  $id = $_GET['id'];
  require_once 'function.php';
  require_once 'db_connect.php';
try{
  $dbh = db_connect();
  $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  date_default_timezone_set('Asia/Tokyo');

  $sql = 'SELECT * FROM comments WHERE id = :id';
  $pre = $dbh->prepare($sql);
  $pre->bindValue(':id', $id);
  $r = $pre->execute();
} catch (PDOException $e) {
  echo "エラーが発生しました。最初から再度IDを選択。 (" , $e->getMessage() , ")";
  return ;

}
 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント詳細</title>
  </head>
  <body>
    <?php $data = $pre->fetch(PDO::FETCH_ASSOC);?>
    <p>ID : <?php echo h($data['id']) ?></p>
    <p>名前 : <?php echo h($data['name']) ?></p>
    <p>作成日時 : <?php echo h($data['created_at']) ?></p>
    <p>変更日時 : <?php echo h($data['updated_at']) ?></p>
    <p>タイトル : <?php echo h($data['title']) ?></p>
    <p>コメント内容:</p>
    <pre>
      <?php echo h($data['text']) ?>
    </pre>
    <br>

    <form action="change_regi.php" method="POST">
      <p>タイトル:<input type="title" name="title" size="30" placeholder="タイトル"></p>
      <p><textarea name="text" rows="4" cols="40" placeholder="コメント"></textarea></p>
      <input type="hidden" name="id" value="<?php echo h($data['id'])?>">
      <button type="submit" name="action" value="accept">コメント変更</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </body>
</html>
