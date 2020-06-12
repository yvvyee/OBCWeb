<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: main.php');
}
if (isset($_POST['btn_login'])) {
    login();
}
function login() {
    $user_id = $_POST['user_id'];
    $passwd = $_POST['passwd'];

    if ($user_id == "" || $passwd == "") {
        alert("请输入账号/密码");
        return;
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM user WHERE user_id='$user_id'";

    $res = mysqli_query($conn, $sql);
    if ($res->num_rows != 1) {
        alert("不存在的账户");
        return;
    }

    $row = mysqli_fetch_array( $res );
    if ($row['passwd'] != $passwd) {
        alert("密码不一致");
        return;
    }

    $_SESSION['user_id'] = $user_id;
    if (!isset($_SESSION['user_id'])) {
        alert("Session 生成失败");
        return;
    }
    header("location: ./main.php");
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Outlook Bone China</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="./img/icon/shortcut.JPG" rel="icon">
    <link href="./img/icon/shortcut.JPG" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="./lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="./lib/animate/animate.min.css" rel="stylesheet">
    <link href="./lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="./lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="./lib/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/obc_style.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="./lib/jquery/jquery.min.js"></script>
    <script src="./lib/jquery/jquery-migrate.min.js"></script>
    <script src="./lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./lib/easing/easing.min.js"></script>
    <script src="./lib/wow/wow.min.js"></script>
    <script src="./lib/superfish/hoverIntent.js"></script>
    <script src="./lib/superfish/superfish.min.js"></script>
    <script src="./lib/magnific-popup/magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="./contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="./js/main.js"></script>
</head>
<body>
<div class="intro-text" style="position: relative">

    <form method="POST" name="login_form">

        <div class="container" style="height: 100vh">
            <div class="center">
                <img src="./img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="width: 355px">
            </div>

            <div class="center" style="margin-top: 100px">
                <label>
                    <input style="font-size: 16pt;
                                              text-align: center;
                                              font-family: 微软雅黑;
                                              min-width: 247px;
                                              height: 41px"
                           type="text"
                           name="user_id"
                           size="30"
                           autocomplete="off"
                           placeholder="账号"/>
                </label>
            </div>

            <div class="center">

                <label>
                    <input style="font-size: 16pt;
                                                  text-align: center;
                                                  font-family: 微软雅黑;
                                                  min-width: 247px;
                                                  height: 41px"
                           type="password"
                           name="passwd" size="30"
                           autocomplete="off"
                           placeholder="密码"/>
                </label>
            </div>
            <div class="center">
                <input type="submit"
                       name="btn_login"
                       class="btn-get-started btn-success"
                       style="outline: none; font-size: 16pt"
                       value="登录">
            </div>
        </div>
    </form>
</div>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</body>
</html>