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
    <link href="../css/obc_style.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="../js/main.js"></script>
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

    <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
    <section id="intro" style="top: 0px; position: absolute; min-height: 850px">
        <form id="submit-form" method="post" action="">
        <!--==============================================================================

                        타이틀 영역

            ================================================================================-->
        <div class="container" style="background-color: transparent; text-align: center; justify-content: center">
            <a href="#intro"><img src="../img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="max-width: 35%"></a>
            <p style="font-style: italic; font-family: 'Monotype Corsiva'; font-size: 10pt">Tangshan outlook bone china co,.ltd</p>
        </div>
        <!--==============================================================================
    
                        테이블 영역
    
            ================================================================================-->
        <div class="container">
            <div id="table_root" role="region" aria-labelledby="HeadersCol" tabindex="0" class="rowheaders">

            </div>
        </div>
        <!--==============================================================================
        
                        버튼 영역
    
            ================================================================================-->
        <div id="input_form" class="modal fade" style="display: none">
                <div class="modal-dialog">
                    <div class="intro-text modal-content" style="background: none; width: 270px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 10px; position: absolute; color: red; border-color: white">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <a href="#mat_table" class="btn-get-started btn-info scrollto" style="outline: none" onclick="openForm('mat_table', this)">-->
<!--                            보기-->
<!--                        </a>-->
<!--                        <a href="#mat_table" class="btn-get-started btn-info scrollto" style="outline: none">-->
<!--                            보기-->
<!--                        </a>-->
<!--                        <button type="submit" name="show_all" style="background: none; outline: none">전체검색</button>-->
                        <div>
                            <input id="updateButton" type="submit" name="save" class="btn-get-started btn-info" style="outline: none" value="Save">
                            <input id="searchButton" type="submit" name="search" class="btn-get-started btn-success" style="outline: none" value="Search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vertical-center">
                <button class="btn-get-started btn-info" data-toggle="modal" data-target="#input_form" onclick="return false">입력</button>
                <input type="submit" name="show_all" class="btn-get-started btn-info" style="outline: none" value="전체검색">
            </div>
        </form>
    </section>

    <a href="#" class="back-to-top" onclick="closeForm('mat_table')"><i class="fa fa-chevron-up"></i></a>
</body>
</html>
<!--==============================================================================

                스크립트 함수

    ================================================================================-->
