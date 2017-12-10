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

  $sql2 = 'SELECT * FROM threads WHERE title LIKE :title';
  $pre = $dbh -> prepare($sql2);
  $pre->bindValue(':title', $thread_search,  PDO::PARAM_STR);
  $pre->execute();

  $data = $pre->fetchALL();
  // echo "<pre>";
  // var_dump($data);

  if(empty($data)){
    echo "該当するスレッドはありません<br>";
    echo "<a href='index.php'>スレッド一覧へ</a>";
    exit;
  }

  // $data = $pre->fetch(PDO::FETCH_ASSOC);
  // var_dump($data);




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
    foreach ($data as $row){
      // var_dump($row);
      ?>
      <tr>
        <td>
          <a href='thread_comment.php?id=<?php echo $row['id'] ?>'><?php echo h($row['title']) ?></a>
       </td>
        <td><?php echo h($row['created_at']) ?></td>
      </tr>

      <?php
        }
      ?>
    </table>
    <a href='index.php'>スレッド一覧へ</a>
  </body>
</html>
