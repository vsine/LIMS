<?php

require "check.php";
require "./src/place/place.php";
require "./src/libary/libary.php";
//require "home.php";
require "./src/user/setSuperPasw.php";
require "./src/class/show.php";
$limit=checkUser();
if (!($limit<8)){
    header("Location:route.php");
}


$name= getUserName();
switch ($limit){
    case '7':
        $name=$name.'老师';
        break;
    case 6:
        $name=$name.'协管员';
        break;
    case 5:
        $name=$name.'库房管理员';
        break;


}


$context="he";
$array=array('','','','','','','','');
if (isset($_REQUEST['sett'])&&$_REQUEST['sett']<8){

    $array[$_REQUEST['sett']]='class="active"';

    if($_REQUEST['sett']==0){
        $context=libary();
    }
    if($_REQUEST['sett']==1){
        $context="info";
    }
    if($_REQUEST['sett']==2){
        $context="info";
    }
    if($_REQUEST['sett']==3&&$limit<6){
        $context=place_a();
    }
    if($_REQUEST['sett']==4&&$limit<7){
        $context=place_b();
    }
    if($_REQUEST['sett']==5&&$limit<6){
        $context=class_show();
    }
    if($_REQUEST['sett']==6){
        $context=setPasw();
    }
    if($_REQUEST['sett']==7){
        $context=setPasw();
    }
    if($context=='he'){
        $context='<div class="alert alert-danger" role="alert"><strong>注意!   </strong>当前账号无权访问该功能。</div>';
    }elseif ($context=='info'){
        $context='<div class="alert alert-info" role="alert"><strong>注意!   </strong>此功能暂未开放。</div>';
    }
}else{
    $array[0]='class="active"';
    $context=libary();
}
$html=<<<EOT

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/favicon.ico">
    <title>库存管理控制台</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <!--[if lt IE 9]>
      <script src=".js/html5shiv.min.js"></script>
      <script src=".js/respond.min.js"></script>
    <![endif]-->
    
    <script src="./js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="./js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
    
  </head>
  <body>
  
  
    <!--模态框-->
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">登出</h4>
      </div>
      <div class="modal-body">
        您确定要登出吗？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="OnClick()">确定</button>
      </div>
    </div>
  </div>
</div>
  <!--模态框-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">您好，$name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="?sett=0"  >物品库存</a></li>
            <li><a href="?sett=1"  >出库单</a></li>
            <li><a href="?sett=2"  >入库单</a></li>
            <li><a href="?sett=3"  >地点管理</a></li>
            <li><a href="?sett=4"  >分类管理</a></li>
            <li><a href="?sett=5"  >账号管理</a></li>
            <li><a href="?sett=6"  >超级管理员密码修改</a></li>
            <li><a href="" data-toggle="modal" data-target="#myModal">登出</a></li>
          </ul>
         
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li $array[0] ><a href="?sett=0">物品库存<span class="sr-only">(current)</span></a></li>
            <li $array[1]><a href="?sett=1">出库单</a></li>
            <li $array[2]><a href="?sett=2">入库单</a></li>
            <li $array[3]><a href="?sett=3">仓库管理</a></li>
            <li $array[4]><a href="?sett=4">货位管理</a></li>
            <li $array[5]><a href="?sett=5">班级管理</a></li>
            
          </ul>
          <ul class="nav nav-sidebar">
            <li $array[6]><a href="?sett=6">账号管理</a></li>
            <li $array[7]><a href="?sett=7">管理员密码修改</a></li>
            
      
          </ul>
         
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
       
           $context
       
        
        </div>
      </div>
    </div>
    <script>
    
     function OnClick(){
         document.cookie="username=";
         document.cookie="password=";
         location.reload();
     }  
</script>



<footer class="navbar-fixed-bottom text-center">
  <div class="container">
    <p class="text-muted"><p class="text-muted">&copy; Copyright (c) 2021 电子信息学院实训管理系统-调试站点.  @Author:毛小文</p><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44098102441122" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="./img/gan.png" style="float:left;"/>粤公网安备 44098102441122号</a></p>
    <a style="text-align:center" href="http://beian.miit.gov.cn/" class="theme-link" rel="noopener" target="_blank">粤ICP备19125824号</a> </p>
  </div>
</footer>
  </body>

</html>
EOT;

echo $html;
