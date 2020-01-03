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
    <title>詳細</title>
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
        <a href="./" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left"
            data-rel="back" data-direction="reverse">
            戻る
        </a>
        <h1>
            <font size="6">
                詳細
            </font>
        </h1>

    </div>

    <div data-role="content">

        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider"><?php echo $product->name; ?></li>

            <li>
                <div class="ui-grid-b">
                    <div class="ui-block-a"></div>
                    <div class="ui-block-b" style="max-width: 500px;">
                        <?php echo '<img src="' . $product->img_url . '" style="position: relative; width: 100%;"/>'; ?>
                    </div>
                    <div class="ui-block-c"></div>
                </div>
            </li>
            <li>話数：<?php echo $product->count; ?></li>
            <?php if($product->onair_day >=0){?>
            <li>再生日：<?php
switch ($product->onair_day) {
    case 0:
        echo '日曜日';
        break;
    case 1:
        echo '月曜日';
        break;
    case 2:
        echo '火曜日';
        break;
    case 3:
        echo '水曜日';
        break;
    case 4:
        echo '木曜日';
        break;
    case 5:
        echo '金曜日';
        break;
    case 6:
        echo '土曜日';
        break;
    default:
        echo '--';
        break;
}
?></li>
<?php } ?>
            <li>評価：<?php echo $product->score; ?></li>
            <li>ランキング：第<?php echo $product->rank; ?>位</li>
            <li>紹介：<font style="white-space:normal;"><?php echo $product->description; ?></font>
            </li>
        </ul>




        <?php if (isset($_SESSION["logined"]) && $_SESSION["logined"] === true) {
            $array = array('op' => 'get','product_id'=>$product->id, 'user_id' => $_SESSION["uid"] );
            $post_data = json_encode($array);
            $progress = conServer("progress.php", $post_data);
            //var_dump($progress);
   ?>
        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">状態</li>

            
            <li>
            <div class="ui-grid-solo" style="text-align: center;">
                <div data-role="controlgroup" data-type="horizontal">
                    <a href="#" data-role="button">予定</a>
                    <a href="#" data-role="button">進行中</a>
                    <a href="#" data-role="button">完成</a>
                    <a href="#" data-role="button">なし</a>
                    </div>
                </div>
            </li>

<?php 
if($product->count > 0){
if($progress->result == true){ ?>
            <li>
            <div class="ui-grid-c">
                <div class="ui-block-a"><button class="minus">－</button></div>
                <div class="ui-block-b"><?php echo '<input type="number" value="'. $progress->value[0]->progress .'" readonly class="number"></div>';?>
                <div class="ui-block-c"><button class="plus">＋</button></div>
                <div class="ui-block-d"><button class="save">保存</button></div>
            </div>
            </li>

            
        </ul>
        <?php
}
}
} else {
    $_SESSION["logined"] = false;
    ?>

        <?php
}
?>



    </div>
</body>

</html>