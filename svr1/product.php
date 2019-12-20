<?php
require_once "db_helper.php";
$data = json_decode(file_get_contents('php://input'), true);
$op = $data['op'];

if ($op === 'add') {
    $name = $data['name'];
    $type = $data['type'];
    $count = $data['count'];
    $on_air = $data['on_air'];
    
    $description = $data['description'];

    $result = addProducts($name,$type,$count,$on_air,$description);
    if ($result[0] == true) {
    	$r = array("result"=>true,"value"=>"product added.");
    }else{
    	$r = array("result"=>false,"value"=>"add product error.");
    }
}else if($op === 'rank'){
    $type = $data['type'];
	$result = getTop10Product($type);
	if ($result[0] == true) {
		$r = array("result"=>true,"value"=>$result[1]);
	}else{
		$r = array("result"=>false,"value"=>"get top 10 product error.");
    }
    

}else if($op === 'get'){
    $id = $data['id'];
	$result = getProductWithID($id);
	if ($result[0] == true) {
		$r = array("result"=>true,"value"=>$result[1]);
	}else{
		$r = array("result"=>false,"value"=>"get product error.");
    }
} else {
    $r = array("result"=>false,"value"=>"unknow operation command.");
}

echo json_encode($r);




?>




