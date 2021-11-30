<?php
function place_a(){

        $sql="select * from place_a";
        $db_host=$GLOBALS['sqlHost']; //连接的服务器地址
        $db_user=$GLOBALS['sqlUser']; //连接数据库的用户名
        $db_psw=$GLOBALS['sqlPass']; //连接数据库的密码
        $db_name=$GLOBALS['sqlDatabase']; //连接的数据库名称
        $mysqli=new mysqli($db_host,$db_user,$db_psw,$db_name);
        $res=  $mysqli->query($sql);
        $tr="";
        if ($res){

            if($res->num_rows>0){
                while ($row=$res->fetch_array()){
                    $tr=$tr."<tr>";
                    $tr=$tr."<td>".$row[0]."</td>";
                    $tr=$tr."<td>".$row[1]."</td>";
                    $tr=$tr."<td>".'<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editcp" onclick="'."OnClickEdit('$row[0]','$row[1]')".'">编辑</button>'."</td>";
                    $tr=$tr." </tr>";
                }

            }

        }

        $html=<<<EOR
<!--模态框-->
  <!-- Modal -->
<div class="modal fade" id="editcp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑仓库</h4>
      </div>
      <div class="modal-body">
       <label  for="inputHelpBlock">ID</label>
        <input type="text" id="iname" class="form-control" aria-describedby="helpBlock" disabled>
        <label  for="inputHelpBlock">仓库名称</label>
        <input type="text" id="iuser" class="form-control" aria-describedby="helpBlock">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="remove" onclick="OnClickRemove()">删除</button>
        <button id="edit" type="button" class="btn btn-primary" onclick="OnClickUpdate()">更新</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加仓库</h4>
      </div>
      <div class="modal-body">
      
        <label  for="inputHelpBlock">编号(正整数)</label>
        <input type="text" id="inputName" class="form-control" aria-describedby="helpBlock">
        <label  for="inputHelpBlock">仓库名</label>
        <input type="text" id="inputName1" class="form-control" aria-describedby="helpBlock">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="ddc" type="button" class="btn btn-primary" onclick="OnClickAdd()">添加</button>
      </div>
    </div>
  </div>
</div>

<br>
<div class="panel panel-primary">
  <div class="panel-heading">仓库管理</div>
  <div class="panel-body">
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addplace">添加</button>
    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>仓库编号</th>
                  <th>仓库名称</th>
                  <th>操作</th>                                                         
                </tr>
              </thead>
              <tbody>
                $tr
              </tbody>
            </table>
          </div>
  </div>
</div>
<script>
    function OnClickAdd(){

    let user=getCookie("username");
    let pasw=getCookie("password");
    let name=document.getElementById("inputName");
    let name1=document.getElementById("inputName1");
    
    let onc=document.getElementById('ddc');
    onc.className+=' disabled';
    let xhr = new XMLHttpRequest();
    xhr.open('GET', './api/api.php?ca=1&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value, false);
    xhr.send();
    if(xhr.status===200){
        location.reload();
    }else {
        location.reload();
    }

    
    }
    
    function OnClickEdit(id,value){
        let name=document.getElementById("iname");
        let name1=document.getElementById("iuser");
        name.value=id;
        name1.value=value;
    }
    function OnClickUpdate(){
        let user=getCookie("username");
        let pasw=getCookie("password");
        let name=document.getElementById("iname");
        let name1=document.getElementById("iuser");
        let onc=document.getElementById('edit');
        onc.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=2&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value, false);
        xhr.send();
        if(xhr.status===200){
            location.reload();
        }else {
            location.reload();
        }
        
    }
    function OnClickRemove(){
        let user=getCookie("username");
        let pasw=getCookie("password");
        let name=document.getElementById("iname");
        let name1=document.getElementById("iuser");
        let onc=document.getElementById('remove');
        onc.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=3&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value, false);
        xhr.send();
        if(xhr.status===200){
            location.reload();
        }else {
            location.reload();
        }
    }
    
    function getCookie(name){
        var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]); 
        return false;
    }




</script>
EOR;
        return $html;
}



