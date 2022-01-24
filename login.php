<?php
$html= <<<EOT
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content="width=device-width,initial-scale=0.8, minimum-scale=0.8, maximum-scale=3"
          name="viewport"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta property="qc:admins" content="754034015366713545637571540352652"/>
    <meta property="wb:webmaster" content="1ad39047f32b5b6b"/>
    <link rel="icon" href="./img/favicon.ico">
    <title>统一登录入口</title>
</head>
<script type="text/javascript">
</script>
<link href="./css/login1.css" rel="stylesheet">
<link href="./css/custom.css" rel="stylesheet">
<script type="text/javascript">
    var secure = "true";
    var pwdDefaultEncryptSalt = "le5H9abvBfaaexXw";
</script>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/tools.js"></script>
<body onload="loadFresh();">
<div class="auth_bg">
    <img src="./img/bg22.png" alt="">
</div>
<div class="topbg">
    <img class="beij" src="./img/logobj.png" alt="">
    <img class="xiaohui" src="./img/tb.png" alt="">
    <img class="xxname" src="./img/logo22.png" alt="">
    <img class="sfrz" src="./img/tysfrz.png" alt="">
</div>
<div class="auth-language">Language:
    <div class="auth-language-select">
        <select id="language" onchange="changeLanguage()">
            <option value="zh_CN">简体中文</option>
            <option value="en">English</option>
        </select>
    </div>
</div>
<div class="auth_page_wrapper">
<div class="auth_logo">
    <img src="./img/login-logo.png" alt="logo"/>
</div>
<div class="auth_login_content" style="position: relative;">
    <div style="position:  absolute;bottom: 65px;left: 60px;color: #000;font-size: 18px;">统一登录入口，通信过程均为安全双向非对称加密。</div>
    <div class="auth_login_left">
        <img class="bjt" src="./img/bjt.png" alt="logo"/>
        <div class="auth_others">
            
                <h4></h4>
                <ul>
                        <li>
                            <a href="combinedLogin.do?type=weixin&success=https://authserver.dgpt.edu.cn/authserver/login?service=https%3A%2F%2Fehall.dgpt.edu.cn%2Fsso%2Flogin%3Fstate%3Dcjfn5yve"
                               style="display: inline-block;">
                                    <span class="auth_icon_bg">
                                        <i class="auth_icon_weixin"></i>
                                    </span>
                                <span class="auth_icon_text">使用微信登录</span>
                            </a>
                            
                        </li>
                    
                </ul>
            
        </div>
    </div>
    
        
        
    <div class="auth_login_right">
        <div class="auth_tab">

            <!-- 滑块验证码：-->
            
            <div class="auth_tab_links">
                <ul>
                    <li id="accountLogin" style="width:35%;" class="selected" tabid="01"><span>用户登录</span></li>
                </ul>
            </div>
            <div class="clearfloat"></div>
            <div class="auth_tab_content" style="min-height: 130px;">

                <div tabid="01" class="auth_tab_content_item">
                    <form id="casLoginForm" class="fm-v clearfix amp-login-form" role="form" action="route.php"  method="post">
                        

                        <p>
                            <i class="auth_icon auth_icon_user"></i>
                            <input id="username" name="username" placeholder="用户登录" class="auth_input" type="text" value=""/>
                            <span id="usernameError" style="display:none;" class="auth_error">请输入用户名</span>
                        </p>

                        <p>
                            <i class="auth_icon auth_icon_pwd"></i>
                            <input id="password" placeholder="密码" class="auth_input" type="password" value="" autocomplete="off"/>
                            <input id="passwordEncrypt" name="password" style="display:none;" type="text" value=""/>
                            <span id="passwordError" style="display:none;" class="auth_error">请输入密码</span>
                        </p>
                        <p id="cpatchaDiv">
                        </p>
                        <p>
                                <button 
                                        class="auth_login_btn primary full_width" onclick="uu()">登&emsp;录
                                </button>
                            
                        </p>
                        <a id="getBackPasswordMainPage" href="#" class="auth_login_forgetp">
                            <small>问题中心</small>
                        </a>


                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="hidenCaptchaDiv" style="display: none;">
    <i class="auth_icon auth_icon_bar"></i>
    <input type="text" placeholder="验证码" id="captchaResponse" name="captchaResponse"
           class="auth_input captcha-input"/>
    <img id="captchaImg" class="captcha-img" alt="验证码" title="验证码"/>
            <span style="cursor: pointer;color: #1dadff;margin-left: 2px;" id="changeCaptcha"
                  class="chk_text"></span>
    <span id="cpatchaError" style="display:none;" class="auth_error">请输入验证码</span>
</div>


<div class="clearfloat"></div>
<div class="bqsy">
    <img src="./img/bqsy.png" alt="logo"/>   
</div>
<div class="auth_login_footer">
    

 <span>
     Copyright&nbsp;©&nbsp;2021;&nbsp;东莞职业技术学院
 </span>

</div>


</div>


<script type="text/javascript" src="./js/icheck.min.js"></script>
<script type="text/javascript" src="./js/login.js"></script>
<script type="text/javascript" src="./js/login-wisedu_v1.0.js"></script>
    <script src="./js/jsencrypt.js"></script>
    <script src="./js/ende.js"></script>

    
     <script>
     
     if (!navigator.cookieEnabled){
         //alert("你的浏览器不支持或未开启Cookie功能！请开启.");
         window.location.href = 'informaction.html';
     }
     function uu(){
         var user=document.getElementById("username");
         var pasw=document.getElementById("password");
         var enctool=new JSEncrypt();
         enctool.setPublicKey(publicKeyStr);
         var enuser=enctool.encryptLong(user.value);
         enuser= urlsafeDecode(enuser);
         var enpasw=enctool.encryptLong(pasw.value);
         enpasw=urlsafeDecode(enpasw);
         //console.log(user.value);
         //console.log(enuser);
         document.cookie='SameSite=Lax';
         document.cookie="username="+enuser;
         document.cookie="password="+enpasw;

     }  
     if(!getCookie("username")==""){window.location.href = 'route.php';}

</script>
</body>

</html>

EOT;

echo $html;

