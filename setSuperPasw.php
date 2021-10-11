<?php

function setPasw(){
    $html =<<<EOT
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">原密码</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputPasw" placeholder="原密码">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">新密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" placeholder="新密码">
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">新密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword1" placeholder="新密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default" onclick="OnClickAdd()">更改</button>
    </div>
  </div>
</form>
    <script src="./js/jsencrypt.js"></script>
    <script src="./js/ende.js"></script>
<script>
function OnClickAdd() {
    var user=getCookie("username");
    var npasw=getCookie("inputPassword");
    var npasw1=document.getElementById("inputPassword1");
     let xhr = new XMLHttpRequest();
     if (window.XMLHttpRequest)
     {   // code for IE7, Firefox, Opera, etc.
         xhr=new XMLHttpRequest();
     }
      else if (window.ActiveXObject)
     {   // code for IE6, IE5
         xhr=new ActiveXObject("Microsoft.XMLHTTP");
     }
     if (xhr!=null){
         xhr.open('GET', 'api/setPasw.php?user='+user.value+'&cp='+npasw.value+'&cp1='+npasw1.value, true);
         xhr.send();
         xhr.onreadystatechange = function(){
                if (xhr.readyState === 4 && xhr.status === 200) {
                     xhr.responseText;
                    // alert("timeout");
                }    
            }
         alert("timeout");
     }else {
         
         alert("该浏览器不支持XHR");
     }
     
    }
    function getCookie(name){
        var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]); 
        return false;
    }

   
</script>

EOT;


    return $html;
}