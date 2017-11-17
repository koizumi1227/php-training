<?php

  require_once 'db_connect.php';

  $dbh = db_connect();
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $sql = 'SELECT * FROM comments;';
  $pre = $dbh -> prepare($sql);
  $r = $pre->execute();
  if (false === $r) {
      var_dump($pre->errorInfo());
      return;
  }

 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>コメント一覧</title>
  </head>
  <body>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>作成日時</th>
        <th>変更日時</th>
        <th>タイトル</th>
        <th>コメント内容</th>
      </tr>
      <?php
        while($data = $pre->fetch(PDO::FETCH_ASSOC)){
          // var_dump($data);
        echo "<tr>";
        echo "<td>";
        echo "$data[id]";
        echo "</td>";
        echo "<td>";
        echo "$data[name]";
        echo "</td>";
        echo "<td>";
        echo "$data[created_at]";
        echo "</td>";
        echo "<td>";
        echo "$data[updated_at]";
        echo "</td>";
        echo "<td>";
        echo "$data[title]";
        echo "</td>";
        echo "<td>";
        echo "$data[text]";
        echo "</td>";
        echo "</tr>";
      }?>

    </table>


  </body>
</html>
