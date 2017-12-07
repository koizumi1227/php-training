<?php
  require_once 'function.php';
  require_once 'db_connect.php';
  session_start();
  // var_dump($_SESSION);
  // var_dump($_GET);

  try {

    $thread_id = $_GET['id'];
    // var_dump($thread_id);
    $dbh = db_connect();
    $sql = 'SELECT comments.*, users.name AS user_name, threads.title AS thread_title
            FROM comments
            JOIN users
            ON comments.user_id  = users.id
            JOIN threads
            ON comments.thread_id = threads.id
            WHERE thread_id = :thread_id';
    $pre = $dbh -> prepare($sql);
    $pre->bindValue(':thread_id', $thread_id);
    $r = $pre->execute();

    // スレッドタイトル取得
    $thread = $pre->fetch(PDO::FETCH_ASSOC);
    $thread_title = $thread['thread_title'];
      // var_dump($thread_title);
    // while $dataのためカレントレコードを戻すため
    $pre->execute();

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
    <a href="comment_history.php">コメント履歴</a>
  </head>
  <body>
    <h1><?php echo h($thread_title) ?></h1>
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
          <td><?php echo h($data['user_name']) ?></td>
          <td><?php echo h($data['created_at']) ?></td>
          <td><?php echo h($data['updated_at']) ?></td>
          <td><?php echo h($data['title']) ?></td>
          <td><?php echo h($data['text']) ?></td>
       </tr>
   <?php } ?>

    </table>
  </body>
</html>
