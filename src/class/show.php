<?php
function class_show(): string
{

    $sql="select * from class order by prf";
    $mysqli=getMysqliObject();









    $res=  $mysqli->query($sql);
    $tr="";

    if ($res)
        if($res->num_rows>0)
            while ($row=$res->fetch_array()){

                    $tr=$tr."<tr>";
                    $tr=$tr."<td>".$row[0]."</td>";
                    $tr=$tr."<td>".$row[1]."</td>";
                    $tr=$tr."<td>".$row[2]."</td>";
                    $tr=$tr."<td>".'<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editcp" onclick="'."OnClickEdit('$row[0]','$row[1]','$row[2]')".'">编辑</button>'."</td>";
                    $tr=$tr." </tr>";
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
        <label  for="inputHelpBlock">班级编号(正整数)</label>
        <input type="text" id="iName" class="form-control" aria-describedby="helpBlock" disabled>
        <label  for="inputHelpBlock">所属专业</label>
        <input type="text" id="iName1" class="form-control" aria-describedby="helpBlock" >
        <label  for="inputHelpBlock">班级名称</label>
        <input type="text" id="iName2" class="form-control" aria-describedby="helpBlock">
        
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
        <label  for="inputHelpBlock">班级编号(正整数)</label>
        <input type="text" id="inputName" class="form-control" aria-describedby="helpBlock" >
        <label  for="inputHelpBlock">所属专业</label>
        <input type="text" id="inputName1" class="form-control" aria-describedby="helpBlock" >
        <label  for="inputHelpBlock">班级名称</label>
        <input type="text" id="inputName2" class="form-control" aria-describedby="helpBlock">
        
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
  <div class="panel-heading">班级管理</div>
  <div class="panel-body">
  
  <div class="row">
  <div class="col-md-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addplace">添加班级</button></div>
  <div class="col-md-8"></div>
  <div class="col-md-1">

  
  </div>

  </div>
   

    
    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>班级编号</th>
                  <th>所属专业</th>
                  <th>班级名称</th>
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
        let name2=document.getElementById("inputName2");
        let onc=document.getElementById('ddc');
        onc.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=7&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value+'&n5='+name2.value, false);
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
        let name2=document.getElementById("iName2");
        name.value=id;
        name1.value=value;
        name2.value=aid;

    }
    function OnClickUpdate(){
        let user=getCookie("username");
        let pasw=getCookie("password");
        let name=document.getElementById("iName");
        let name1=document.getElementById("iName1");
        let name2=document.getElementById("iName2");
        let onc=document.getElementById('edit');
        let onc1=document.getElementById('remove');
        onc.className+=' disabled';
        onc1.className+=' disabled';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './api/api.php?ca=8&n1='+user+'&n2='+pasw+'&n3='+name.value+'&n4='+name1.value+'&n5='+name2.value, false);
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
        xhr.open('GET', './api/api.php?ca=9&n1='+user+'&n2='+pasw+'&n3='+name.value, false);
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