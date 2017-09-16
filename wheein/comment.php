<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

date_default_timezone_set("Asia/Taipei");

$dbhost = '127.0.0.1';
$dbuser = 'user';
$dbpass = 'password';
$dbname = 'dbname';

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($link,"utf8mb4");
//mysqli_query($link, "SET NAMES 'utf8'");

if ($_POST) {
    if (isset($_POST['name']) && $_POST['name'] && trim($_POST['name']) != '') {
        $name = trim($_POST['name']);
    } else {
        $name = '匿名蘿蔔';
    }

    if (isset($_POST['cheerup']) && $_POST['cheerup'] && trim($_POST['cheerup']) != '') {
        $cheerup = trim($_POST['cheerup']);
    } else {
        $cheerup = '';
    }

    if (isset($_POST['action']) && $_POST['action']) {
        $action = $_POST['action'];
    } else {
        $action = '';
    }

    switch ($action) {
        case 'init':
            // 方法一
//            try {
//                $file = file_get_contents('for_wheein.json', FILE_USE_INCLUDE_PATH);
//            } catch (Exception $e) {
//                return json_encode(array("success" => false,"msg" => "處理發生異常"));
//            }
//
//            $file = json_decode($file, true);
//
//            echo json_encode(array("success" => true, "msg" => "取得資料成功", "data" => $file));
//            break;


            // 方法二
            $response = array();
            $sql = "SELECT * FROM  `comment` ORDER BY id DESC";
            $result = mysqli_query($link, $sql);
            while($row = $result->fetch_assoc()){
                array_push($response, $row);
            }

            echo json_encode(array("success" => true, "msg" => "取得資料成功", "data" => $response));
            break;

        case 'insert':

            /*
            $response = array(
                "name" => $name,
                "cheerup" => $cheerup,
                "time" => date("Y-m-d H:i:s")
            );

            try {
                $file = file_get_contents('for_wheein.json', FILE_USE_INCLUDE_PATH);
            } catch (Exception $e) {
                echo json_encode(array("success" => false,"msg" => "處理發生異常"));
            }

            $comments = array();
            if ($file) { //如果有資料
                $comments = json_decode($file, true);
                if ($comments) {
                    array_push($comments, $response);
                }
            } else { //如果原先沒資料
                array_push($comments, $response);
            }


              $fp = fopen('for_wheein.json', 'w');
              fwrite($fp, json_encode($comments));
              fclose($fp);

*/

            $title = mysqli_real_escape_string($link, $name);
            $cheerup = mysqli_real_escape_string($link, $cheerup);

            if ($cheerup == '') {
                echo json_encode(array("success" => false, "msg" => "你的留言是空的喔！來寫點什麼吧＾＾"));
                return;
            }

            if ($cheerup != '') {
                $now = date('Y-m-d H:i:s');
                $insert_sql = "INSERT INTO `comment` (`name`, `content`, `time`) VALUES ('".$name."', '".$cheerup."', '".$now."' )";
                mysqli_query($link, $insert_sql);
            }

            $response = array();
            $sql = "SELECT * FROM  `comment` ORDER BY id DESC";
            $result = mysqli_query($link, $sql);
            while($row = $result->fetch_assoc()){
                array_push($response, $row);
            }

            //echo json_encode(array("success" => true,"msg" => "資料儲存成功", "data" => json_encode($comments)));
            echo json_encode(array("success" => true,"msg" => "資料儲存成功", "data" => $response));

    }

    mysqli_close($link);
}