<script>
    function openForm(elem, self) {
        var doc = document.getElementById(elem);
        if (doc.style.display === "block") {
            doc.style.display = "none";
        } else {
            doc.style.display = "block";
        }
    }

    function closeForm(id) {
        document.getElementById(id).style.display = "none";
    }
    // 테이블 입력
    function addRow(tab_id, row_id, content_str) {
        // First check if a <tbody> tag exists, add one if not
        if ($(tab_id, "tbody").length === 0) {
            $(tab_id).append("<tbody></tbody>");
        }

        // Append product to the table
        $(tab_id).children("tbody").children("#row_" + row_id).append(
            "<td>" + content_str +"</td>"
        )
    }

    function updateRow() {
        if ($("#updateButton").text() == "Update") {
            productUpdateInTable();
        } else {
            // Add product to Table
            addToTable();
        }
        // Clear form fields
        formClear();
        // Focus to product name field
        $("#productname").focus();
    }

    function deleteRow(ctl) {
        $(ctl).parents("tr").remove();
    }

    function formClear() {
        $("#productname").val("");
        $("#introdate").val("");
        $("#url").val("");
    }

    function addToTable() {
        // First check if a <tbody> tag exists, add one if not
        if ($("#productTable tbody").length == 0) {
            $("#productTable").append("<tbody></tbody>");
        }

        // Append product to the table
        $("#productTable tbody").append(
            "<tr>" +
            // "<td><button onclick='productDisplay(this)'>E</button></td>" +
            // "<td><input style='width: 100%' value=" + $("#productname").val() + "></td>" +
            // "<td><input style='width: 100%' value=" + $("#introdate").val() + "></td>" +
            // "<td><input style='width: 100%' value=" + $("#url").val() + "></td>" +
            // "<td><button onclick='productDelete(this)'>X</button></td>" +
            "<td><button onclick='displayRow(this)'>E</button></td>" +
            "<td>" + $("#productname").val() + "</td>" +
            "<td>" + $("#introdate").val() + "</td>" +
            "<td>" + $("#url").val() + "</td>" +
            "<td><button onclick='deleteRow(this)'>X</button></td>" +
            "</tr>"
        );
    }

    var _row = null;
    function displayRow(ctl) {

        //$($($($($(ctl).parents("tbody")).children("tr")[9]).children("td")[0]).children('button')).text()
        //$($($($(ctl).parents("tbody")).children("tr")[0]).children("td")[0]).text()
        id = parseInt(ctl.id);
        _row = $(ctl).parents("tbody").children("tr");
        no = $($(_row[0]).children("td")[id]);
        date = $($(_row[1]).children("td")[id]);
        supplier = $($(_row[2]).children("td")[id]);
        item = $($(_row[3]).children("td")[id]);
        design = $($(_row[4]).children("td")[id]);
        qty = $($(_row[5]).children("td")[id]);
        month = $($(_row[6]).children("td")[id]);
        cls = $($(_row[7]).children("td")[id]);
        worker = $($(_row[8]).children("td")[id]);

        $("#input_form").modal('show');

        $("#ibox_date").val(date.text());
        $("#ibox_supplier").val(supplier.text());
        $("#ibox_item").val(item.text());
        $("#ibox_design").val(design.text());
        $("#ibox_qty").val(qty.text());
        $("#ibox_month").val(month.text().replace("月份", ""));
        $("#ibox_class").val(cls.text());
        $("#HeadersCol").text(no.text());

        // _activeId = $($(cols[0]).children("button")[0]).data("id");
        // $("#productname").val($(cols[1]).text());
        // $("#introdate").val($(cols[2]).text());
        // $("#url").val($(cols[3]).text());
        // Change Update Button Text
        $("#updateButton").val("Update");
        $("#updateButton").attr("name", "update");
    }

    function productUpdateInTable() {
        // Add changed product to table
        $(_row).after(productBuildTableRow(_activeId));
        // Remove old product row
        $(_row).remove();
        // Clear form fields
        formClear();
        // Change Update Button Text
        $("#updateButton").text("Add");
    }
    // Next ID for adding a new Product
    var _nextId = 1;
    // ID of Product currently editing
    var _activeId = 0;
    function productBuildTableRow(id) {
        var ret =
            "<tr>" +
            "<td>" +
            "<button type='button' " +
            "onclick='displayRow(this);' " +
            "class='btn btn-default' " +
            "data-id='" + id + "'>" +
            "<span class='glyphicon glyphicon-edit' />" +
            "E</button>" +
            "</td>" +
            "<td>" + $("#productname").val() + "</td>" +
            "<td>" + $("#introdate").val() + "</td>" +
            "<td>" + $("#url").val() + "</td>" +
            "<td>" +
            "<button type='button' " +
            "onclick='deleteRow(this);' " +
            "class='btn btn-default' " +
            "data-id='" + id + "'>" +
            "<span class='glyphicon glyphicon-remove' />" +
            "X</button>" +
            "</td>" +
            "</tr>"

        return ret;
    }

    function changeTable() {
        var new_page = $('#temp_page').html();
        $("#table_root").append(new_page);

        header = document.querySelector("#temp_page");
        header.parentElement.removeChild(header);
        // openForm('mat_table');
    }

    $("#input_form").on('hidden.bs.modal', function () {
        $("#updateButton").val("Save");
        $("#updateButton").attr("name", "save");
    })

    // $("#input_form").modal({"backdrop": "static"});

    $("#updateButton").submit(function (e) {
        e.preventDefault();
        $("#input_form").modal('show');
        openForm('mat_table');
        return false;
    })

    // $(document).ready(function($) {
    //     $(document).on('submit', '#submit-form', function(event) {
    //         event.preventDefault();
    //         alert('page did not reload');
    //     });
    // });
    // 테스트 코드, 페이지 로드 시 테이블에 임시 데이터 입력
    // $(document).ready(function () {
    //     openForm("input_form");
    // });
</script>
<!--==============================================================================

                PHP 코드

    ================================================================================-->
