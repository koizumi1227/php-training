<?php
if ($_POST['action'] == 'cancel') {
  header('Location: board_service.php');
exit;
}
// user_regi.phpからDBへ保存
require_once 'db_connect.php';
require_once 'function.php';

try{
    $dbh = db_connect();

    // 登録内容
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    // var_dump($_POST);

    // メールアドレスが存在するかのカウント。存在しなければ値が0。
    $sql = "SELECT count(*) FROM users WHERE email = :email";

    $pre = $dbh -> prepare($sql);
    $pre->bindValue(':email', $mail, PDO::PARAM_STR);

    $r = $pre->execute();
    $n = $pre->fetchColumn();
    // var_dump($n);

    // カウント０だった場合にDBへ保存。そうじゃなければ再度始めから登録へ。
    if($n == 0){
      $sql = 'INSERT INTO users(name,email,password)
              VALUES(:name,:email,:password)';
      $pre = $dbh -> prepare($sql);
      $pre->bindValue(':name', $name, PDO::PARAM_STR);
      $pre->bindValue(':email', $mail, PDO::PARAM_STR);
      $pre->bindValue(':password', $password, PDO::PARAM_STR);
      $r = $pre->execute();
    } else{
      echo "すでに登録されているメールアドレスです。<br>";
      echo "<a href='user_regi_form.php'>こちら</a>から再度登録をお願いします。";
      return;
    }



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
