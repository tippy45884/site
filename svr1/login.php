<?php
require_once "db_helper.php";
$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
 $un = $data['username'];
 $psw = $data['password'];

 if (strlen($un) > 0 && strlen($psw) > 0 ) {//empty string check
    $result = userLogin($un, $psw);
    if ($result[0] == true) {
        $r = array("result"=>true,"value"=>$result[1]);
    } else {
        $r = array("result"=>false,"value"=>$result[1]);
    }
}else {
    //one of it is empty
    $r = array("result"=>false,"value"=>"empty input.");
}
echo json_encode($r);

?>