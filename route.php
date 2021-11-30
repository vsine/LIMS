<?php
require "check.php";
$limit=checkUser();
if ($limit<8){
    header("Location:admin.php");
}