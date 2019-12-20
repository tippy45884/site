<?php

require_once "servercon.php";
$logined = false;
session_start();




?>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>音楽</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
    </head>

<body>
    <div data-role="header">
    <a href="./index.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left">
                戻る
            </a>
            <h1>
                <font size="6">
                    animent
                </font>
            </h1>

    </div>
    <div data-role="content">

    <ul data-role="listview" data-inset="true">
                <li data-role="list-divider">
                    ランキング
                </li>
    <?php
    $array = array('op' => 'rank','type' => 2);
    $post_data = json_encode($array);
    $rank_list = conServer("product.php", $post_data);
    //var_dump($rank_list);
    
    if ($rank_list->result ==  true) {
        $rank_arr = $rank_list->value;

        for ($i=0; $i < count($rank_arr); $i++) { 
           
?>
<li>
                        <h3>
                            <?php 
                                echo $rank_arr[$i]->name;
                                echo "</p>";
                                echo $rank_arr[$i]->description;
                            ?>
                        </h3>
                </li>


<?php
        }
    }
?>
</ul>
<?php
            if (isset($_SESSION["logined"]) && $_SESSION["logined"] === true) {
                ?>
            
            <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">
                watching
            </li>
            <?php
    $array = array('op' => 'all','user_id' => $_SESSION["uid"]);
    $post_data = json_encode($array);
    $product_list = conServer("progress.php", $post_data);
    //var_dump($product_list);
    
    if ($product_list->result ==  true) {
        $products = $product_list->value;

        for ($i=0; $i < count($products); $i++) { 
            $product_id = $products[$i]->product_id;
                $array = array('op' => 'get','id' => $product_id);
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

</div>
    



</html>