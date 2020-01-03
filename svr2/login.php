<?php
require "servercon.php";


?>

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ログイン</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
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
            <a href="./" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left"  data-rel="back" data-direction="reverse">
                戻る
            </a>
        </div>
        <?php

$username = $_POST['username'];
$password = $_POST['password'];
if (strlen($username) > 0 && strlen($password) > 0) {
    $array = array('username' => $username, 
                   'password' => md5($password));
    $post_data = json_encode($array);
    
    $result = conServer("login.php",$post_data);
    
    //var_dump($result);
    if ($result->result == true) { 
            session_start();
            session_regenerate_id(true);
            $_SESSION["logined"] = true;
            $_SESSION["username"] = $username;
            var_dump($result->value);
            $_SESSION["uid"] = $result->value->id;
            //$alert = "<script type='text/javascript'> alert('Login success, now jump to home page.');</script>";
            //echo $alert;
            header('Location: ./index.php');
?>


<?php 
        
    } else if ($result->result == false){
        //echo "loginfailed";
?>     

    <script type="text/javascript" language="JavaScript">
        alert("ユーザー名/メールアドレスまたはパスワードが正しくありません。確認の上もう一度入力してください。");
    </script>


<?php 
    }
}
?>



        <h1>ようこそ、ログインはこちらから</h1>
        <form action="" method="POST">
            <label for="text">ユーザー名/メールアドレス</label>
            <input type="text" name="username">

            <label for="password">パスワード</label>
            <input type="password" name="password">

            <input type="submit" value="ログイン" />


        </form>

        <p>
            <a href="./register.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">新規登録</a>
        </p>

        <div data-role="footer">
            <h4>
                <small>
                    Copyright &copy; 2019 Group7
                </small>
            </h4>
        </div>


</body>

</html>