<?php
//--------------------------------------------------------------------------------
//      POST
//--------------------------------------------------------------------------------
if (array_key_exists('save_material', $_POST)) {
    updateStock();
}
if (array_key_exists('show_all', $_POST)) {
    getStock(false);
}
if (array_key_exists('search', $_POST)) {
    getStock(true);
}
if (array_key_exists('update', $_POST)) {
    updateStock();
}
if (array_key_exists('save', $_POST)) {
    saveStock();
}
$count = 0;
function getMaterial($cond) {
    if ($cond) {
        $date       = ($_POST['ibox_date']);
        $supplier   = ($_POST['ibox_supplier']);
        $item       = ($_POST['ibox_item']);
        $design     = ($_POST['ibox_design']);
        $month      = ($_POST['ibox_month']);
        $class      = ($_POST['ibox_class']);

        $sql = "SELECT * FROM material WHERE ";
        $table_title = "검색조건 = ";
        if (!empty($date)) {
            $sql = $sql."date='{$date}' AND ";
            $table_title = $table_title."date = {$date},";
        }
        if (!empty($supplier)) {
            $sql = $sql."supplier='{$supplier}' AND ";
            $table_title = $table_title."supplier = {$supplier},";
        }
        if (!empty($item)) {
            $sql = $sql."item='{$item}' AND ";
            $table_title = $table_title."supplier = {$supplier},";
        }
        if (!empty($design)) {
            $sql = $sql."design='{$design}' AND ";
            $table_title = $table_title."item = '{$item}',";
        }
        if (!empty($month)) {
            $sql = $sql."month='{$month}' AND ";
            $table_title = $table_title."month = {$month},";
        }
        if (!empty($class)) {
            $sql = $sql."class='{$class}' AND ";
            $table_title = $table_title."class = {$class},";
        }
        $sql = substr($sql, 0, -4);
        $table_title = substr($table_title, 0, -1);
    }
    else {
        $sql = "SELECT * FROM material";
        $table_title = "전체검색";
    }
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $res = mysqli_query($conn, $sql);

    $row_no = "";
    $row_date = "";
    $row_supplier = "";
    $row_item = "";
    $row_design = "";
    $row_qty = "";
    $row_month = "";
    $row_class = "";
    $row_worker = "";
    $row_edit = "";
    $row_del = "";

    global $count;
    $count = 0;
    while ($row = mysqli_fetch_array($res)) {
        $row_no         = $row_no."<td id='".$count."'>".$row['no']."</td>";
        $row_date       = $row_date."<td id='".$count."'>".$row['date']."</td>";
        $row_supplier   = $row_supplier."<td id='".$count."'>".$row['supplier']."</td>";
        $row_item       = $row_item."<td id='".$count."'>".$row['item']."</td>";
        $row_design     = $row_design."<td id='".$count."'>".$row['design']."</td>";
        $row_qty        = $row_qty."<td id='".$count."'>".$row['qty']."</td>";
        $row_month      = $row_month."<td id='".$count."'>".$row['month']."</td>";
        $row_class      = $row_class."<td id='".$count."'>".$row['class']."</td>";
        $row_worker     = $row_worker."<td id='".$count."'>".$row['worker']."</td>";
        $row_edit       = $row_edit."<td><button id='".$count."' class=\"btn-success\" onclick=\"displayRow(this); return false;\">Edit</button></td>";
        $row_del        = $row_del."<td><button id='".$count."' class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">Del</button></td>";
        $count++;
    }

    $table_title = $table_title." = ".$count;

    $new_page = "<table id=\"mat_table\" style=\"display: block\">
                    <caption id=\"HeadersCol\" style='color: white'></caption>
                    <thead>
                        <tr>
                            <th id=\"mat_table_title\" colspan=\"100%\" style='text-align: left'>".$table_title."</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr id=\"row_no\">
                        <th scope=\"row\">No</th>".
                        $row_no.
                    "</tr>
                    <tr id=\"row_date\">
                        <th scope=\"row\">Date</th>".
                        $row_date.
                    "</tr>
                    <tr id=\"row_supplier\">
                        <th scope=\"row\">Supplier</th>".
                            $row_supplier.
                    "</tr>
                    <tr id=\"row_item\">
                        <th scope=\"row\">Item</th>".
                            $row_item.
                    "</tr>
                    <tr id=\"row_design\">
                        <th scope=\"row\">Design</th>".
                            $row_design.
                    "</tr>
                    <tr id=\"row_qty\">
                        <th scope=\"row\">Qty</th>".
                            $row_qty.
                    "</tr>
                    <tr id=\"row_month\">
                        <th scope=\"row\">Month</th>".
                            $row_month.
                    "</tr>
                    <tr id=\"row_class\">
                        <th scope=\"row\">Class</th>".
                            $row_class.
                    "</tr>
                    <tr id=\"row_worker\">
                        <th scope=\"row\">Worker</th>".
                            $row_worker.
                    "</tr>
                    <tr id=\"row_edit\">
                        <th scope=\"row\"></th>".
                            $row_edit.
                    "</tr>
                    <tr id=\"row_del\">
                        <th scope=\"row\"></th>".
                            $row_del.
                    "</tr>
                    </tbody>
                </table>";


    echo "<script type='text/html' id='temp_page'>".$new_page."</script>";
    echo "<script>changeTable()</script>";
}

function updateDatalist($name) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM name_info WHERE kind='{$name}'";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row['name']);
        echo "<option value='$var'>";
    }
}

function saveMaterial() {
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
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        global $count;
        echo sprintf("<script>
            addRow('#mat_table', 'no', '%s');
            addRow('#mat_table', 'date', '%s');
            addRow('#mat_table', 'supplier', '%s')
            addRow('#mat_table', 'item', '%s');
            addRow('#mat_table', 'design', '%s');
            addRow('#mat_table', 'qty', '%s');
            addRow('#mat_table', 'month', '%s');
            addRow('#mat_table', 'class', '%s');
            addRow('#mat_table', 'worker', '%s');
            addRow('#mat_table', 'edit', '<button id='%s' class=\"btn-success\" onclick=\"displayRow(this); return false;\">Edit</button>');
            addRow('#mat_table', 'del', '<button id='%s' class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">Del</button>');
            $('#mat_table_title').text('데이터 저장됨 = '.$count);
            openForm('mat_table');
            openForm('input_form');
            </script>", $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $count, $count);
        $count++;
//        alert("정상적으로 저장되었습니다.");
    }
}

function updateMaterial() {
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

//    if (mysqli_query($conn, $sql)) {
//        alert("정상적으로 저장되었습니다.");
//    }
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