<?php
require_once "servercon.php";
$logined = false;
session_start();
$type_id = intval($_GET["id"]);
$type_list = conServer("type.php", null);
if ($type_list->result == true) {
    $type_name = $type_list->value[$type_id]->name;
} else {
    $type_name = "UNKNOW_TYPE";
}

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

<body>
    <div data-role="header">
        <a href="./" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left" data-rel="back" data-direction="reverse">
            戻る
        </a>
        <h1>
            <font size="6">
                <?php echo $type_name; ?>
            </font>
        </h1>

    </div>

    <div data-role="content">

        




        <?php
if (isset($_SESSION["logined"]) && $_SESSION["logined"] === true) {
    ?>

        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">
                自分の記録
            </li>
            <?php
$array = array('op' => 'all', 'user_id' => $_SESSION["uid"]);
    $post_data = json_encode($array);
    $product_list = conServer("progress.php", $post_data);
    //var_dump($product_list);

    if ($product_list->result == true) {
        $products = $product_list->value;

        for ($i = 0; $i < count($products); $i++) {
            $product_id = $products[$i]->product_id;
            $array = array('op' => 'get', 'id' => $product_id);
            $post_data = json_encode($array);
            $product_info = conServer("product.php", $post_data);
            //var_dump($product_info);
            if ($product_info->result == true) {

                ?>
            <li>
                <h3>
                    <?php
                    echo $product_info->value[0]->name;
                ?>
                </h3>
            </li>


            <?php
}
        }
    }
    ?>
        </ul>



        <?php
} else {
    $_SESSION["logined"] = false;
    ?>



        <?php
}

?>






<ul data-role="listview" data-inset="true">
            <li data-role="list-divider">
                ランキング
            </li>
            <?php
$array = array('op' => 'rank', 'type' => $type_id);
$post_data = json_encode($array);
$rank_list = conServer("product.php", $post_data);
//var_dump($rank_list);

if ($rank_list->result == true) {
    $rank_arr = $rank_list->value;

    for ($i = 0; $i < count($rank_arr); $i++) {

        ?>
            <li>

                <?php
                    echo '<a href="./product.php?id=' . $rank_arr[$i]->id . '" data-transition="slide" >';
        echo '<img src="' . $rank_arr[$i]->img_url . '" />';
        echo '<h3>' . $rank_arr[$i]->name . '</h3>';
        echo '<span class="ui-li-count">第' . $rank_arr[$i]->rank . '位</span>';
        //echo '<span class="ui-li-count">' . $rank_arr[$i]->score . '</span>';
        echo '</a>';
        ?>
            </li>
            <?php
}
}
?>
        </ul>

    </div>
</body>

</html>