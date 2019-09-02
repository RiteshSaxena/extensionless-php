<?php
$basename = "";
if(dirname($_SERVER['SCRIPT_NAME']) != '/'){
    $basename = dirname($_SERVER['SCRIPT_NAME']);
}

$full_query = explode("?", str_replace($basename,"",$_SERVER['REQUEST_URI']));

if($full_query[0] == '/' || $full_query[0] == '/index.php'){
    $actual_path = "home.php";
}else{
    $actual_path = str_replace('/','.',substr($full_query[0],1)).".php";
}

if (!file_exists($actual_path)){
    http_response_code(404);
    die();
}

if(isset($full_query[1])){
    foreach (explode("&",$full_query[1]) as $args){
        $args_pair = explode("=",$args);
        $_GET[$args_pair[0]] = $args_pair[1];
    }
}

$TOP = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $basename;

include $actual_path;
