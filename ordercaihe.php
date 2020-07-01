<?php
session_start();
include_once "common/php/common.php";
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>OBC Web</title>

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
    <script src="./js/main.js"></script>
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
<header>
    <!--==============================================================================
                    타이틀 영역
        ================================================================================-->
    <div id="obc_title"></div>
</header>
<div style="height: 120vh">
    <!--==========================
          Text
        ============================-->
    <div class="center">
        <h1>彩盒订货</h1>
    </div>
    <!--==========================
          Input
        ============================-->
    <div id="input_form_custom">
    </div>
    <!--==========================
          Button
        ============================-->
    <div class="center">
        <input class="btn-get-started btn-danger"
               id="csvDownloadButton"
               type="button"
               style="outline: none; font-size: 16pt"
               value="下载">
        <input class="btn-get-started btn-dark"
               id="orderCaihe"
               type="button"
               name="orderCaihe"
               style="outline: none; font-size: 16pt; background-color: #993366"
               onclick="submit_basic(this)"
               value="彩盒">
    </div>
    <!--==========================
          Table
        ============================-->
    <div id="table_root" class="table-area center" style="margin-bottom: 10%">
    </div>
</div>
<!--==============================================================================
                Modal for order
    ================================================================================-->
<div id="order_form" class="modal fade" style="display: none">
    <div class="modal-dialog">
        <div class="intro-text modal-content" style="background: none; width: 270px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
            <div class="modal-header" style="text-align: center; justify-content: center; color: black">
                <h1 style="background-color: white">工厂订货</h1>
            </div>
            <div class="modal-body">
                <!--==========================
                      Input
                    ============================-->
                <div id="input_form_ordering">
                </div>
                <!--==========================
                      Button
                    ============================-->
                <div class="center">
                    <input class="btn-get-started btn-info scrollto"
                           id="orderButton"
                           type="button"
                           name="ordering"
                           style="outline: none; font-size: 16pt"
                           onclick="submit_basic(this)"
                           value="保存">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--==============================================================================
                Common
    ================================================================================-->
<div id="common_part"></div>
<div class="footer" id="home_button"></div>
</body>
</html>
<script src="common/js/common.js"></script>