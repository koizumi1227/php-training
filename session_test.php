
<?php
session_start();
if (isset($_SESSION['counter']) === false) {
    $counter = 0;
    $_SESSION['counter'] = 0;
} else {
    $counter = $_SESSION['counter'];
}
// sessionに新しい値を設定
$_SESSION['counter'] += 1;
if (0 == $counter) {
    echo "初めまして！";
} else {
    echo htmlspecialchars($counter, ENT_QUOTES, 'UTF-8');
    echo "回の訪問";
}
echo "<br>";
var_dump($_SESSION);
