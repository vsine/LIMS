<?php

require "config.php";
$db_user=$GLOBALS['sqlUser'];
$db_pass=$GLOBALS['sqlPass'];
$db_host=$GLOBALS['sqlHost'];
$db_database=$GLOBALS['sqlDatabase'];
$mysql=new mysqli($db_host,$db_user,$db_pass,$db_database);
$html= <<<EOT
<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/favicon.ico">
    <title>管理员登录</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/signin.css" rel="stylesheet">
    
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <!--[if lt IE 9]>
      <script src="./js/html5shiv.min.js"></script>
      <script src="./js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    
    <!--<img src="./img/logo.png" class="aligncenterss">-->
      <form class="form-signin">
        <h2 class="form-signin-heading">管理后台-请登录</h2>
        <h6></h6>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input  id="inputEmail" class="form-control" placeholder="请输入账号" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="请输入密码" required>
        <div class="checkbox">
          <label>
           
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="OnClick()">登录</button>
      </form>

    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
    
    
    <script src="./js/jsencrypt.js"></script>
    <script src="./js/ende.js"></script>
     <script>
     
     if (!navigator.cookieEnabled){
         //alert("你的浏览器不支持或未开启Cookie功能！请开启.");
         window.location.href = 'informaction.html';
     }
     function OnClick(){
         var user=document.getElementById("inputEmail");
         var pasw=document.getElementById("inputPassword");
         var enctool=new JSEncrypt();
         enctool.setPublicKey(publicKeyStr);
         var enuser=enctool.encryptLong(user.value);
         enuser= urlsafeDecode(enuser);
         var enpasw=enctool.encryptLong(pasw.value);
         enpasw=urlsafeDecode(enpasw);
         document.cookie="username="+enuser;
         document.cookie="password="+enpasw;
     }  
     if(!getCookie("username")==""){window.location.href = 'admin.php';}
      function getCookie(name)
    {
        var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]); 
        return false;
    }
</script>
  </body>
</html>
EOT;

echo  $html;