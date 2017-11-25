<?php
// user_regi.phpからDBへ保存
if ($_POST['action'] == 'cancel') {
  header('Location: board_service.php');
exit;
}

require_once 'db_connect.php';
try{
    $dbh = db_connect();
    $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    date_default_timezone_set('Asia/Tokyo');

    // 登録内容
    $name = $_POST['name'];
    // $mail = $_POST['mail'];
    // $password = $_POST['password'];

    $sql = 'INSERT INTO users(user_name) VALUES(:name)';
    $pre = $dbh->prepare($sql);

    $pre->bindValue(':name', $name, PDO::PARAM_STR);
    // $pre->bindValue(':mail', $mail, PDO::PARAM_STR);
    // $pre->bindValue(':password', $password, PDO::PARAM_STR);

    $r = $pre->execute();
} catch (PDOException $e) {
    echo "登録に失敗しました。再度始めからやり直してください。 (" , $e->getMessage() , ")";
    return ;

}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;URL=board_service.php">
    <title>登録完了</title>
  </head>
  <body>
    <p>ユーザー登録完了しました</p>
  </body>
</html>
