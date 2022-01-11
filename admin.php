<?php
require_once "config.php";
require "check.php";
require "./src/place/place.php";
require "./src/libary/libary.php";
//require "home.php";
require "./src/user/setSuperPasw.php";
require "./src/class/show.php";
$mlist=array(0=>'物品库存',1=>'出库单',2=>'入库单',3=>'仓库管理',4=>'货位管理',5=>'班级管理',6=>'账号管理',7=>'test',8=>'test');
$mysqli=getMysqliObject();
$limit=checkUser($mysqli);
$name= getUserName($mysqli);
$arr = getUserMarks($mysqli);
$name=$name.$arr['title'];
$navbar="";
$sidebar="";
$sel=$arr['list'][0][1];
 foreach ($arr['list'] as $key=>$value){
     $sidebar=$sidebar."<p class='bg-info'>$value[0] </p>";
     $sidebar=$sidebar.'<ul class="nav nav-sidebar">';
     foreach ($value as $key=>$value)
     {
         if($key>0){
             $navbar=$navbar."<li><a href='?sett=$value'>$mlist[$value]</a></li>";
             if ($value==1)
                 $sidebar=$sidebar."<li id='sett$value'><a href='?sett=$value'>$mlist[$value] <span class='badge badge-info' style='background-color: #d9534f'>2</span></a>  </li>";
             else
                 $sidebar=$sidebar."<li id='sett$value'><a href='?sett=$value'>$mlist[$value] </a>  </li>";
         }

     }
     $sidebar=$sidebar.'</ul>';
 }
$context="he";

if (isset($_REQUEST['sett'])&&set_key_exists($_REQUEST['sett'],$arr)){
   # $array[]='class="active"';
    $sel=$_REQUEST['sett'];
    if($_REQUEST['sett']==0){
        //仓库
        $context=libary($limit);
    }
    if($_REQUEST['sett']==1){
        //出库
        $context="info";
    }
    if($_REQUEST['sett']==2){
        //入库
        $context="info";
    }
    if($_REQUEST['sett']==3){
        $context=place_a();
    }
    if($_REQUEST['sett']==4){
        $context=place_b();
    }
    if($_REQUEST['sett']==5){
        $context=class_show();
    }
    if($_REQUEST['sett']==6){
        $context='info';
    }
    if($_REQUEST['sett']==7){
        $context='info';
    }
    if($context=='he'){
        $context='<div class="alert alert-danger" role="alert"><strong>注意!   </strong>非法访问。</div>';
    }elseif ($context=='info'){
        $context='<div class="alert alert-warning" role="alert"><strong>注意!   </strong>此功能暂未开放。</div>';
    }
}else {
    $context=libary($limit);
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
    <title>实训基地管理系统</title>
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
                $navbar
            <li><a href="" data-toggle="modal" data-target="#myModal">登出</a></li>
          </ul>
         
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
           $sidebar
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
           $context
        </div>
      </div>
    </div>
    <script>
    $("#sett"+$sel).attr("class","active");
     function OnClick(){
         document.cookie="username=";
         document.cookie="password=";
         document.cookie='SameSite=Lax';
         location.reload();
     }  
</script>



<footer class="navbar-fixed-bottom text-center">
  <div class="container">
    <p class="text-muted"><p class="text-muted">&copy; Copyright (c) 2021 电子信息学院实训管理系统-调试站点.</p><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44098102441122" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="./img/gan.png" style="float:left;"/>粤公网安备 44098102441122号</a></p>
    <a style="text-align:center" href="http://beian.miit.gov.cn/" class="theme-link" rel="noopener" target="_blank">粤ICP备19125824号</a> </p>
  </div>
</footer>
  </body>

</html>
EOT;

echo $html;
