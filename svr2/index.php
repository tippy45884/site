<?php

require "servercon.php";
// $lifeTime = 30 * 24 * 3600;//save for 30days
// $sessionName = session_name();
// $sessionID = $_GET[$sessionName];
// session_id($sessionID);
// session_set_cookie_params($lifeTime);
$logined = false;
session_start();

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Animent
    </title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js">
    </script>
</head>

<body>
    <div data-role="page" data-theme="a">
        <div data-role="header">
            <h1>
                <font size="6">
                    animent
                </font>
            </h1>
            <?php
if (isset($_SESSION["logined"]) && $_SESSION["logined"] === true) {
    ?>
            <a href="./logout.php"
                class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-gear ui-btn-icon-left ui-btn-right">
                ログアウト
            </a>

            <?php
} else {
    $_SESSION["logined"] = false;
    ?>

            <a href="./login.php"
                class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-gear ui-btn-icon-left ui-btn-right">
                ログイン
            </a>

            <?php
}

?>

        </div>
        <div data-role="content">
            <ul data-role="listview" data-inset="true">
                <li data-role="list-divider">
                    Menu
                </li>
                <?php

$type_list = conServer("type.php", null);
//var_dump($type_list);
if ($type_list->result == true) {
    $type_arr = $type_list->value;
    for ($i = 0; $i < count($type_arr); $i++) {
        $url = $type_arr[$i]->url;
        echo '<li><a href="./type.php?id=' . $type_arr[$i]->id . '" data-transition="slide">';
        ?>
                <h3><?php echo $type_arr[$i]->name; ?></h3>
                </a>
                </li>


                <?php
}
}
?>
        </div>
        <div>

            <ul data-role="listview">
            <li data-role="list-divider">ニュース</li>
                <?php
$news_list = conServer("news.php", null);
//var_dump($news_list);

if ($news_list->result == true) {
    $news_arr = $news_list->value;
    for ($i = 0; $i < count($news_arr); $i++) {
        $date = $news_arr[$i]->date;
        ?>

            <li>
                <?php echo '<a href="' . $news_arr[$i]->url . '" >'; ?>
                    <h2><?php echo $news_arr[$i]->title; ?></h2>
                    <p><?php echo $news_arr[$i]->content; ?></p>
                    <p class="ui-li-aside"><?php echo '<time date00time="' . $date . '">' . $date . '</time>'; ?></p>
                </a>
            </li>

                <?php
}
}
?>

            </ul>
        </div>
        <div data-role="footer">
            <h4>
                <small>
                    Copyright &copy; 2019 Group7
                </small>
            </h4>
        </div>
    </div>

</body>

</html>