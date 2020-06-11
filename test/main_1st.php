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
    <link href="css/obc_style.css" rel="stylesheet">

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

    <style>

    </style>

    <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
    <section id="intro" style="top: 0px; position: absolute; min-height: 850px">
        <!--==============================================================================

                        타이틀 영역

            ================================================================================-->
        <div class="container" style="background-color: transparent; text-align: center; justify-content: center">
            <a href="#intro"><img src="img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="max-width: 50%"></a>
            <p style="font-style: italic; font-family: 'Monotype Corsiva'; font-size: 10pt">Tangshan outlook bone china co,.ltd</p>
        </div>
        <!--==============================================================================
    
                        테이블 영역
    
            ================================================================================-->
        <div class="container">
            <div role="region" aria-labelledby="HeadersCol" tabindex="0" class="rowheaders">
                <table id="mat_table" style="display: none">
                    <caption id="HeadersCol">Books with a Fixed Row Header Column</caption>
                    <thead>
    <!--                    <tr>-->
    <!--                        <th>No</th>-->
    <!--                        <th>Date</th>-->
    <!--                        <th>Supplier</th>-->
    <!--                        <th>Item</th>-->
    <!--                        <th>Design</th>-->
    <!--                        <th>Qty</th>-->
    <!--                        <th>Month</th>-->
    <!--                        <th>Class</th>-->
    <!--                        <th>Worker</th>-->
    <!--                        <th></th>-->
    <!--                    </tr>-->
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">No</th>
                        <td>The Ingenious Gentleman Don Quixote of La Mancha</td>
                        <td>1605</td>
                        <td>9783125798502</td>
                        <td>3125798507</td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td>La Belle et la Bête</td>
                        <td>1740</td>
                        <td>9781910880067</td>
                        <td>191088006X</td>
                    </tr>
                    <tr>
                        <th scope="row">Supplier</th>
                        <td>The Method of Fluxions and Infinite Series: With Its Application to the Geometry of Curve-lines</td>
                        <td>1763</td>
                        <td>9781330454862</td>
                        <td>1330454863</td>
                    </tr>
                    <tr>
                        <th scope="row">Item</th>
                        <td>Frankenstein; or, The Modern Prometheus</td>
                        <td>1818</td>
                        <td>9781530278442</td>
                        <td>1530278449</td>
                    </tr>
                    <tr>
                        <th scope="row">Design</th>
                        <td>Moby-Dick; or, The Whale</td>
                        <td>1851</td>
                        <td>9781530697908</td>
                        <td>1530697905</td>
                    </tr>
                    <tr>
                        <th scope="row">Qty</th>
                        <td>The Hidden Hand</td>
                        <td>1888</td>
                        <td>9780813512969</td>
                        <td>0813512964</td>
                    </tr>
                    <tr>
                        <th scope="row">Month</th>
                        <td>The Great Gatsby</td>
                        <td>1925</td>
                        <td>9780743273565</td>
                        <td>0743273567</td>
                    </tr>
                    <tr>
                        <th scope="row">Class</th>
                        <td>Nineteen Eighty-Four</td>
                        <td>1948</td>
                        <td>9780451524935</td>
                        <td>0451524934</td>
                    </tr>
                    <tr>
                        <th scope="row">Worker</th>
                        <td>Who Fears Death</td>
                        <td>2010</td>
                        <td>9780756406691</td>
                        <td>0756406692</td>
                    </tr>
                    <tr>
                        <th scope="row">Button</th>
                        <td>Who Fears Death</td>
                        <td>2010</td>
                        <td>9780756406691</td>
                        <td>0756406692</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--==============================================================================
        
                        버튼 영역
    
            ================================================================================-->
        <div id="input_form" class="modal fade" style="display: none">
            <form method="post" >
                <div class="modal-dialog">
                    <div  class="intro-text modal-content" style="background: none; width: 180px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
                        <!--==========================
                          Date
                        ============================-->
                        <div>
                            <label for="ibox_date">
                                <input type="date"
                                       id="ibox_date"
                                       name="ibox_date"
                                       placeholder="Date"
                                       style="width: 162px; height: 33px"
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
                                <?php echo updateDatalist('supplier'); ?>
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
                                <?php echo updateDatalist('item'); ?>
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
                                <?php echo updateDatalist('design'); ?>
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
                                <?php echo updateDatalist('class'); ?>
                            </datalist>
                        </div>
                        <a href="#material_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('material_view')"><i class="fa fa-link"></i>보기
                        </a>
                        <input type="submit" name="show_all" class="btn-get-started scrollto" value="전체검색" style="background: none; outline: none">
                        <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="저장">
    
    
                        <!--==========================
                          Buttons onclick="showMaterial('material')"
                        ============================-->
                        <!--                    <div>-->
                        <!--                        <a href="#material_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('material_view')"><i class="fa fa-link"></i>보기-->
                        <!--                        </a>-->
                        <!--                        <input type="submit" name="show_all" class="btn-get-started scrollto" value="전체검색" style="background: none; outline: none">-->
                        <!--                        <input type="submit" name="show_cond" class="btn-get-started scrollto" value="조건부검색" style="background: none; outline: none">-->
                        <!--                        <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="저장">-->
                        <!--                    </div>-->
    
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
        </div>
    
        <button class="btn-get-started open-button" style="outline: none" data-toggle="modal" data-target="#input_form" onclick="openForm()">열기</button>
    
    </section>
    <!--==============================================================================
    
                스크립트 함수

    ================================================================================-->
    <script>
        function openForm() {
            document.getElementById("input_form").style.display = "block";
        }
    
        function closeForm() {
            document.getElementById("input_form").style.display = "none";
        }
    
        $(function(){
            fixTh();
    
            $(window).on('resize',function(){
                fixTh();
            });
        });
    
        function fixTh () {
            if ($(window).width() < 1000) {
                $('.tb_box').on('scroll',function(){
                    var tbBox = $('.tb_box');
                    var th1 = $('.tb_box tr:nth-child(1) th:nth-child(1)')
                    var th2 = $('.tb_box tr:nth-child(1) th:nth-child(2)');
                    var td1 = $('.tb_box tr:nth-child(n+2) th')
                    var td2 = $('.tb_box td:nth-child(2)')
                    var scrLeft = tbBox.scrollLeft();
                    var fixLeft = tbBox.offset().left;
    
                    tbBox.find('tr:nth-child(1)').css({
                        'transform' : 'translateX(' + - scrLeft + 'px)'
                    });
    
                    if ($(this).scrollLeft() > 0) {
                        th1.offset({
                            'left':fixLeft
                        });
                        th2.css({
                            'margin-left': -scrLeft
                        });
                        td1.offset({
                            'left':fixLeft
                        });
                        td2.css({
                            'margin-left': -scrLeft
                        });
                    } else {
                        th1.css({
                            'left': 0
                        });
                        td1.css({
                            'left':0
                        });
                    }
                });
            }
        };
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
    <!--==============================================================================
        
                    PHP 코드
    
        ================================================================================-->
    <?php
    //-------------------------
    //      POST
    //-------------------------
    if (array_key_exists('save_material', $_POST)) {
        updateStock();
    }
    if (array_key_exists('show_all', $_POST)) {
        getStock('all');
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

        getStock($arr);

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
</body>
</html>