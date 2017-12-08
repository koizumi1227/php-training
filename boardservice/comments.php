<?php
  require_once 'db_connect.php';
  require_once  'function.php';
  // comment_regi.phpからコメントをDBへ保存
  if ($_POST['action'] == 'cancel') {
    header('Location: index.php');
  exit;
  }

  session_start();
  unlogined_session();
  // var_dump($_SESSION);
  // var_dump($_POST);
  try{
      $dbh = db_connect();
      date_default_timezone_set('Asia/Tokyo');

      // $_SESSION[id]はcomments.user_id と同じ
      // comments.user_id と users.id は同じ
      // コメント内容
      $title = $_POST['title'];
      $text = $_POST['text'];
      $thread_id = $_POST['thread_id'];
      $created_at = date('Y-m-d H:i:s');
      $user_id = $_SESSION['id'];
      // var_dump($_SESSION);


      $sql = 'INSERT INTO comments(title,created_at,text,user_id,thread_id) VALUES(:title,:created_at,:text,:user_id,:thread_id)';
      $pre = $dbh->prepare($sql);

      $pre->bindValue(':title', $title, PDO::PARAM_STR);
      $pre->bindValue(':text', $text, PDO::PARAM_STR);
      $pre->bindValue(':created_at', $created_at, PDO::PARAM_INT);
      $pre->bindValue(':user_id', $user_id, PDO::PARAM_STR);
      $pre->bindValue(':thread_id', $thread_id, PDO::PARAM_INT);

      $r = $pre->execute();
  } catch (PDOException $e) {
      echo "コメント書き込みに失敗しました。 (" , $e->getMessage() , ")";
      return ;

  }

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=index.php">
    <title>コメント完了</title>
  </head>
  <body>
    <p>コメント完了</p>
  </body>
</html>
