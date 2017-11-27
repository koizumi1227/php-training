<?php

require_once 'db_connect.php';
require_once 'function.php';
@session_start();

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["name"])) {
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["name"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["name"];
        $password = $_POST["password"];
        $token = $_POST["token"];
        // 認証
        try {
            $dbh = db_connect();
            $dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'SELECT * FROM users WHERE name =:name';
            $pre = $dbh->prepare($sql);
            $pre->bindValue(':name', $userid, PDO::PARAM_STR);

            $pre->execute();

            if ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
                if (validate_token($token) && password_verify($password, $row['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    var_dump($row);
                    var_dump($_SESSION);

                    // header("Location: board_service.php"); //コメント一覧へ移動
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
          echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
          return ;
        }
    }
}
?>

<!doctype html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>ログイン</title>
    </head>
    <body>
      <h1>ログイン画面</h1>
      <form id="loginForm" name="loginForm" action="" method="POST">
              ログインフォーム
              <div><font color="#ff0000"><?php echo h($errorMessage, ENT_QUOTES); ?></font></div>
              <label for="name">ユーザーID : </label><input type="text" id="name" name="name" placeholder="ユーザー名を入力" value="">
              <br>
              <label for="password">パスワード : </label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
              <br>
              <input type="hidden" name="token" value="<?=h(generate_token())?>">
              <input type="submit" id="login" name="login" value="ログイン">
      </form>
      <br>
      <form action="user_regi_form.php">
              <p>新規登録フォーム</p>
              <input type="submit" value="新規登録">
      </form>
    </body>
</html>
