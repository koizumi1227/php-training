<?php
 require_once 'function.php';

 // 未入力チェック
   if (empty($_POST["name"])) {  // 値が空のとき
       $errorMessage = '名前が未入力です。';
   } else if (empty($_POST["mail"])) {
       $errorMessage = 'メールアドレスが未入力です。';
   } else if (empty($_POST["password"])) {
       $errorMessage = 'パスワードが未入力です。';
   }
 if (empty($_POST["name"]) || empty($_POST["mail"]) || empty($_POST["password"])){
   echo $errorMessage."<br>";
   echo "<a href='user_regi_form.php'>こちら</a>から再度登録をお願いします。";
   exit;
 }

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ユーザー登録確認</title>
  </head>
  <body>
  <form action="user.php" method="post">
    <h1>登録内容確認</h2>
      <p>名前 : <?php echo h($_POST['name'])?></p>
      <p>メールアドレス : <?php echo h($_POST['mail'])?></p>
      <p>パスワードは表示されません</p>
    <input type="hidden" name="name" value="<?php echo h($_POST['name']) ?>">
    <input type="hidden" name="mail" value="<?php echo h($_POST['mail']) ?>">
    <input type="hidden" name="password" value="<?php echo h($_POST['password']) ?>">
    <br>
      <button type="submit" name="action" value="accept">登録</button>
      <button type="submit" name="action" value="cancel">キャンセル</button>
  </form>
  </body>
</html>
