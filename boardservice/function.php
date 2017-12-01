<?php
  function h($str) {
      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

  // CSRFトークンの生成
  function generate_token() {
      // セッションIDからハッシュを生成
      return hash ( 'sha256', session_id() );
  }

  // CSRFトークン
  function validate_token ($token) {
      return $token === generate_token();
  }

  //未ログイン時にログイン、新規登録、コメント一覧へ誘導
  function unlogined_session(){
    if(!isset($_SESSION['name'])){
      echo "<a href='login.php'>ログイン</a>あるいは
            <a href='user_regi_form.php'>新規登録</a>してください。";
      echo "<a href=index.php>コメント一覧へ戻る</a>";
      exit;
    }
  }

  // ログイン時のユーザー名表示
  function logined_session(){
    if (isset($_SESSION['name'])) {
      echo h($_SESSION['name'])."でログインされています<br>";
      echo "<a href=index.php>コメント一覧へ戻る</a>";
      exit;
    }
  }
?>
