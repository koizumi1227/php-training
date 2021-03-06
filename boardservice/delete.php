<?php
if ($_POST['action'] == 'cancel') {
  header('Location: board_service.php');
exit;
}
require_once 'db_connect.php';
try{
    $dbh = db_connect();
    $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    date_default_timezone_set('Asia/Tokyo');


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

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=board_service.php">
    <title>コメント削除完了</title>
  </head>
  <body>
    <p>コメントが削除されました</p>
  </body>
</html>
