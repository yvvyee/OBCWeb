<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>资料输入</title>

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

    <style>
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
        // $("#mat_table tr").click(function(){
        //     $(this).addClass('selected').siblings().removeClass('selected');
        //     var value=$(this).find('td:first').html();
        //     alert(value);
        // });
        //
        // $('.ok').on('click', function(e){
        //     alert($("#mat_table tr.selected td:first").html());
        // });
    </script>
</head>
<body>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <h1><a>资料输入</a></h1>
        </div>
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="#intro">资料输入</a></li>
                <li><a href="#plan">贴花生产计划</a></li>
                <li><a href="#trace">订单查询</a></li>
                <li><a href="#order">材料订货</a></li>
                <li><a href="#check">入库对账</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header>
<main>
    <section id="intro">
        <form method="post">
            <div class="intro-text row">

                <!--==========================
                  좌측 입력 영역
                ============================-->
                <div class="container column" style="margin-top: 30%; width: 72%">
                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_date">
                            <input type="date"
                                   id="ibox_date"
                                   name="ibox_date"
                                   placeholder="Date"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_date'])) {
                                       echo htmlentities($_POST['ibox_date']);
                                   }
                                   else {
                                       echo date('Y-m-d'); }
                                   ?>">
                        </label>
                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_supplier">
                            <input type="text"
                                   name="ibox_supplier"
                                   id="ibox_supplier"
                                   list="supplier_list"
                                   placeholder="supplier"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_supplier'])) {
                                       echo htmlentities($_POST['ibox_supplier']);
                                   } ?>">
                        </label>
                        <datalist id="supplier_list">
                            <?php echo updateDatalist('supplier'); ?>
                        </datalist>

                        <input type="submit" name="add_supplier" class="btn-info"   value="添加">
                        <input type="submit" name="pop_supplier" class="btn-danger" value="刪除">
                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_item">
                            <input type="text"
                                   name="ibox_item"
                                   id="ibox_item"
                                   list="item_list"
                                   placeholder="item"
                                   autocomplete="off"
                                   style="width: 162px; background: #b8daff; border-width: thin"
                                   value="<?php
                                   if (isset($_POST['ibox_item'])) {
                                       echo htmlentities($_POST['ibox_item']);
                                   } ?>">
                        </label>
                        <datalist id="item_list">
                            <?php echo updateDatalist('item'); ?>
                        </datalist>

                        <input type="submit" name="add_item" id="add_item" class="btn-info"   value="添加" />
                        <input type="submit" name="pop_item" id="add_item" class="btn-danger" value="刪除" />
                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_design">
                            <input type="text"
                                   name="ibox_design"
                                   id="ibox_design"
                                   list="design_list"
                                   placeholder="design"
                                   autocomplete="off"
                                   style="width: 162px; background: #b8daff; border-width: thin"
                                   value="<?php
                                   if (isset($_POST['ibox_design'])) {
                                       echo htmlentities($_POST['ibox_design']);
                                   } ?>">
                        </label>
                        <datalist id="design_list">
                            <?php echo updateDatalist('design'); ?>
                        </datalist>

                        <input type="submit" name="add_design" class="btn-info"   value="添加" />
                        <input type="submit" name="pop_design" class="btn-danger" value="刪除" />
                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_quantity">
                            <input type="number"
                                   name="ibox_quantity"
                                   id="ibox_quantity"
                                   placeholder="quantity"
                                   style="width: 162px; background: #b8daff; border-width: thin"
                                   value="<?php
                                   if (isset($_POST['ibox_quantity'])) {
                                       echo htmlentities($_POST['ibox_quantity']);
                                   } ?>">
                        </label>

                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_month">
                            <input type="number"
                                   name="ibox_month"
                                   id="ibox_month"
                                   placeholder="month"
                                   min="0"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_month'])) {
                                       echo htmlentities($_POST['ibox_month']);
                                   } ?>">
                        </label>
                    </div>

                    <div style="text-align: left; margin-left: 2%">
                        <label for="ibox_class">
                            <input type="text"
                                   name="ibox_class"
                                   id="ibox_class"
                                   list="class_list"
                                   placeholder="class"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_class'])) {
                                       echo htmlentities($_POST['ibox_class']);
                                   } ?>">
                        </label>
                        <datalist id="class_list">
                            <?php echo updateDatalist('class'); ?>
                        </datalist>

                        <input type="submit" name="add_class" class="btn-info" value="添加" />
                        <input type="submit" name="pop_class" class="btn-danger" value="刪除" />
                    </div>

                    <div>
                        <a href="#material" class="btn-get-started btn-info scrollto">
                            Show
