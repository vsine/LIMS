<?php
require "check.php";
$limit=checkUser();
if ($limit==5){
    header("Location:admin.php");
}
