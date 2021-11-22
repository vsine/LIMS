<?php
function class_show(): string
{


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