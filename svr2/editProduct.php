<?php
require_once "servercon.php";
$logined = false;
session_start();

$op = $_GET["op"];
$product = array('op' => $op);//init for nothing

if (op == 'add') {
    $type_id = intval($_GET["type_id"]);
}elseif ($op == 'edit') {
    $product_id = intval($_GET["product_id"]);
    $array = array('op' => 'get', 'id' => $product_id);
    $post_data = json_encode($array);

    $product_list = conServer("product.php", $post_data);
    if ($product_list->result == true) {
        $product = $product_list->value[0];
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php 
    if ($op == 'add') {
        echo '追加';
    }elseif ($op == 'edit') {
        echo '編集';
    }?></title>
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
            <?php 
    if ($op == 'add') {
        echo '追加';
    }elseif ($op == 'edit') {
        echo '編集';
    }?>
            </font>
        </h1>

    </div>

    <div data-role="content">
<?php
//var_dump($product);
$name = $_POST['name'];
$type = $_POST['type'];
$count = $_POST['count'];
$description = $_POST['description'];
$img_url = $_POST['img_url'];
if (strlen($name) > 0 &&
strlen($description) > 0 &&
strlen($img_url) > 0) {
    $array = array(
        'op' => 'add',
        'name' => $name, 
        'type' => $type,
        'count' => $count, 
        'img_url' => $img_url, 
        'description'=>$description);
        $add_result = conServer("product.php", $post_data);
        if ($add_result->result == true) {
            echo "追加または更新が行いました";
        }
}
?>

        <form action="" method="POST">

            <label for="name">名前</label>
            <?php echo '<input type="text" name="name" value="'.$product->name.'">'; ?>

            <div class="ui-field-contain">
                <label for="type">タイプ</label>
                <select id="type" name="type">
                    <?php $type_list = conServer("type.php", null);
                        if ($type_list->result == true) {
                            $type_arr = $type_list->value;
                            for ($i = 0; $i < count($type_arr); $i++) {
                                $selected = '';
                                if ($type_arr[$i]->id == $type_id || 
                                $type_arr[$i]->id == $product->type) {
                                    $selected = ' selected="selected" ';
                                }
                                echo '<option value="'.$type_arr[$i]->id.'" '.$selected.' >'.$type_arr[$i]->name.'</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <label for="count">話数</label>
            <?php echo '<input type="number" name="count" value="'.$product->count.'">';?>

            <div class="ui-field-contain">
                <label for="onair_day">曜日</label>
                <select id="onair_day" name="onair_day">
                <option value="-1" selected="selected">なし</option>
                <option value="1">月</option>
                <option value="2">火</option>
                <option value="3">水</option>
                <option value="4">木</option>
                <option value="5">金</option>
                <option value="6">土</option>
                <option value="0">日</option>
                </select>
            </div>

            <label for="description">説明：</label>
            <textarea id="description" name="description"><?php echo $product->description; ?></textarea>

            <label for="img_url">画像URL</label>
            <?php echo '<input type="number" name="img_url" value="'.$product->img_url.'">';?>

            <button type="submit">完了</button>
        </form>



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