<?php
require "../config.php";
$db_host=$GLOBALS['sqlHost']; //连接的服务器地址
$db_user=$GLOBALS['sqlUser']; //连接数据库的用户名
$db_psw=$GLOBALS['sqlPass']; //连接数据库的密码
$db_name=$GLOBALS['sqlDatabase']; //连接的数据库名称
$mysqli=new mysqli($db_host,$db_user,$db_psw,$db_name);
echo "1";