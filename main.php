<?php
//session_start();
//if(!isset($_SESSION['user_id'])) {
//    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
//}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>OBC-Web</title>

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
        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
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
<!--            <h1><a>Main</a></h1>-->
             <a href="#intro"><img src="img/logo.png" alt="" title="OBC" width="30%"></a>
        </div>
        <!--==========================
          상단 메뉴
        ============================-->
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="./login.php"><input type="button" class="btn-danger" value="Logout" onclick="<?php session_destroy(); ?>" /></a></li>
                <li><a href="material.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>원자재입력</br></a></li>
                <li><a href="basic_stock.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>기본재고입력</br></a></li>
                <li><a href="stock.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>재고생성</a></li>
                <li><a href="#order"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>材料订货</a></li>
                <li><a href="#check"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>入库对账</a></li>
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
                      Date
                    ============================-->
                    <div>
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
                                   ?>">
                        </label>
                    </div>
                    <!--==========================
                      Supplier
                    ============================-->
                    <div>
                        <label for="ibox_supplier">
                            <input type="text"
                                   name="ibox_supplier"
                                   id="ibox_supplier"
                                   list="supplier_list"
                                   placeholder="Supplier"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_supplier'])) {
                                       echo htmlentities($_POST['ibox_supplier']);
                                   } ?>">
                        </label>
                        <datalist id="supplier_list">
                            <?php echo update('supplier'); ?>
                        </datalist>
                    </div>
                    <!--==========================
                      Item
                    ============================-->
                    <div>
                        <label for="ibox_item">
                            <input type="text"
                                   name="ibox_item"
                                   id="ibox_item"
                                   list="item_list"
                                   placeholder="Item"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_item'])) {
                                       echo htmlentities($_POST['ibox_item']);
                                   } ?>">
                        </label>
                        <datalist id="item_list">
                            <?php echo update('item'); ?>
                        </datalist>
                    </div>
                    <!--==========================
                      Design
                    ============================-->
                    <div>
                        <label for="ibox_design">
                            <input type="text"
                                   name="ibox_design"
                                   id="ibox_design"
                                   list="design_list"
                                   placeholder="Design"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_design'])) {
                                       echo htmlentities($_POST['ibox_design']);
                                   } ?>">
                        </label>
                        <datalist id="design_list">
                            <?php echo update('design'); ?>
                    </div>
                    <!--==========================
                      Quantity
                    ============================-->
                    <div>
                        <label for="ibox_qty">
                            <input type="number"
                                   name="ibox_qty"
                                   id="ibox_qty"
                                   placeholder="Qty"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_qty'])) {
                                       echo htmlentities($_POST['ibox_qty']);
                                   } ?>">
                        </label>
                    </div>
                    <!--==========================
                      Month
                    ============================-->
                    <div>
                        <label for="ibox_month">
                            <input type="number"
                                   name="ibox_month"
                                   id="ibox_month"
                                   placeholder="Month"
                                   min="0"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_month'])) {
                                       echo htmlentities($_POST['ibox_month']);
                                   } ?>">
                        </label>
                    </div>
                    <!--==========================
                      Class
                    ============================-->
                    <div>
                        <label for="ibox_class">
                            <input type="text"
                                   name="ibox_class"
                                   id="ibox_class"
                                   list="class_list"
                                   placeholder="Class"
                                   autocomplete="off"
                                   style="width: 162px"
                                   value="<?php
                                   if (isset($_POST['ibox_class'])) {
                                       echo htmlentities($_POST['ibox_class']);
                                   } ?>">
                        </label>
                        <datalist id="class_list">
                            <?php echo update('class'); ?>
                        </datalist>
                    </div>
                    <!--==========================
                      Buttons onclick="showMaterial('material')"
                    ============================-->
                    <div>
                        <a href="#material_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('material_view')"><i class="fa fa-link"></i>보기
                        </a>
                        <input type="submit" name="show_all" class="btn-get-started scrollto" value="전체검색" style="background: none; outline: none">
                        <input type="submit" name="show_cond" class="btn-get-started scrollto" value="조건부검색" style="background: none; outline: none">
                        <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="저장">
                    </div>

