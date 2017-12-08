<?php
require_once 'db_connect.php';
require_once 'function.php';
session_start();
unlogined_session();


try {
  // session[name]からDBアクセス
  // 該当するユーザーIDのコメント表示
  $user_id = $_SESSION['id'];
  $one_week_ago = date("Y-m-d H:i:s" , strtotime('-1week'));
  // var_dump($_SESSION);
  $dbh = db_connect();

  // 全てのコメント履歴一覧取得用
  $sql = 'SELECT *
          FROM comments
          WHERE user_id = :user_id
          AND (comments.updated_at > :uptimes OR comments.created_at > :cretimes)
          ';
  $pre = $dbh -> prepare($sql);
  $pre->bindvalue(':uptimes', $one_week_ago);
  $pre->bindvalue(':cretimes', $one_week_ago);
  $pre->bindValue(':user_id', $user_id);
  $r = $pre->execute();

  // コメントしたスレッド一覧取得用
  $sql2 = 'SELECT  distinct thread_id, threads.title AS tread_title
          FROM comments
          JOIN threads
          ON comments.thread_id = threads.id
          WHERE user_id = :user_id
          AND (comments.updated_at > :uptimes OR comments.created_at > :cretimes)
          ORDER BY thread_id ASC
          -- GROUP BY thread_id
          ';
  $pre2 = $dbh -> prepare($sql2);
  $pre2->bindvalue(':uptimes', $one_week_ago);
  $pre2->bindvalue(':cretimes', $one_week_ago);
  $pre2->bindValue(':user_id', $user_id);
  $r = $pre2->execute();

  // while($data2 = $pre2->fetch(PDO::FETCH_ASSOC)){
  //   var_dump($data2);
  // }

} catch (PDOException $e) {
  echo "エラーが発生。再度始めからやり直してください。 (" , $e->getMessage() , ")";
  return ;
}

// 現在時刻 - created_at  < 1week
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>コメント履歴</title>
  </head>
  <body>
    <h1>過去1週間のコメント履歴</h1>
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
      ?>
        <tr>
           <td>
             <a href=detail.php?id=<?php echo $data['id'] ?> > <?php echo $data['id'] ?></a>
           </td>
           <td><?php echo h($_SESSION['name']) ?></td>
           <td><?php echo h($data['created_at']) ?></td>
           <td><?php echo h($data['updated_at']) ?></td>
           <td><?php echo h($data['title']) ?></td>
           <td><?php echo h($data['text']) ?></td>
           <td>
             <a href=delete_regi.php?id=<?php echo $data['id']?>>削除</a>
           </td>
        </tr>
      <?php } ?>
    </table>
    <br><br>

    <h1>過去1週間にコメントしたスレッド</h1>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>スレッド名</th>
      </tr>
      <?php
       while($data = $pre2->fetch(PDO::FETCH_ASSOC)){
         // echo"<pre>";
        // var_dump($data);
      ?>
         <tr>
           <td>
             <a href='thread_comment.php?id=<?php echo $data['thread_id'] ?>'><?php echo h($data['thread_id']) ?></a>
          </td>
           <td><?php echo h($data['tread_title']) ?></td>
         </tr>

         <?php
           }
         ?>
    </table>
  </body>
</html>
