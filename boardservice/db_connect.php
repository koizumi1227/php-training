<?php
// DB接続
function db_connect(){
$user = 'root';
$pass = '';
$dsn = 'mysql:dbname=phpmytraining;host=localhost;charset=utf8mb4';
$dbh = new PDO($dsn, $user, $pass);
return $dbh;
}
// }
?>
