<?php
require_once "servercon.php";
$logined = false;
session_start();

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Profile</title>
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
                マイページ
            </font>
        </h1>
    </div>

    <div data-role="content">


        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">
                自分の情報
            </li>
            <li>
                ユーザ名：<?php echo $_SESSION["username"]; ?>
            </li>
            <li>
                ユーザID：<?php echo $_SESSION["uid"]; ?>
            </li>
        </ul>


        <div class="ui-grid-solo" style="text-align: center;">
            <a href="./logout.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">ログアウト</a>
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