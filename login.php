<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outlook Bone China</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Popup container */
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        /* The actual popup (appears on top) */
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class when clicking on the popup container (hide and show the popup) */
        .popup .show {
            visibility: revert;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity:1 ;}
        }
    </style>



</head>

<body>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <h1><a>Outlook<br>Bone<br>China</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
        </div>
    </div>
</header>
    <section id="intro">
            <div class="intro-text">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <h2>欢迎!</h2>
                <p>世上唯一的快乐就是开始</p>

                <form method="POST" name="login_form">
                    <div class="popup">
                        <label>
                            <input type="text" name="user_id" placeholder="ID:" size="30" autocomplete="off" />
                        </label>
                        <span class="popuptext" id="login_popup_1">정보를 입력하세요</span>
                        <span class="popuptext" id="login_popup_2">아이디가 없습니다</span>
                        <span class="popuptext" id="login_popup_3">비밀번호가 다릅니다</span>
                        <span class="popuptext" id="login_popup_4">세션 생성 실패</span>
                    </div>

                    <label>
                        <input type="password" name="passwd" placeholder="PASSWORD:" size="30" autocomplete="off" />
                    </label>

                    <div class="section-divider">
                        <a href="signup.html"class="btn-get-started btn-dark">Sign-up</a>
<!--                        <a href="#" onclick="document.getElementById('login_form').submit();" name="btn_login" class="btn-get-started" >Login</a>-->
<!--                        <button name="btn_signup" class="btn-get-started btn-dark" style="outline: none">Sign-up</button>-->
                        <input type="submit" name="btn_login" class="btn-get-started" style="background: none; outline: none" value="Login">
                    </div>
                </form>
            </div>
    </section>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/magnific-popup/magnific-popup.min.js"></script>

<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="js/main.js"></script>
</body>
</html>

<script type="text/javascript">
    function popupMsg(key) {
        if (key === 1) {
            var popup = document.getElementById('login_popup_1');
        }
        if (key === 2) {
            var popup = document.getElementById('login_popup_2');
        }
        if (key === 3) {
            var popup = document.getElementById('login_popup_3');
        }
        if (key === 4) {
            var popup = document.getElementById('login_popup_4');
        }
        popup.classList.toggle("show");
        // if (key === 'uid') {
        //     var popup = document.getElementById('uid_popup');
        //     popup.classList.toggle("show");
        // }
        // if (key === 'pwd') {
        //     var popup = document.getElementById('pwd_popup');
        //     popup.classList.toggle("show");
        // }
    }
    function enterMain() {
        location.href = 'main.php';
    }
</script>


<?php
session_start();
//if (!isset($_SESSION['user_id']))
//{
//    echo "<script>enterMain();</script>";
//}

if (isset($_POST['btn_login'])) {
    login();
}

function login() {
    $user_id = $_POST['user_id'];
    $passwd = $_POST['passwd'];

    if ($user_id == "" || $passwd == "") {
        echo "<script>popupMsg(1);</script>";
        return;
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM user_info WHERE user_id='$user_id'";

    $res = mysqli_query($conn, $sql);
    if ($res->num_rows != 1) {
        echo "<script>popupMsg(2);</script>";
        return;
    }

    $row = mysqli_fetch_array( $res );
    if ($row['passwd'] != $passwd) {
        echo "<script>popupMsg(3);</script>";
        return;
    }

    $_SESSION['user_id'] = $user_id;
    if (!isset($_SESSION['user_id'])) {
        echo "<script>popupMsg(4);</script>";
        return;
    }
//    echo "<script>location.replace(./main.php);</script>";
//    echo "<script>enterMain();</script>";
//    header('location:./main.php', true);
//    header('Refresh:2; URL=main.php', true, 301);
}
?>