<!--                    <button class="btn-get-started open-button" onclick="openForm()">　</button>-->
<!--                    <div class="form-popup" id="myForm">-->
<!--                        <form action="/action_page.php" class="form-container">-->
<!--                            <h1>Login</h1>-->
<!---->
<!--                            <label for="email"><b>Email</b></label>-->
<!--                            <input type="text" placeholder="Enter Email" name="email" required>-->
<!---->
<!--                            <label for="psw"><b>Password</b></label>-->
<!--                            <input type="password" placeholder="Enter Password" name="psw" required>-->
<!---->
<!--                            <button type="submit" class="btn">Login</button>-->
<!--                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>-->
<!--                        </form>-->
<!--                    </div>-->
                </div>
            </div>
        </form>
    </section>
</main>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>

<!--==========================
  Showing table
============================-->
<script>
    function showMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "block";
    }
    function hideMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "none";
    }
</script>

<footer class="footer-links">

</footer>

<?php
//-------------------------
//      POST
//-------------------------
if (array_key_exists('save_material', $_POST)) {
    save_material();
}
if (array_key_exists('show_all', $_POST)) {
    showMaterial('all');
    alert("전체 검색 완료.");
}
if (array_key_exists('show_cond', $_POST)) {
    $arr = array();

    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $month      = ($_POST['ibox_month']);
    $class      = ($_POST['ibox_class']);

    if (!empty($date)) {
        $arr['date'] = $date;
    }
    if (!empty($supplier)) {
        $arr['supplier'] = $supplier;
    }
    if (!empty($item)) {
        $arr['item'] = $item;
    }
    if (!empty($design)) {
        $arr['design'] = $design;
    }
    if (!empty($month)) {
        $arr['month'] = $month."月份";
    }
    if (!empty($class)) {
        $arr['class'] = $class;
    }

    showMaterial($arr);

    $cond = "";
    foreach ($arr as $k => $v) {
        $cond = $cond.$k."=$v,";
    }
    $cond = substr($cond, 0, -1);
    alert($cond." 조건부 검색 완료.");
}

function showMaterial($condition) {
    if ($condition == 'all') {
        $sql = "SELECT * FROM material";
    }
    else {
        $sql = "SELECT * FROM material WHERE ";
        $cnt = 0;
        foreach ($condition as $k => $v) {
            $sql = $sql.$k."='{$v}'";
            if (($cnt + 1) != count($condition)) {
                $sql = $sql." AND ";
            }
            $cnt += 1;
        }
    }
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $res = mysqli_query($conn, $sql);

    echo '
        <section id="material_view" class="section-bg" style="display: none; margin-bottom: 10%">
        <div class="container-fluid">
        <div class="section-header">
        <h3 class="section-title">원자재목록</h3>
        <span class="section-divider"></span>
        <table id="mat_table" class="container" style="overflow-x: auto; font-size: 10pt; text-align: center">
        <thead>
        <tr style="border-bottom: 1px dotted silver;">
        <th>No</th>
        <th>Date</th>
        <th>Supp</th>
        <th>Item</th>
        <th>Design</th>
        <th>Qty</th>
        <th>Month</th>
        <th>Class</th>
        <th>Worker</th>
        <th>Erase</th>
        </tr>
        </thead>
        <tbody id="mat_tbody" class="dynamics">
';
    $num = 0;
    while ($row = mysqli_fetch_array($res)) {
        $num += 1;
        $name = "tItem".strval($num);
        echo '<tr style="border-bottom: 1px dotted silver"><td>' .
            $num . '</td><td>' .
            $row['date'] . '</td><td>' .
            $row['supplier'] . '</td><td>' .
            $row['item'] . '</td><td>' .
            $row['design'] . '</td><td>' .
            $row['qty'] . '</td><td>' .
            $row['month'] . '</td><td>' .
            $row['class'] . '</td><td>' .
            $row['worker'] . '</td><td>
            <input type="submit" class="btn-success" value="삭제"></td></tr>';
    }
    echo
    '</tbody>
    </table>
    </div>
    </div>
    </section>';
}

if (array_key_exists('test', $_POST)) {
    alert();
}

function update($name) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM name_info WHERE kind='{$name}'";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row['name']);
        echo "<option value='$var'>";
    }
}

function save_material() {
    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $qty        = ($_POST['ibox_qty']);
    $month      = ($_POST['ibox_month'])."月份";
    $class      = ($_POST['ibox_class']);
    $worker     = ($_SESSION['user_id']);

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
    if (empty($qty)) {
        alert("quantity 값을 입력하세요.");
        return;
    }
    if (empty($class)) {
        alert("class 값을 입력하세요.");
        return;
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
            VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

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

<a href="#" class="back-to-top" onclick="hideMaterial('material_view')"><i class="fa fa-chevron-up"></i></a>

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