<?php
require_once "db_helper.php";
$data = json_decode(file_get_contents('php://input'), true);
$op = $data['op'];
$user_id = $data['user_id'];

if ($op === 'get') {
    $product_id = $data['product_id'];
    $result = getProgress($user_id, $product_id);
    if ($result[0] == true) {
        $r = array("result" => true, "value" => $result[1]);
    } else {
        $r = array("result" => false, "value" => "get user progress error.");
    }
} elseif ($op === 'set') {
    $product_id = $data['product_id'];
    $progress = $data['progress'];
    $status = $data['status'];

    //check progress record exists
    $result = getProgress($user_id, $product_id);
    if (count($result[1]) > 0 && $result[0] == true ) {
        //update record
        $result = setProgress($user_id, $product_id, $progress, $status);
        if ($result[0] == true) {
            $r = array("result" => true, "value" => $result[1]);
        } else {
            $r = array("result" => false, "value" => "set user progress error:" . $result[1]);
        }
    } else {
        //add record
        $result = addProgress($user_id, $product_id, $progress, $status);
        if ($result[0] == true) {
            $r = array("result" => true, "value" => $result[1]);
        } else {
            $r = array("result" => false, "value" => "add user progress error:" . $result[1]);
        }
    }

} else if ($op === 'all') {
    $type = $data['type_id'];
    $result = getUserProduct($user_id, $type);
    if ($result[0] == true) {
        $r = array("result" => true, "value" => $result[1]);
    } else {
        $r = array("result" => false, "value" => "get user product error.");
    }

} else {
    $r = array("result" => false, "value" => "unknown operation command.");
}
echo json_encode($r);