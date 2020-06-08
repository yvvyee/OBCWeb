<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OBC Web</title>

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
<!--==============================================================================

                Modal for buttons

    ================================================================================-->
<div id="navi" class="modal fade" style="display: none; margin-bottom: 10%">
    <div class="modal-dialog modal-dialog-centered" style="background: none">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" style="text-align: center">
                        <div class="col" style="text-align: center">
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/入库对账.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/对账单.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/库存表.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/材料订货.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/海上运动.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/生产计划.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/订单查询.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/订货资料.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/贴花生产计划.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/资料检索.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/资料编辑.png"></a>
                            <a href="#"><img style="margin: 5px 5px 5px 5px; width: 90px" alt="" src="./img/icon/资料输入.png"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--==============================================================================

                Home button for openning modal

    ================================================================================-->
<div style="position: relative">
    <div class="center" style="min-height: 100vh; overflow: hidden">
        <div class="center" style="top: 20%; position: absolute">
            <img src="./img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="width: 85%">
        </div>
        <div class="button-container" style="position: absolute; bottom: 20px">
            <a href="#navi" data-toggle="modal"></a>
            <div class="button-image">
                <img src="./img/icon/HOME.png" alt="">
            </div>
        </div>
    </div>
</div>
</body>
</html>