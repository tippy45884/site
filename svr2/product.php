<?php
require_once "servercon.php";
$logined = false;
session_start();
$product_id = intval($_GET["id"]);
$array = array('op' => 'get', 'id' => $product_id);
$post_data = json_encode($array);

$product_list = conServer("product.php", $post_data);
?>




<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $type_name; ?></title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
</head>
<?php
if ($product_list->result != true) {
    $alert = "<script type='text/javascript'> alert('404 not found!');</script>";
    echo $alert;
    header('Location: ./index.php');
} else {
    $product = $product_list->value[0];
}
?>
<body>
    <div data-role="header">
        <a href="./"
            class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left" data-rel="back" data-direction="reverse">
            戻る
        </a>
        <h1>
            <font size="6">
            <?php echo $product->name; ?>
            </font>
        </h1>

    </div>

    <div data-role="content">
        <?php echo '<img src="' . $product->img_url . '" />'; ?>

    </div>

</body>

</html>