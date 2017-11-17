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


// id 9 のname の値をhogehogeへ変更
$sql = 'UPDATE testtables SET name=:name  WHERE id=:id ;';
$pre = $dbh->prepare($sql);

$pre->bindValue(':name', "hogehoge", PDO::PARAM_STR);
$pre->bindValue(':id', 9, PDO::PARAM_INT);

$r = $pre->execute();

if (false === $r) {
    echo 'データ挿入失敗';
    return ;
}

?>
