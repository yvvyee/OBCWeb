<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>재고생성</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="../img/favicon.png" rel="icon">
    <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="../css/style.css" rel="stylesheet">

<!--    <script ></script>-->

    <style>
        /*td {border: 1px #DDD solid; padding: 5px; cursor: pointer;}*/

        .selected {
            background-color: brown;
            color: #FFF;
        }

        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>

    <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <h1><a>재고생성</a></h1>
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
<!--                <li class="menu-active"><a href="#intro">资料输入</a></li>-->
                <li><a href="../temp/material.php">원자재입력</a></li>
                <li><a href="../temp/basic_stock.php">기본재고입력</a></li>
                <li><a href="stock.php">재고생성</a></li>
                <li><a href="#order">材料订货</a></li>
                <li><a href="#check">入库对账</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header>
<main>
    <section id="intro">
        <form method="post">
            <div class="intro-text">
                <div class="container column" style="margin-top: 30%; width: 72%">
                    <!--==========================
                      白瓷
                    ============================-->
                    <div>
                        <input type="submit" name="白瓷" class="btn-get-started" value="白瓷" style="background: none; outline: none">
                    </div>
                    <!--==========================
                      花纸
                    ============================-->
                    <div style="text-align: left">
                        <label for="花纸_design">
                            <input type="text"
                                   name="花纸_design"
                                   id="花纸_design"
                                   list="花纸_list"
                                   placeholder="花纸 Design"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['花纸_design'])) {
                                       echo htmlentities($_POST['花纸_design']);
                                   } ?>">
                        </label>
                        <datalist id="花纸_list">
                            <?php echo updateDatalist('花纸'); ?>
                        </datalist>
                        <input type="submit" name="花纸" class="btn-get-started" value="花纸" style="background: none; outline: none">
                    </div>
                    <!--==========================
                      完成品
                    ============================-->
                    <div style="text-align: left">
                        <label for="完成品_design">
                            <input type="text"
                                   name="完成品_design"
                                   id="完成品_design"
                                   list="完成品_list"
                                   placeholder="完成品 Design"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['完成品_design'])) {
                                       echo htmlentities($_POST['完成品_design']);
                                   } ?>">
                        </label>
                        <datalist id="完成品_list">
                            <?php echo updateDatalist('完成品'); ?>
                        </datalist>
                        <input type="submit" name="完成品" class="btn-get-started" style="background: none; outline: none" value="完成品">
                    </div>
                    <!--==========================
                      包装物
                    ============================-->
                    <div style="text-align: left">
                        <label for="包装物_design">
                            <input type="text"
                                   name="包装物_design"
                                   id="包装物_design"
                                   list="包装物_list"
                                   placeholder="包装物 Design"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['包装物_design'])) {
                                       echo htmlentities($_POST['包装物_design']);
                                   } ?>">
                        </label>
                        <datalist id="包装物_list">
                            <?php echo updateDatalist('包装物'); ?>
                        </datalist>
                        <input type="submit" name="包装物" class="btn-get-started" style="background: none; outline: none" value="包装物">
                    </div>
                    <!--==========================
                      彩瓷
                    ============================-->
                    <div style="text-align: left">
                        <label for="彩瓷_design">
                            <input type="text"
                                   name="彩瓷_design"
                                   id="彩瓷_design"
                                   list="彩瓷_list"
                                   placeholder="彩瓷 Design"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['彩瓷_design'])) {
                                       echo htmlentities($_POST['彩瓷_design']);
                                   } ?>">
                        </label>
                        <datalist id="彩瓷_list">
                            <?php echo updateDatalist('彩瓷'); ?>
                        </datalist>
                        <input type="submit" name="彩瓷" class="btn-get-started" style="background: none; outline: none" value="彩瓷">
                    </div>
                    <!--==========================
                      보기
                    ============================-->
                    <div>
                        <a href="#stock_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('stock_view')">보기</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<!--==========================
  Show table
============================-->
<script>
    function test() {
        $("btn_test").change(function () {
            window.scroll(0, 0);
            window.location.hash = '#test';
        })

    }
    function clearTable() {
        $("#mat_tbody").empty();
    }

    function showMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "block";
    }
    function hideMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "none";
    }
</script>

<a href="#" class="back-to-top" onclick="hideMaterial('stock_view')"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/jquery/jquery-migrate.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/wow/wow.min.js"></script>
<script src="../lib/superfish/hoverIntent.js"></script>
<script src="../lib/superfish/superfish.min.js"></script>
<script src="../lib/magnific-popup/magnific-popup.min.js"></script>

<!-- Contact Form JavaScript File -->
<script src="../contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="../js/main.js"></script>

</body>
</html>

<?php

#region POST
if (isset($_POST['白瓷'])) {
    show_stock($_POST['白瓷']);
}
if (isset($_POST['花纸'])) {
    show_stock($_POST['花纸']);
}
if (isset($_POST['完成品'])) {
    show_stock($_POST['完成品']);
}
if (isset($_POST['包装物'])) {
    show_stock($_POST['包装物']);
}
if (isset($_POST['彩瓷'])) {
    show_stock($_POST['彩瓷']);
}
if (isset($_POST['add_design'])) {
    add_list($_POST['ibox_design'], 'design');
}
#endregion POST

