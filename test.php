<?php

#$a=array('title' => '老师','list'=>array(array("仓库",0,1,2),array("对外",7)));
$b=array(1=>'a',3=>array('b','c'));

if (array_key_exists(3,$b))
//$enc = json_encode($a);
echo 'ok';



$sql="select * from depot1";
$db_host=$GLOBALS['sqlHost'];
$db_user=$GLOBALS['sqlUser'];
$db_psw=$GLOBALS['sqlPass'];
$db_name=$GLOBALS['sqlDatabase'];
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