function place_b(){
    $bt="全部";
    $sql="select * from place_b order by aid";
    $db_host=$GLOBALS['sqlHost']; //连接的服务器地址
    $db_user=$GLOBALS['sqlUser']; //连接数据库的用户名
    $db_psw=$GLOBALS['sqlPass']; //连接数据库的密码
    $db_name=$GLOBALS['sqlDatabase']; //连接的数据库名称
    $mysqli=new mysqli($db_host,$db_user,$db_psw,$db_name);
    if(isset($_REQUEST['fl'])){
        $gid=$_REQUEST['fl'];
        if ($gid==-1){
        }else{
            $sql="select * from place_b where aid='$gid'";
            $rsql="select place from place_a where id='$gid'";
            $res=  $mysqli->query($rsql);
            $row=$res->fetch_array();
            $bt=$row[0];
        }
    }
    $res=  $mysqli->query($sql);
    $tr="";
    $tr1="";
    $iss="";
    if ($res)
        if($res->num_rows>0)
            while ($row=$res->fetch_array()){
                $k=true;
                $iss=$row[2];
                $ck="";
                    $sql1="select place from place_a where id='$row[2]'";
                    $res1=  $mysqli->query($sql1);
                    if($res1->num_rows>0){
                        $row1=$res1->fetch_array();
                        $ck=$row1[0];
                    }
                    else{
                        $ck="未选择";
                        $iss="-1";
                        if (isset($_REQUEST['fl'])&&$_REQUEST['fl']==-1)
                            $bt="未选择";
                        $k=false;
                    }
                    if (isset($_REQUEST['fl'])&&$_REQUEST['fl']==-1&&$k==true){
                    }else{
                        $tr=$tr."<tr>";
                        $tr=$tr."<td>".$row[0]."</td>";
                        $tr=$tr."<td>".$row[1]."</td>";
                        $tr=$tr."<td>".$ck."</td>";
                        $tr=$tr."<td>".'<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editcp" onclick="'."OnClickEdit('$row[0]','$row[1]','$iss')".'">编辑</button>'."</td>";
                        $tr=$tr." </tr>";
                    }
            }
    $li="";
    $sql="select * from place_a";
    $res=  $mysqli->query($sql);
    if($res)
        if($res->num_rows>0)
            while ($row=$res->fetch_array()){
               $tr1=$tr1."<option value='$row[0]'>$row[1]</option>";
               $server= $_SERVER['PHP_SELF']."?".'&sett='.$_REQUEST['sett'];
               $server=$server.'&fl='.$row[0];
               $li=$li."<li><a href='$server'>$row[1]</a></li>";
            }
    $html=<<<EOR
  <!-- Modal -->
<div class="modal fade" id="editcp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑货位</h4>
      </div>
      <div class="modal-body">
        <label  for="inputHelpBlock">货位编号(正整数)</label>
        <input type="text" id="iName" class="form-control" aria-describedby="helpBlock" disabled>
        <label  for="inputHelpBlock">所属仓库</label>
        <select class="form-control" id="iisec">
            <option value="-1">请选择</option>
            $tr1
        </select>
        <label  for="inputHelpBlock">货位名称</label>
        <input type="text" id="iName1" class="form-control" aria-describedby="helpBlock">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="remove" onclick="OnClickRemove()">删除</button>
        <button id="edit" type="button" class="btn btn-primary" onclick="OnClickUpdate()">更新</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加货位</h4>
      </div>
      <div class="modal-body">
        <label  for="inputHelpBlock">货位编号(正整数)</label>
        <input type="text" id="inputName" class="form-control" aria-describedby="helpBlock" >
        <label  for="inputHelpBlock">所属仓库</label>
        <select class="form-control" id="isec">
            <option value="-1">请选择</option>
            $tr1
        </select>
        <label  for="inputHelpBlock">货位名称</label>
        <input type="text" id="inputName1" class="form-control" aria-describedby="helpBlock">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="ddc" type="button" class="btn btn-primary" onclick="OnClickAdd()">添加</button>
      </div>
    </div>
  </div>
</div>

<br>
<div class="panel panel-primary">
  <div class="panel-heading">货位管理</div>
  <div class="panel-body">
  
  <div class="row">
  <div class="col-md-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addplace">添加</button></div>
  <div class="col-md-8"></div>
  <div class="col-md-1">
     <!-- Small button group -->
    <div class="btn-group">
        <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           $bt <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
                    <li><a href='?sett=4'>全部</a></li>
                    <li><a href='?sett=4&fl=-1'>未选择</a></li>
            $li

        </ul>
    </div>
  
  </div>

  </div>
   

    
    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>货位编号</th>
                  <th>货位名称</th>
                  <th>所属仓库</th>
                  <th>操作</th>                                                         
                </tr>
              </thead>
              <tbody>
                $tr
              </tbody>
            </table>
          </div>
  </div>
</div>
<script>

    $("#isec").val("-1");
    function OnClickAdd(){
    let user=getCookie("username");
    let pasw=getCookie("password");
    let name=document.getElementById("inputName");
    let name1=document.getElementById("inputName1");
    let onc=document.getElementById('ddc');
    onc.className+=' disabled';
    let xhr = new XMLHttpRequest();
    xhr.open('GET', './api/api.php?ca=4&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value+'&n5='+$("#isec").val(), false);
    xhr.send();
    if(xhr.status===200){
        location.reload();
    }else {
        location.reload();
  }

    
    }
    
    function getCookie(name){
        var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]); 
        return false;
    }

    function OnClickEdit(id,value,aid){
        let name=document.getElementById("iName");
        let name1=document.getElementById("iName1");
        name.value=id;
        name1.value=value;
        $("#iisec").val(aid);

    }
    function OnClickUpdate(){
        let user=getCookie("username");
        let pasw=getCookie("password");
        let name=document.getElementById("iName");
        let name1=document.getElementById("iName1");
        let onc=document.getElementById('edit');
        let onc1=document.getElementById('remove');
        onc.className+=' disabled';
        onc1.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=5&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value+'&n5='+$("#iisec").val(), false);
        xhr.send();
        if(xhr.status===200){
            location.reload();
        }else {
            location.reload();
        }
        
    }
    function OnClickRemove(){
        let user=getCookie("username");
        let pasw=getCookie("password");
        let name=document.getElementById("iName");
        let onc=document.getElementById('edit');
        let onc1=document.getElementById('remove');
        onc.className+=' disabled';
        onc1.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=6&n1='+user+'&n2='+pasw+'&n3='+name.value, false);
        xhr.send();
        if(xhr.status===200){
            location.reload();
        }else {
            location.reload();
        }
    }

</script>
EOR;
    return $html;
}