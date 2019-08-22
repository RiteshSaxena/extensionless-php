<?php
if(empty($_SERVER['QUERY_STRING'])){
    $path = "home.php";
}else{
    $path = str_replace('/','.',$_SERVER['QUERY_STRING']).".php";
}

if (!file_exists($path)){
    http_response_code(404);
    die();
}

$TOP = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".dirname($_SERVER['SCRIPT_NAME']);

include $path;
