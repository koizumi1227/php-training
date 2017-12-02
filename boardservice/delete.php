<?php
if ($_POST['action'] == 'cancel') {
  header('Location: index.php');
exit;
}
require_once 'db_connect.php';
require_once 'function.php';

session_start();
unlogined_session();

// var_dump($_POST);
// echo "<br>";
// var_dump($_SESSION);


// ログインされていれば　$_SESSION['id']とusers.id　が同じになる
// delete_regi.phpから異なるユーザーがアクセスしたときにcomments.user_id と users.idが一致するか判別
if($_SESSION['id'] == $_POST['user_id']){
    try{
        $dbh = db_connect();

        // 該当するIDからコメント削除
        $id = $_POST['id'];
        $sql = 'DELETE FROM comments WHERE id = :id';
        $pre = $dbh->prepare($sql);

        $pre->bindValue(':id', $id);

        $r = $pre->execute();
      } catch (PDOException $e) {
        echo "エラーが発生。最初から再度IDを選択。 (" , $e->getMessage() , ")";
        return ;

    }
} else {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=index.php">
    <title>コメント削除完了</title>
  </head>
  <body>
    <p>コメントが削除されました</p>
  </body>
</html>
