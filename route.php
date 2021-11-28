<?php
require "check.php";
$limit=checkUser();
if ($limit<9){
    header("Location:admin.php");
}
