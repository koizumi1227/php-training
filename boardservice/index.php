<?php

  require_once 'function.php';
  require_once 'db_connect.php';
  session_start();
  // var_dump($_SESSION);

try {

  $dbh = db_connect();
  $sql = 'SELECT * FROM threads';
  $pre = $dbh -> prepare($sql);
  $r = $pre->execute();


} catch (PDOException $e) {
    echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
    return ;
}

  ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>スレッド一覧</title>
    <a href="comment_history.php">コメント履歴</a>
  </head>
  <body>
    <h1>スレッド一覧</h1>
    <form class="search" action="search_thread.php" method="post">
      <label for="thread_search">スレッド名検索</label>
      <input type="text" id="thread_search" name="thread_search" value="">
      <input type="submit" name="submit" value="検索">
    </form>
    <table border="1">
      <tr>
        <th>スレッド名</th>
        <th>作成日時</th>
      </tr>
      <?php
       while($data = $pre->fetch(PDO::FETCH_ASSOC)){
         // echo"<pre>";
        // var_dump($data);
      ?>
         <tr>
           <td>
             <a href='thread_comment.php?id=<?php echo $data['id'] ?>'><?php echo h($data['title']) ?></a>
          </td>
           <td><?php echo h($data['created_at']) ?></td>
         </tr>

         <?php
           }
         ?>
    </table>
    <div class="form_conf">
      <a href="login.php">ログイン</a>
      <a href="user_regi_form.php">新規登録</a>
      <a href="logout.php">ログアウト</a>
      <a href="user_comment_list.php">自分のコメント表示</a>
    </div>

  </body>
</html>
