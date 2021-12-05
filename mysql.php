<?php
require "config.php";
$db_user=$GLOBALS['sqlUser'];
$db_pass=$GLOBALS['sqlPass'];
$db_host=$GLOBALS['sqlHost'];
$db_database=$GLOBALS['sqlDatabase'];
$mysqli=new mysqli($db_host,$db_user,$db_pass,$db_database);
$res=$mysqli->query("");
setcookie("username","");
setcookie("password","");
header("Location:login.php");
echo $res."ds";

