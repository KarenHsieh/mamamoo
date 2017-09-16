<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


// /home/karenhsieh
$result = '';
$image = empty($_FILES['image']) ? '' : $_FILES['image'];

//var_dump($image);

//$upload = move_uploaded_file($image['tmp_name'], "/img/".$image['name']);

//var_dump($upload);

//return;

if (!empty($image))
{
    if ($image['size'] > 0)
    {
        $md5 = md5_file($image['tmp_name']);

        $destination = "/home/karenhsieh/img/" . $md5;


        $upload = move_uploaded_file($image['tmp_name'], $destination);

        //var_dump($upload);

        if (!empty($upload))
        {
            // here is the url to locate your image, you need to change it.
            $result = 'https://www.baidu.com/img/bd_logo1.png';
        }


    }
}

echo $result;
//echo "test";
