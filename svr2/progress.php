<?php
require_once "servercon.php";
$logined = false;
session_start();
$status = intval($_GET["status"]);
$progress = intval($_GET["progress"]);
$product_id = intval($_GET["product_id"]);

$array = array(
    'op' => 'set',
    'user_id' => $_SESSION["uid"],
    'status' => $status,
    'progress' => $progress,
    'product_id' => $product_id);
$post_data = json_encode($array);
$result = conServer("progress.php", $post_data);
if ($result->result == true) {
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    //header("location:javascript://history.go(-1)");
    exit;
}else{
    echo $result->value;
}
?>
