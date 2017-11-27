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

?>
