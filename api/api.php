<?php
require "../config.php";
require "../check.php";
$mysqli = getMysqliObject();
$arr = getUserMarks($mysqli);
$ca=$_GET["ca"];
$user=$_GET["n1"];
$pasw=$_GET["n2"];
$user=$mysqli->real_escape_string($user);
$pasw=$mysqli->real_escape_string($pasw);
//$limit=checkUserFromString($user,$pasw);
//if ($limit==-1)
//    exit();


if ($ca==1&&set_key_exists(3,$arr)){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n3=$mysqli->real_escape_string($n3);
    $n4=$mysqli->real_escape_string($n4);
    $sql="insert into place_a values ('$n3','$n4')";
    $mysqli->query($sql);
}
//更新仓库
if ($ca==2&&set_key_exists(3,$arr)){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n3=$mysqli->real_escape_string($n3);
    $n4=$mysqli->real_escape_string($n4);
    $sql="update place_a set place='$n4' where id='$n3'";
    $mysqli->query($sql);
}
//删除仓库
if ($ca==3&&set_key_exists(3,$arr)){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n3=$mysqli->real_escape_string($n3);
    $n4=$mysqli->real_escape_string($n4);
    $sql="delete from place_a where id='$n3'";
    $mysqli->query($sql);
}
//添加货位
if ($ca==4){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n5=$_GET["n5"];
    $sql="insert into place_b values ('$n3','$n4','$n5')";
    $mysqli->query($sql);
}
//更新货位
if ($ca==5&&$limit<7){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n5=$_GET["n5"];
    $sql="update place_b set place='$n4', aid='$n5' where id='$n3'";
    $mysqli->query($sql);
}
//删除货位
if ($ca==6&&$limit<7){
    $n3=$_GET["n3"];
    $sql="delete from place_b where id='$n3'";
    $mysqli->query($sql);
}
//添加班级
if ($ca==7&&$limit<6){
    $n3=$_GET["n3"];//编号
    $n4=$_GET["n4"];//专业
    $n5=$_GET["n5"];//班级
    $sql="insert into class values ('$n3','$n4','$n5')";
    $mysqli->query($sql);
}
//更新班级
if ($ca==8&&$limit<6){
    $n3=$_GET["n3"];
    $n4=$_GET["n4"];
    $n5=$_GET["n5"];
    $sql="update class set prf='$n4', name='$n5' where id='$n3'";
    $mysqli->query($sql);
}
//删除班级
if ($ca==9&&$limit<7){
    $n3=$_GET["n3"];
    $sql="delete from class where id='$n3'";
    $mysqli->query($sql);
}
echo '205';