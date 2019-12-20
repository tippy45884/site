<?php
require_once "db_helper.php";
$result = getTop10News();
if ($result[0] == true) {
    $r =  array("result"=>true,"value"=>$result[1]);
}else{
    $r =  array("result"=>false,"value"=>"get types list error");
}
echo json_encode($r);
?>