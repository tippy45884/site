<?php
require_once "servercon.php";
?>

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>新規登録</title>
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
            <a href="./login.php"
                class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-back ui-btn-icon-left ui-btn-left">
                戻る
            </a>
        </div>
        <?php

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
if (strlen($username) > 0 && strlen($password) > 0 && strlen($email)) {
    $array = array('username' => $username, 
                   'password' => md5($password), 
                   'email'=>$email);
    $post_data = json_encode($array);
    $result = conServer("register.php",$post_data);

    //var_dump($result);
    if ($result->result == true) { 
      //echo "register success";
      header('Location: ./index.php');
?>





<?php 
  } else if ($result->result == false){
    //echo "register failed";
    $alert = "<script type='text/javascript'> alert('Register failed, ". $result->value . ".');</script>";
            echo $alert;

}
} else{

}
 ?>


        <form action="" method="POST">

            <label for="username">ユーザー名</label>
            <input type="text" name="username">

            <label for="email">メールアドレス</label>
            <input type="email" name="email">

            <label for="password">パスワード</label>
            <input type="password" name="password">

            <button type="submit">登録</button>

            <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
        </form>

        <div data-role="footer">
            <h4>
                <small>
                    Copyright &copy; 2019 Group7
                </small>
            </h4>
        </div>
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