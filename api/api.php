<?php
require "../config.php";
require "../check.php";
$db_host=$GLOBALS['sqlHost']; //连接的服务器地址
$db_user=$GLOBALS['sqlUser']; //连接数据库的用户名
$db_psw=$GLOBALS['sqlPass']; //连接数据库的密码
$db_name=$GLOBALS['sqlDatabase']; //连接的数据库名称
$mysqli=new mysqli($db_host,$db_user,$db_psw,$db_name);

$ca=$_GET["ca"];
$user=$_GET["n1"];
$pasw=$_GET["n2"];
$limit=checkUserFromString($user,$pasw);
if ($limit==-1)
    exit();
//添加仓库
if ($ca==1&&$limit<6){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $sql="insert into place_a values ('$n3','$n4')";
    $mysqli->query($sql);
}
//更新仓库
if ($ca==2&&$limit<6){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $sql="update place_a set place='$n4' where id='$n3'";
    $mysqli->query($sql);
}
//删除仓库
if ($ca==3&&$limit<6){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $sql="delete from place_a where id='$n3'";
    $mysqli->query($sql);
}
//添加货位
if ($ca==4&&$limit<8){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n5=$_GET["n5"];
    $sql="insert into place_b values ('$n3','$n4','$n5')";
    $mysqli->query($sql);
}
//更新货位
if ($ca==5&&$limit<8){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n5=$_GET["n5"];
    $sql="update place_b set place='$n4', aid='$n5' where id='$n3'";
    $mysqli->query($sql);
}
//删除货位
if ($ca==6&&$limit<8){
    $n3=$_GET["n3"];
    $sql="delete from place_b where id='$n3'";
    $mysqli->query($sql);
}

echo "1";