<?php

$user = 'root';
$pass = '';
$dsn = 'mysql:dbname=phpmytraining;host=localhost;charset=utf8mb4';
//
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "connect error!! (" , $e->getMessage() , ")";
    return ;
}
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
date_default_timezone_set('Asia/Tokyo');


// $nameにaaa 、 $created_atに登録した日時のデータをそれぞれ入れる
$name = 'aaa';
$created_at = date('Y-m-d H:i:s');

$sql = 'INSERT INTO testtables(name,created_at) VALUES(:name,:created_at);';
$pre = $dbh->prepare($sql);

$pre->bindValue(':name', $name, PDO::PARAM_STR);
$pre->bindValue(':created_at', $created_at, PDO::PARAM_INT);

$r = $pre->execute();

if (false === $r) {
    echo 'データ挿入失敗';
    return ;
}

?>
