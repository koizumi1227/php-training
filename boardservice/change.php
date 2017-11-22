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


    // コメント変更内容
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $updated_at = date('Y-m-d H:i:s');

    $sql = 'UPDATE comments SET title=:title, updated_at=:updated_at, text=:text WHERE id = :id';
    $pre = $dbh->prepare($sql);

    $pre->bindValue(':id', $id);
    $pre->bindValue(':title', $title, PDO::PARAM_STR);
    $pre->bindValue(':text', $text, PDO::PARAM_STR);
    $pre->bindValue(':updated_at', $updated_at, PDO::PARAM_INT);

    $r = $pre->execute();
} catch (PDOException $e) {
    echo "エラーが発生しました。内容を変更に失敗。 (" , $e->getMessage() , ")";
    return ;

}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=board_service.php">
    <title>コメント変更完了</title>
  </head>
  <body>
    <p>内容が変更されました</p>
  </body>
</html>
