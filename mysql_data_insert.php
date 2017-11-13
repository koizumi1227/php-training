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

$name = 'aaa';
$dates = date('Y-m-d H:i:s');

$sql = 'INSERT INTO testtable(name,dates) VALUES(:name,:dates);';
$pre = $dbh->prepare($sql);

$pre->bindValue(':name', $name PDO::PARAM_STR);
$pre->bindValue(':dates', $dates PDO::PARAM_STR);

$r = $pre->execute();

if (false === $r) {
    echo 'データ挿入失敗';
    return ;
}

?>
