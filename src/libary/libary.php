<?php
function libary($limit){

    $sql="select * from depot1";
    $db_host=$GLOBALS['sqlHost']; //连接的服务器地址
    $db_user=$GLOBALS['sqlUser']; //连接数据库的用户名
    $db_psw=$GLOBALS['sqlPass']; //连接数据库的密码
    $db_name=$GLOBALS['sqlDatabase']; //连接的数据库名称
    $mysqli=new mysqli($db_host,$db_user,$db_psw,$db_name);
    $res=  $mysqli->query($sql);
    $tr="";
    if ($res)
        if($res->num_rows>0)
            while ($row=$res->fetch_array()){
                $tr=$tr."<tr>";
                $tr=$tr."<td>".$row[0]."</td>";
                $tr=$tr."<td>".$row[3]."</td>";
                $tr=$tr."<td>".$row[4]."</td>";
                $tr=$tr."</tr>";
            }




    $html=<<<EOR
<!--模态框-->
  <!-- Modal -->
<div class="modal fade" id="editcp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑班级</h4>
      </div>
      <div class="modal-body">
       <label  for="inputHelpBlock">班级名称</label>
        <input type="text" id="iname" class="form-control" aria-describedby="helpBlock">
        <label  for="inputHelpBlock">班级账号</label>
        <input type="text" id="iuser" class="form-control" aria-describedby="helpBlock" disabled>
        <label  for="inputHelpBlock">班级密码</label>
        <input type="text" id="ipasw" class="form-control" aria-describedby="helpBlock">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="remove">删除</button>
        <button id="edit" type="button" class="btn btn-primary" onclick="">更新</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加地点</h4>
      </div>
      <div class="modal-body">
        <label  for="inputHelpBlock">地点名</label>
        <input type="text" id="inputName" class="form-control" aria-describedby="helpBlock">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="ddc" type="button" class="btn btn-primary" onclick="OnClickAdd()">添加</button>
      </div>
    </div>
  </div>
</div>

<br>
<div class="panel panel-success">
  <div class="panel-heading">仓库库存管理</div>
  <div class="panel-body">

   
    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>名称</th>
                  <th>品牌</th>
                  <th>规格型号</th>
                  <th>数量</th>
                  <th>类别</th>
                  <th>货仓/货位</th>
                  <th>供应商</th>
                  <th>备注</th>
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
    function OnClickAdd() {
    var user=getCookie("username");
    var pasw=getCookie("password");
    var name=document.getElementById("inputName");
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'AddClass.php?cu='+cpuser.value+'&cp='+cppasw.value+'&cn='+cpname.value, true);
    xhr.send();
    var onc=document.getElementById('ddc');
    onc.className+=' disabled';
    location.reload();
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