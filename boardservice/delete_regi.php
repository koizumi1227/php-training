<?php
  $id = $_GET['id'];
  require_once 'function.php';
  require_once 'db_connect.php';
  session_start();

  //未ログイン時にログイン、新規登録、コメント一覧へ誘導
  unlogined_session();

try{
  $dbh = db_connect();

  $sql = 'SELECT * FROM comments WHERE id = :id';
  $pre = $dbh->prepare($sql);
  $pre->bindValue(':id', $id);
  $r = $pre->execute();
} catch (PDOException $e) {
  echo "エラーが発生。最初から再度IDを選択。 (" , $e->getMessage() , ")";
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
    <p>タイトル : <?php echo h($data['title']) ?></p>
    <p>コメント内容:</p>
    <pre>
      <?php echo h($data['text']) ?>
    </pre>
    <br>

    <form action="delete.php" method="POST">
      <input type="hidden" name="id" value="<?php echo h($data['id'])?>">
      <input type="hidden" name="user_id" value="<?php echo h($data['user_id'])?>">
      <button type="submit" name="action" value="accept">削除</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
    </form>
    </body>
  </html>
