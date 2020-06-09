<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once "common.php";
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
    <link href="./img/favicon.png" rel="icon">
    <link href="./img/apple-touch-icon.png" rel="apple-touch-icon">

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
</head>
<body>
    <section id="intro">
            <div class="intro-text" style="position: relative">

                <form method="POST" name="login_form">

                    <div class="container">
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
                        <div class="section-divider">
                            <input type="submit"
                                   name="btn_login"
                                   class="btn-get-started"
                                   style="background: none;
                                   outline: none"
                                   value="登录">
                        </div>
                    </div>
                </form>
            </div>
    </section>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
</body>
</html>