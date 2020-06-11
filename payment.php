<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
}
include_once "common.php";
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

    <script src="common.js"></script>
</head>
<body>
    <header>
        <!--==============================================================================
                        타이틀 영역
            ================================================================================-->
        <div id="obc_title"></div>
    </header>
    <form id="submit-form" method="POST">
        <!--==============================================================================
                        입력 영역
            ================================================================================-->
        <div id="input_form">
            <div class="center">
                <h1>企业结算</h1>
            </div>
            <!--==========================
                  Month
                ============================-->
            <div class="center">
                <label for="ibox_month">
                    <input type="text"
                           name="ibox_month"
                           id="ibox_month"
                           list="month_list"
                           placeholder="月份"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                           value="<?php
                           if (isset($_POST['ibox_month'])) {
                               echo htmlentities($_POST['ibox_month']);
                           } ?>">
                </label>
                <datalist id="month_list">
                    <option value='1月份'></option>
                    <option value='2月份'></option>
                    <option value='3月份'></option>
                    <option value='4月份'></option>
                    <option value='5月份'></option>
                    <option value='6月份'></option>
                    <option value='7月份'></option>
                    <option value='8月份'></option>
                    <option value='9月份'></option>
                    <option value='10月份'></option>
                    <option value='11月份'></option>
                    <option value='12月份'></option>
                </datalist>
            </div>
            <!--==========================
                  Supplier
                ============================-->
            <div class="center">
                <label for="ibox_supplier">
                    <input type="text"
                           name="ibox_supplier"
                           id="ibox_supplier"
                           list="supplier_list"
                           placeholder="客户"
                           autocomplete="off"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                           value="<?php
                           if (isset($_POST['ibox_supplier'])) {
                               echo htmlentities($_POST['ibox_supplier']);
                           } ?>">
                </label>
                <datalist id="supplier_list">
                    <?php echo updateDatalist('supplier'); ?>
                </datalist>
            </div>
            <!--==========================
                  Button
                ============================-->
            <div class="center">
                <input class="btn-get-started btn-info scrollto"
                       id="updateButton"
                       type="button"
                       name="save"
                       style="outline: none; font-size: 16pt"
                       onclick="submit_data(this)"
                       value="保存">
                <input class="btn-get-started btn-success"
                       id="searchButton"
                       type="button"
                       name="search"
                       style="outline: none; font-size: 16pt"
                       onclick="submit_data(this)"
                       value="检索">
            </div>
        </div>
    </form>
    <div id="common_part"></div>
</body>
</html>