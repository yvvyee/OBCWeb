<?php
session_start();
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
    <form id="submit-form" method="POST">
        <!--==============================================================================
                        입력 영역
            ================================================================================-->
        <div id="input_form">
            <div class="center">
                <h1>客户订货资料</h1>
            </div>
            <!--==========================
                  No
                ============================-->
            <div class="center">
                <label for="ibox_no">
                    <input class="input_box"
                           type="text"
                           name="no"
                           id="ibox_no"
                           placeholder="No"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; display: none">
                </label>
            </div>
            <!--==========================
                  Date
                ============================-->
            <div class="center">
                <label for="ibox_date">
                    <input class="input_box"
                           type="date"
                           name="date"
                           id="ibox_date"
                           placeholder="日期"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
            </div>
            <!--==========================
                  Customer
                ============================-->
            <div class="center">
                <label for="ibox_customer">
                    <input class="input_box"
                           type="text"
                           name="customer"
                           id="ibox_customer"
                           list="customer_list"
                           placeholder="客户"
                           autocomplete="off"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
                <datalist id="customer_list">
                </datalist>
            </div>
            <!--==========================
                  Item
                ============================-->
            <div class="center">
                <label for="ibox_item">
                    <input class="input_box"
                           type="text"
                           name="item"
                           id="ibox_item"
                           list="item_list"
                           placeholder="品名"
                           autocomplete="off"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
                <datalist id="item_list">
                </datalist>
            </div>
            <!--==========================
                  Design
                ============================-->
            <div class="center">
                <label for="ibox_design">
                    <input class="input_box"
                           type="text"
                           name="design"
                           id="ibox_design"
                           list="design_list"
                           placeholder="花面"
                           autocomplete="off"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
                <datalist id="design_list">
                </datalist>
            </div>
            <!--==========================
                  Qty
                ============================-->
            <div class="center">
                <label for="ibox_qty">
                    <input class="input_box"
                           type="number"
                           name="qty"
                           id="ibox_qty"
                           placeholder="数量"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
            </div>
            <!--==========================
                  Orderno
                ============================-->
            <div class="center">
                <label for="ibox_orderno">
                    <input class="input_box"
                           type="text"
                           name="orderno"
                           id="ibox_orderno"
                           placeholder="订单号码"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                </label>
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
                       onclick="submit_basic(this)"
                       value="保存">
                <input class="btn-get-started btn-success"
                       id="searchButton"
                       type="button"
                       name="search"
                       style="outline: none; font-size: 16pt"
                       onclick="submit_basic(this)"
                       value="检索">
                <input class="btn-get-started btn-dark"
                       id="orderButton"
                       type="button"
                       name="order"
                       style="outline: none; font-size: 16pt"
                       onclick="submit_basic(this)"
                       value="订货">
            </div>
        </div>
    </form>
    <!--==============================================================================
                    Modal for order
        ================================================================================-->
    <div id="order_form" class="modal fade" style="display: none">
        <div class="modal-dialog">
            <div class="intro-text modal-content" style="background: none; width: 270px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
                <div class="modal-header" style="text-align: center; justify-content: center; color: black">
                    <h1>订货</h1>
                </div>
                <div id="order_body" class="modal-body">
                    <!--==========================
                            No
                        ============================-->
                    <div class="center">
                        <label for="ibox_no">
                            <input class="minput_box"
                                   type="text"
                                   name="no"
                                   id="ibox_no"
                                   placeholder="No"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; display: none">
                        </label>
                    </div>
                    <!--==========================
                          Date
                        ============================-->
                    <div class="center">
                        <label for="ibox_date">
                            <input class="minput_box"
                                   type="date"
                                   name="date"
                                   id="ibox_date"
                                   placeholder="日期"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                    </div>
                    <!--==========================
                          Supplier
                        ============================-->
                    <div class="center">
                        <label for="ibox_supplier">
                            <input class="minput_box"
                                   type="text"
                                   name="supplier"
                                   id="ibox_supplier"
                                   list="supplier_list"
                                   placeholder="企业"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                        <datalist id="supplier_list">
                        </datalist>
                    </div>
                    <!--==========================
                          Item
                        ============================-->
                    <div id="div_item" class="center">
                        <label for="ibox_item">
                            <input class="minput_box"
                                   type="text"
                                   name="item"
                                   id="ibox_item"
                                   list="item_list"
                                   placeholder="品名"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                        <datalist id="item_list">
                        </datalist>
                    </div>
                    <!--==========================
                      Design
                    ============================-->
                    <div id="div_design" class="center">
                        <label for="ibox_design">
                            <input class="minput_box"
                                   type="text"
                                   name="design"
                                   id="ibox_design"
                                   list="design_list"
                                   placeholder="花面"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                        <datalist id="design_list">
                        </datalist>
                    </div>
                    <!--==========================
                          Qty
                        ============================-->
                    <div id="div_qty" class="center">
                        <label for="ibox_qty">
                            <input class="minput_box"
                                   type="number"
                                   name="qty"
                                   id="ibox_qty"
                                   placeholder="数量"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                    </div>
                    <!--==========================
                        Orderno
                    ============================-->
                    <div id="div_orderno" class="center">
                        <label for="ibox_orderno">
                            <input class="minput_box"
                                   type="text"
                                   name="orderno"
                                   id="ibox_orderno"
                                   list="customer_list"
                                   placeholder="订单号码"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                        <datalist id="customer_list">
                        </datalist>
                    </div>
                    <!--==========================
                            Class
                        ============================-->
                    <div class="center">
                        <label for="ibox_class">
                            <input class="minput_box"
                                   type="text"
                                   name="class"
                                   id="ibox_class"
                                   list="class_list"
                                   placeholder="分类"
                                   autocomplete="off"
                                   style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px">
                        </label>
                        <datalist id="class_list">
                        </datalist>
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
</body>
</html>
<script src="common.js"></script>