function update($name) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT DISTINCT design FROM basic_stock WHERE class='{$name}'";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row['design']);
        echo "<option value='$var'>";
    }
}

function add_list($value, $name) {
    if (empty($value)) {
        alert("{$name} 값을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT EXISTS (SELECT * FROM {$name} where {$name}={$value}) as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("{$name} : {$value} 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO {$name} VALUES ({$value})";
    if (mysqli_query($conn, $sql)) {
        alert("{$name} : {$value} 항목 추가 완료");
    }
}

function show_stock($kind) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");

    $basic = array();
    $mat = array();
    $sub = array();

    if ($kind == '白瓷') {
        $sub_name = "贴花";

        $sql = "SELECT item FROM basic_stock WHERE class='{$kind}'";
        $items = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($items)) {
            $sql = "SELECT qty FROM basic_stock WHERE class='{$kind}' AND item='{$row['item']}'";
            $basic[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

            $sql = "SELECT sum(qty) FROM material WHERE class='{$kind}' AND item='{$row['item']}'";
            $mat[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

            $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$row['item']}'";
            $sub[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        }

        echo '
        <section id="stock_view" class="section-bg" style="display: none; margin-bottom: 10%">
        <div class="container-fluid">
        <div class="section-header">
        <h3 class="section-title">'.$kind.'库存</h3>
        <span class="section-divider"></span>
        <table id="mat_table" class="container" style="overflow-x: auto; font-size: 10pt; text-align: center">
        <thead>
        <tr style="border-bottom: 1px dotted silver;">
        <th>No</th>
        <th>Item</th>
        <th>期初</th>
        <th>白瓷入库</th>
        <th>贴花出库</th>
        <th>宣账白瓷</th>
        </tr>
        </thead>
        <tbody id="mat_tbody" class="dynamics">
';
        $num = 0;
        foreach ($basic as $k => $v) {
            $num += 1;
            echo '<tr style="border-bottom: 1px dotted silver"><td>' .
                $num . '</td><td>' .
                $k . '</td><td>' .
                $v . '</td><td>' .
                $mat[$k] . '</td><td>' .
                $sub[$k] . '</td><td>' .
                (intval($v) + intval($mat[$k])-intval($sub[$k])) . '</td><tr>';
        }
        echo
        '</tbody>
        </table>
        </div>
        </div>
        </section>';
    }

    if ($kind == '花纸') {
        if (empty($_POST[$kind.'_design'])) {
            alert($kind.'_design 을 선택해주세요.');
            return;
        }
        $sub_name = "贴花";
        calc_stock($kind, $sub_name, $conn, $basic, $mat, $sub);
    }

    if ($kind == '完成品') {
        if (empty($_POST[$kind.'_design'])) {
            alert($kind.'_design 을 선택해주세요.');
            return;
        }
        $sub_name = "出库";
        calc_stock($kind, $sub_name, $conn, $basic, $mat, $sub);
    }

    if ($kind == '完成品') {
        if (empty($_POST[$kind.'_design'])) {
            alert($kind.'_design 을 선택해주세요.');
            return;
        }
        $sub_name = "出库";
        calc_stock($kind, $sub_name, $conn, $basic, $mat, $sub);
    }

    alert($kind.'库存 생성완료');
}

/**
 * @param $kind
 * @param mysqli $conn
 * @param array $basic
 * @param array $mat
 * @param array $sub
 */
function calc_stock($kind, $sub_name, mysqli $conn, array $basic, array $mat, array $sub): void
{
    $design = $_POST[$kind . '_design'];

    $sql = "SELECT item FROM basic_stock WHERE class='{$kind}' AND design='{$design}'";
    $items = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($items)) {
        $sql = "SELECT qty FROM basic_stock WHERE class='{$kind}' AND item='{$row['item']}' AND design='{$design}'";
        $basic[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $sql = "SELECT sum(qty) FROM material WHERE class='{$kind}' AND item='{$row['item']}' AND design='{$design}'";
        $mat[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$row['item']}' AND design='{$design}'";
        $sub[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
    }

    echo '
        <section id="stock_view" class="section-bg" style="display: none; margin-bottom: 10%">
        <div class="container-fluid">
        <div class="section-header">
        <h3 class="section-title">' . $kind . '库存</h3>
        <span class="section-divider"></span>
        <table id="mat_table" class="container" style="overflow-x: auto; font-size: 10pt; text-align: center">
        <thead>
        <tr style="border-bottom: 1px dotted silver;">
        <th>No</th>
        <th>' . $design . '</th>
        <th>期初</th>
        <th>白瓷入库</th>
        <th>贴花出库</th>
        <th>宣账白瓷</th>
        </tr>
        </thead>
        <tbody id="mat_tbody" class="dynamics">
';
    $num = 0;
    foreach ($basic as $k => $v) {
        $num += 1;
        echo '<tr style="border-bottom: 1px dotted silver"><td>' .
            $num . '</td><td>' .
            $k . '</td><td>' .
            $v . '</td><td>' .
            $mat[$k] . '</td><td>' .
            $sub[$k] . '</td><td>' .
            (intval($v) + intval($mat[$k]) - intval($sub[$k])) . '</td><tr>';
    }
    echo
    '</tbody>
        </table>
        </div>
        </div>
        </section>';
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>