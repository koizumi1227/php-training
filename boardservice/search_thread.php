<?php

require_once 'function.php';
require_once 'db_connect.php';
// var_dump($_POST);

// 検索ワード
$thread_search = '%'.$_POST['thread_search'].'%';



if(empty($_POST['thread_search'])){
  echo "未入力です<br>";
  echo "<a href='index.php'>スレッド一覧へ</a>";
  exit;
}

try {
  $dbh = db_connect();
  $sql = 'SELECT count(*) FROM threads WHERE title LIKE :title';
  $pre = $dbh -> prepare($sql);
  $pre->bindValue(':title', $thread_search,  PDO::PARAM_STR);
  $r = $pre->execute();
  $n = $pre->fetchColumn();
  // var_dump($n);

  // 検索ワードが一つでもかかればcount($n)が1以上になる
  if($n >= 1){
    $sql2 = 'SELECT * FROM threads WHERE title LIKE :title';
    $pre = $dbh -> prepare($sql2);
    $pre->bindValue(':title', $thread_search,  PDO::PARAM_STR);
    $r = $pre->execute();
  } else {
    echo "該当するスレッドはありません<br>";
    echo "<a href='index.php'>スレッド一覧へ</a>";
    exit;
  }
  
} catch (PDOException $e) {
    echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
    return ;
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>スレッド検索</title>
  </head>
  <body>
    <p>検索ワード : <?php echo h($_POST['thread_search'])?></p>
    <table border="1">
      <tr>
        <th>スレッド名</th>
        <th>作成日時</th>
      </tr>
    <?php
    while($data = $pre->fetch(PDO::FETCH_ASSOC)){
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
    <a href='index.php'>スレッド一覧へ</a>
  </body>
</html>
