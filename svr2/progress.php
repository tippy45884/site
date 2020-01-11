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
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>操作</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>


</head>
<body>
    <div data-role="header">
        <a href="./" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left"
            data-rel="back" data-direction="reverse">
            戻る
        </a>
        <h1>
            <font size="6">
                操作
            </font>
        </h1>

    </div>

    <div data-role="content">
<?php
if ($result->result == true) {
    //header('Location: ' . $_SERVER["HTTP_REFERER"]);
    //header("location:javascript://history.go(-1)");
    echo "状態が更新しました";
    exit;
}else{
    echo $result->value;
}
?>
    	</div>
        <div data-role="footer">
        <h4>
            <small>
                Copyright &copy; 2019 Group7
            </small>
        </h4>
    </div>
</body>

</html>