<!--                        <input type="submit" class="btn-get-started btn-info" style="outline: none" value="Show">-->
                        </a>
                        <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="Save">
                    </div>
                </div>


                <!--==========================
                  우측 버튼 영역
                ============================-->
                <div class="container column" style="margin-top: 30%; width: 20%; background: black; text-align: left">
                    <input type="submit" class="btn-success" value="백자재고">
                </div>
            </div>
        </form>
    </section>
    <!--==========================
      Show materials
    ============================-->
    <section id="material" class="section-bg" style="display: block">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">原材料库存</h3>
            <span class="section-divider"></span>
                <table id="mat_table" class="container" style="font-size: 10pt; text-align: center">
                    <thead>
                    <tr class="table_header" style="border-bottom: 1px dotted silver;">
                        <th>time</th>
                        <th>date</th>
                        <th>supplier</th>
                        <th>item</th>
                        <th>design</th>
                        <th>quantity</th>
                        <th>month</th>
                        <th>class</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = "SELECT * FROM material";
                    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
                    $res = mysqli_query( $conn, $sql );
                    while( $row = mysqli_fetch_array( $res ) ) {
                        echo '<tr style="border-bottom: 1px dotted silver;"><td>' .
                            $row[ 'time' ]      . '</td><td>'.
                            $row[ 'date' ]      . '</td><td>' .
                            $row[ 'supplier' ]  . '</td><td>' .
                            $row[ 'item' ]      . '</td><td>' .
                            $row[ 'design' ]    . '</td><td>' .
                            $row[ 'quantity' ]  . '</td><td>' .
                            $row[ 'month' ]     . '</td><td>' .
                            $row[ 'class' ]     . '</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
        </div>
      </div>
    </section><!-- #about -->
</main>

<footer class="footer-links">

</footer>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
//if (array_key_exists('show_material', $_POST)) {
//    echo "<script>displayMaterial()</script>";
//}
if (array_key_exists('save_material', $_POST)) {
    updateStock();
}
if (array_key_exists('add_supplier', $_POST)) {
    add_list($_POST['ibox_supplier'], 'supplier');
}
if (array_key_exists('add_item', $_POST)) {
    add_list($_POST['ibox_item'], 'item');
}
if (array_key_exists('add_design', $_POST)) {
    add_list($_POST['ibox_design'], 'design');
}
if (array_key_exists('add_class', $_POST)) {
    add_list($_POST['ibox_class'], 'class');
}
if (array_key_exists('pop_supplier', $_POST)) {
    pop_list($_POST['ibox_supplier'], 'supplier');
}
if (array_key_exists('pop_item', $_POST)) {
    pop_list($_POST['ibox_item'], 'item');
}
if (array_key_exists('pop_design', $_POST)) {
    pop_list($_POST['ibox_design'], 'design');
}
if (array_key_exists('pop_class', $_POST)) {
    pop_list($_POST['ibox_class'], 'class');
}

function update($name) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM list_{$name}";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row[$name]);
        echo "<option value='$var'>";
    }
}

function save_material() {

    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $quantity   = ($_POST['ibox_quantity']);
    $month      = ($_POST['ibox_month'])."月份";
    $class      = ($_POST['ibox_class']);

    if (empty($supplier)) {
        alert("supplier 값을 입력하세요.");
        return;
    }
    if (empty($item)) {
        alert("item 값을 입력하세요.");
        return;
    }
    if (empty($design)) {
        alert("design 값을 입력하세요.");
        return;
    }
    if (empty($quantity)) {
        alert("quantity 값을 입력하세요.");
        return;
    }
    if (empty($class)) {
        alert("class 값을 입력하세요.");
        return;
    }
    
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");

    $sql = "INSERT INTO material (date, supplier, item, design, quantity, month, class) 
            VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$quantity}, '{$month}', '{$class}')";
//    $res = mysqli_query($conn, $sql);
//    echo $res;
    if (mysqli_query($conn, $sql)) {
        alert("정상적으로 저장되었습니다.");
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

function pop_list($value, $name) {

}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>