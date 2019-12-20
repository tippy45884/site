<?php
require_once "db_helper.php";


$data = json_decode(file_get_contents('php://input'), true);
print_r($data);
 $un = $data['username'];
 $psw = $data['password'];
 $email = $data['email'];
$r = "";
if (strlen($un) > 0 && strlen($psw) > 0 && strlen($email) > 0 ) {//empty string check
    
    if ( checkUserNameVailed($un) == true && checkEmailVailed($email) == true ) {
        $result = addUserToDB($un, $psw, $email);
        if ($result[0] == true) {
            $r = array("result"=>true,
                        "value"=>"user added.");
        } else {
             $r = array("result"=>false,
                        "value"=>$result[1]);
        }
    }else{
        $r = array("result"=>false,
                    "value"=>"username or email is already been taken.");
    }

}else {
    $r = array("result"=>false,
                "value"=>"empty input.");
}
echo json_encode($r);
    
?>