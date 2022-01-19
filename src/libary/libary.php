<?php
function libary($limit){

    $sql = "select * from depot1";
    $mysqli = getMysqliObject();
    $arr = getUserMarks($mysqli);
    $isedit =$arr["editlibary"];
    $res = $mysqli->query($sql);
    $tr = "";
    if ($res)
        if($res->num_rows>0)
            while ($row=$res->fetch_array()){
                $tr = $tr."<tr>";
                $tr = $tr."<td>".$row[1]."</td>";
                $tr = $tr."<td>".$row[3]."</td>";
                $tr = $tr."<td>".$row[4]."</td>";
                $tr = $tr."<td>".$row[5]."</td>";
                $tr = $tr."<td>".$row[6].$row[7]."</td>";
                $tr = $tr."<td>".$row[2]."</td>";
                $res2 = $mysqli->query("select aid from place_b where id=$row[8]");
                if ($res2->num_rows>0){
                    if ($row2=$res2->fetch_array())
                        $res2 = $mysqli->query("select place from place_a where id=$row2[0]");
                        if ($res2->num_rows>0) {
                            if ($row2 = $res2->fetch_array())
                                $tr = $tr . "<td>" . $row2[0] . "</td>";
                        }else{
                            $tr = $tr . "<td>" ."未选择". "</td>";
                        }
                }else{
                        $tr = $tr . "<td>" ."未选择". "</td>";
                }

                $tr = $tr."<td>".$row[9]."</td>";
                $tr = $tr."<td>".$row[10]."</td>";
                //操作
                $tr = $tr."<td>"."<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#editcp\" id=\"sel\">选择</button>"."</td>";
                $tr = $tr."</tr>";
            }
    $hcontent="";
    if($isedit){
        $hcontent="123";
    }
    $html=<<<EOR
  <!-- 模态框 -->
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
    <!-- 模态框 end-->
    
    <!-- 模态框 -->
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
    <!-- 模态框 end-->

<br>
<div class="panel panel-success">
  <div class="panel-heading"><h5>仓库库存管理</h5>
  $hcontent
  </div>
  <div class="panel-body">

   
    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>物料名称</th>
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
    
    $(document).ready(function() {
      $("#sel").click(function() {
        //get request  .
        $.get("./api/api.php?ca=0&n1=2&n2=3",function (data,state,xhr){
            //只有成功才执行
            alert(data);
        }).error(function (xhr,status,info){
            //只有失败才执行
            alert(status);
        });
        //get request  end.
 
      });
    });
</script>
EOR;
    return $html;
}