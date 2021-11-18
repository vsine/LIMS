<?php
require "config.php";
require "RsaUtils.php";
function checkUser(){
    $db_user=$GLOBALS['sqlUser'];
    $db_pass=$GLOBALS['sqlPass'];
    $db_host=$GLOBALS['sqlHost'];
    $db_database=$GLOBALS['sqlDatabase'];
    $mysqli=new mysqli($db_host,$db_user,$db_pass,$db_database);
    if(isset($_COOKIE["username"])&&isset($_COOKIE["password"])){
        $user=$_COOKIE["username"];
        $pasw=$_COOKIE["password"];
        $user=str_replace(' ','+',$user);
        $pasw=str_replace(' ','+',$pasw);
        $deuser=RsaUtils::privateDecrypt($user,$GLOBALS['privatekey']);
        $depasw=RsaUtils::privateDecrypt($pasw,$GLOBALS['privatekey']);
        $depasw=str_replace(' ','+',$depasw);
        $sql="select password from users where username='$deuser'";
        $redata=$mysqli->query($sql);
        $row=$redata->fetch_array();
        if($redata->num_rows<1)
        {   setcookie("username","");
            setcookie("password","");
            header("Location:index.php");
            exit();
        }
        if ($row[0]==$depasw)
        {
            $sql="select limits from users where username='$deuser'";
            $redata=$mysqli->query($sql);
            $row=$redata->fetch_array();
            return $row[0];
        }else{
            setcookie("username","");
            setcookie("password","");
            header("Location:index.php");
            exit();
        }
    }else{
        setcookie("username","");
        setcookie("password","");
        header("Location:index.php");
        exit("未登录");
    }
}

function checkUserFromString($user,$pasw){
    $db_user=$GLOBALS['sqlUser'];
    $db_pass=$GLOBALS['sqlPass'];
    $db_host=$GLOBALS['sqlHost'];
    $db_database=$GLOBALS['sqlDatabase'];
    $mysqli=new mysqli($db_host,$db_user,$db_pass,$db_database);
    if(isset($_COOKIE["username"])&&isset($_COOKIE["password"])){
        $user=str_replace(' ','+',$user);
        $pasw=str_replace(' ','+',$pasw);

        $deuser=RsaUtils::privateDecrypt($user,$GLOBALS['privatekey']);
        $depasw=RsaUtils::privateDecrypt($pasw,$GLOBALS['privatekey']);

        $sql="select password from users where username='$deuser'";
        $redata=$mysqli->query($sql);
        $row=$redata->fetch_array();
        if($redata->num_rows<1)
        {
            return -1;

        }
        if ($row[0]==$depasw)
        {
            $sql="select limits from users where username='$deuser'";
            $redata=$mysqli->query($sql);
            $row=$redata->fetch_array();
            //echo $row[0];
            return $row[0];
        }else{
            return -1;

        }
    }else{
          return -1;

    }

}