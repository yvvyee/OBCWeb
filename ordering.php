<?php
//session_start();
include_once "common.php";
//if(!isset($_SESSION['user_id'])) {
//    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
//}
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
    <!--==============================================================================
                    Modal
        ================================================================================-->
    <div id="order_form" class="modal fade" style="display: none">
        <div class="modal-dialog">
            <div class="intro-text modal-content" style="background: none; width: 270px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
                <div class="modal-header" style="text-align: center; justify-content: center; color: black">
                    <h1>订货</h1>
                </div>
                <div class="modal-body">
                    <!--==========================
                          No
                        ============================-->
                    <div class="center">
                        <label for="ibox_no">
                            <input class="fa fa-remove"
                                   type="no"
                                   id="ibox_no"
                                   name="ibox_no"
                                   placeholder="No"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; display: none">
                        </label>
                    </div>
                    <!--==========================
                          Date
                        ============================-->
                    <div class="center">
                        <label for="ibox_date">
                            <input type="date"
                                   id="ibox_date"
                                   name="ibox_date"
                                   placeholder="日期"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_date'])) {
                                       echo htmlentities($_POST['ibox_date']);
                                   }
                                   ?>">
                        </label>
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
                          Item
                        ============================-->
                    <div class="center">
                        <label for="ibox_item">
                            <input type="text"
                                   name="ibox_item"
                                   id="ibox_item"
                                   list="item_list"
                                   placeholder="品名"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_item'])) {
                                       echo htmlentities($_POST['ibox_item']);
                                   } ?>">
                        </label>
                        <datalist id="item_list">
                            <option value="4绿碗"></option>
                            <option value="5绿碗"></option>
                            <option value="7绿碗"></option>
                            <option value="3.5汤"></option>
                            <option value="5圆汤"></option>
                            <option value="6圆汤"></option>
                            <option value="7圆汤"></option>
                            <option value="8圆平"></option>
                            <option value="9圆平"></option>
                            <option value="11圆平"></option>
                            <option value="7正平"></option>
                            <option value="9正平"></option>
                            <option value="11正平"></option>
                            <option value="方鱼盘"></option>
                            <option value="4天龙碗"></option>
                            <option value="5天龙碗"></option>
                            <option value="7天龙碗"></option>
                            <option value="2P 杯碟"></option>
                            <option value="5P 杯碟"></option>
                            <option value="2P 皇室杯"></option>
                            <option value="5P 皇室杯"></option>
                            <option value="22p"></option>
                            <option value="6格碟"></option>
                            <option value="4绿碗外箱"></option>
                            <option value="5绿碗外箱"></option>
                            <option value="7绿碗外箱"></option>
                            <option value="3.5汤外箱"></option>
                            <option value="5圆汤外箱"></option>
                            <option value="6圆汤外箱"></option>
                            <option value="7圆汤外箱"></option>
                            <option value="8圆平外箱"></option>
                            <option value="9圆平外箱"></option>
                            <option value="11圆平外箱"></option>
                            <option value="7正平外箱"></option>
                            <option value="9正平外箱"></option>
                            <option value="11正平外箱"></option>
                            <option value="方鱼盘外箱"></option>
                            <option value="4天龙碗外箱"></option>
                            <option value="5天龙碗外箱"></option>
                            <option value="7天龙碗外箱"></option>
                            <option value="2P 杯碟外箱"></option>
                            <option value="5P 杯碟外箱"></option>
                            <option value="2P 皇室杯外箱"></option>
                            <option value="5P 皇室杯外箱"></option>
                            <option value="22p外箱"></option>
                            <option value="6格碟外箱"></option>
                        </datalist>
                    </div>
                    <!--==========================
                          Design
                        ============================-->
                    <div class="center">
                        <label for="ibox_design">
                            <input type="text"
                                   name="ibox_design"
                                   id="ibox_design"
                                   list="design_list"
                                   placeholder="花面"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_design'])) {
                                       echo htmlentities($_POST['ibox_design']);
                                   } ?>">
                        </label>
                        <datalist id="design_list">
                            <?php echo updateDatalist('design'); ?>
                        </datalist>
                    </div>
                    <!--==========================
                          Qty
                        ============================-->
                    <div class="center">
                        <label for="ibox_qty">
                            <input type="number"
                                   name="ibox_qty"
                                   id="ibox_qty"
                                   placeholder="数量"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_qty'])) {
                                       echo htmlentities($_POST['ibox_qty']);
                                   } ?>">
                        </label>
                    </div>
                    <!--==========================
                          Order Number
                        ============================-->
                    <div class="center">
                        <label for="ibox_numer">
                            <input type="text"
                                   name="ibox_numer"
                                   id="ibox_numer"
                                   list="numer_list"
                                   placeholder="Order number"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_numer'])) {
                                       echo htmlentities($_POST['ibox_numer']);
                                   } ?>">
                        </label>
                        <datalist id="num_list">
                            <?php echo updateDatalist('number'); ?>
                        </datalist>
                    </div>
                    <!--==========================
                          Class
                        ============================-->
                    <div class="center">
                        <label for="ibox_class">
                            <input type="text"
                                   name="ibox_class"
                                   id="ibox_class"
                                   list="class_list"
                                   placeholder="分类"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                                   value="<?php
                                   if (isset($_POST['ibox_class'])) {
                                       echo htmlentities($_POST['ibox_class']);
                                   } ?>">
                        </label>
                        <datalist id="class_list">
                            <?php echo updateDatalist('class'); ?>
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
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <form id="submit-form" method="POST">
        <!--==============================================================================
                        입력 영역
            ================================================================================-->
        <div id="input_form">
            <div class="center">
                <h1>库存情况</h1>
            </div>
            <!--==========================
                  Order Number
                ============================-->
            <div class="center">
                <label for="ibox_numer">
                    <input type="text"
                           name="ibox_numer"
                           id="ibox_numer"
                           list="numer_list"
                           placeholder="订单号码"
                           autocomplete="off"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px"
                           value="<?php
                           if (isset($_POST['ibox_numer'])) {
                               echo htmlentities($_POST['ibox_numer']);
                           } ?>">
                </label>
                <datalist id="num_list">
                    <?php echo updateDatalist('number'); ?>
                </datalist>
            </div>
            <!--==========================
                  Button
                ============================-->
            <div class="center">
                <button class="btn-get-started btn-info scrollto"
                       style="outline: none; font-size: 16pt"
                       data-toggle="modal"
                       data-target="#order_form"
                onclick="return false">테스트버튼</button>
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