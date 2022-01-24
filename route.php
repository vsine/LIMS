<?php
require "./lib/posix.php";
$mysqli=getMysqliObject();
$limit=checkUser($mysqli);
if ($limit<8){
    header("Location:admin.php");
}