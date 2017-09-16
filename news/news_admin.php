<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// ==========[ BD INFO]=========
// admin
// coolsoadmin
// Pzk9MvbhCl6m

// user
// coolsouser
// i%0GeuKk6tgd
// ==============================

date_default_timezone_set("Asia/Taipei");

$dbhost = '127.0.0.1';
$dbuser = 'user';
$dbpass = 'password';
$dbname = 'dbname';

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($link,"utf8mb4");

var_dump($_POST['markup']);

if ($_POST) {
    if (isset($_POST['markup']) && $_POST['markup']) {
        $content = $_POST['markup'];
    } else {
        $content = '';
    }
}

//$title = mysqli_real_escape_string($link, $title);

if ($content != '') {
    $now = date('Y-m-d H:i:s');
    $insert_sql = "INSERT INTO `news` (`title`, `content`, `time`) VALUES ('test', '".$content."', '".$now."' )";
    mysqli_query($link, $insert_sql);
}

//$response = array();
//$sql = "SELECT * FROM  `comment` ORDER BY id DESC";
//$result = mysqli_query($link, $sql);
//while($row = $result->fetch_assoc()){
//    array_push($response, $row);
//}

mysqli_close($link);