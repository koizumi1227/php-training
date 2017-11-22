<?php
// comment_regi.phpからコメントをDBへ保存
if ($_POST['action'] == 'cancel') {
  header('Location: board_service.php');
exit;
}

require_once 'db_connect.php';
try{
    $dbh = db_connect();
    $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    date_default_timezone_set('Asia/Tokyo');


    // コメント内容
    $name = $_POST['name'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $created_at = date('Y-m-d H:i:s');

    $sql = 'INSERT INTO comments(name,title,created_at,text) VALUES(:name,:title,:created_at,:text)';
    $pre = $dbh->prepare($sql);

    $pre->bindValue(':name', $name, PDO::PARAM_STR);
    $pre->bindValue(':title', $title, PDO::PARAM_STR);
    $pre->bindValue(':text', $text, PDO::PARAM_STR);
    $pre->bindValue(':created_at', $created_at, PDO::PARAM_INT);

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
    <meta http-equiv="refresh" content="1;URL=board_service.php">
    <title>コメント完了</title>
  </head>
  <body>
    <p>コメント完了</p>
  </body>
</html>
