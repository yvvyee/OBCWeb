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
    <header>
        <!--==============================================================================

                        타이틀 영역

            ================================================================================-->
        <div class="section-header" style="background-color: transparent; text-align: center; justify-content: center">
            <a href="#intro"><img src="./img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="width: 200px"></a>
            <p style="font-style: italic; font-family: 'Monotype Corsiva'; font-size: 12pt; color: black">Tangshan outlook bone china co,.ltd</p>
        </div>
    </header>
    <form id="submit-form" method="POST">
        <!--==============================================================================

                        입력 영역

            ================================================================================-->
        <div id="input_form" style="position: relative">
            <div class="center">
                <label for="ibox_no">
                    <input type="no"
                           id="ibox_no"
                           name="ibox_no"
                           placeholder="No"
                           style="min-width: 200px; min-height: 40px; display: none">
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
                           placeholder="Date"
                           style="min-width: 200px; min-height: 40px"
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
                           placeholder="Supplier"
                           autocomplete="off"
                           style="min-width: 200px; min-height: 40px"
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
                           placeholder="Item"
                           autocomplete="off"
                           style="min-width: 200px; min-height: 40px"
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
            <div class="center">
                <label for="ibox_design">
                    <input type="text"
                           name="ibox_design"
                           id="ibox_design"
                           list="design_list"
                           placeholder="Design"
                           autocomplete="off"
                           style="min-width: 200px; min-height: 40px"
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
                  Quantity
                ============================-->
            <div class="center">
                <label for="ibox_qty">
                    <input type="number"
                           name="ibox_qty"
                           id="ibox_qty"
                           placeholder="Qty"
                           style="min-width: 200px; min-height: 40px"
                           value="<?php
                           if (isset($_POST['ibox_qty'])) {
                               echo htmlentities($_POST['ibox_qty']);
                           } ?>">
                </label>
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
                           placeholder="Month"
                           style="min-width: 200px; min-height: 40px"
                           value="<?php
                           if (isset($_POST['ibox_month'])) {
                               echo htmlentities($_POST['ibox_month']);
                           } ?>">
                </label>
                <datalist id="month_list">
                    <option value='1月份'>
                    <option value='2月份'>
                    <option value='3月份'>
                    <option value='4月份'>
                    <option value='5月份'>
                    <option value='6月份'>
                    <option value='7月份'>
                    <option value='8月份'>
                    <option value='9月份'>
                    <option value='10月份'>
                    <option value='11月份'>
                    <option value='12月份'>
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
                           placeholder="Class"
                           autocomplete="off"
                           style="min-width: 200px; min-height: 40px"
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
                  Worker
                ============================-->
            <div class="center">
                <label for="ibox_worker">
                    <input type="text"
                           name="ibox_worker"
                           id="ibox_worker"
                           list="worker_list"
                           placeholder="Worker"
                           autocomplete="off"
                           style="min-width: 200px; min-height: 40px"
                           value="<?php
                           if (isset($_POST['ibox_worker'])) {
                               echo htmlentities($_POST['ibox_worker']);
                           } ?>">
                </label>
                <datalist id="worker_list">
                    <option value='付秀丽 '>
                    <option value='何删'>
                </datalist>
            </div>
            <!--==========================
                  Button
                ============================-->
            <div class="center">
                <button id="updateButton" type="submit" name="save" class="btn-get-started btn-info scrollto" style="outline: none" value="Save">Save</button>
                <input id="searchButton" type="submit" name="search" class="btn-get-started btn-success" style="outline: none" value="Search">
            </div>
        </div>

    </form>
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

    <div class="center">
        <div class="button-container">
            <a href="#navi" data-toggle="modal"></a>
            <div class="button-image">
                <img src="./img/icon/HOME.png" alt="">
            </div>
        </div>
    </div>
    <!--==============================================================================

                    테이블 영역

        ================================================================================-->
    <div id="table_root" class="table-area center" style="margin-bottom: 10%; margin-top: 5%">
    </div>
    <a href="#input_form" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    </body>
    </html>
    <!--==============================================================================

                    스크립트 함수

        ================================================================================-->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

        function submit_data(msg)
        {
            var no = document.getElementById( "name_of_user" );
            var date = document.getElementById( "age_of_user" );
            var supplier = document.getElementById( "course_of_user" );

            $.ajax({
                type: 'post',
                url: 'material.php',
                data: {
                    user_name:name,
                    user_age:age,
                    user_course:course
                },

                success: function (response) {
                    alert("submitted successfully");
                }
            });
            return false;
        }

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
        function addRow(tab_id, content_str) {
            // First check if a <tbody> tag exists, add one if not
            if ($(tab_id, "tbody").length === 0) {
                $(tab_id).append("<tbody></tbody>");
            }

            // Append product to the table
            $(tab_id).children("tbody").children("tr").prepend(content_str)
        }

        var _row = null;
        function displayRow(ctl) {
            _activeId = ctl.id;
            _row = $(ctl).parents("tr");
            var cols = _row.children("td");

            $("#ibox_no").val($(cols[0]).text());
            $("#ibox_date").val($(cols[1]).text());
            $("#ibox_supplier").val($(cols[2]).text());
            $("#ibox_item").val($(cols[3]).text());
            $("#ibox_design").val($(cols[4]).text());
            $("#ibox_qty").val($(cols[5]).text());
            $("#ibox_month").val($(cols[6]).text());
            $("#ibox_class").val($(cols[7]).text());
            $("#ibox_worker").val($(cols[8]).text());

            $("#updateButton").val("Update");
            $("#updateButton").attr("name", "update");
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

        // $("#input_form").on('hidden.bs.modal', function () {
        //     $("#updateButton").val("Save");
        //     $("#updateButton").attr("name", "save");
        // })

        // $("#input_form").modal({"backdrop": "static"});

        // $("#submit-form").submit(function (e) {
        //     e.preventDefault();
            // return false;
        // })

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
if (array_key_exists('save_material', $_POST)) {
    updateMaterial();
}
if (array_key_exists('show_all', $_POST)) {
    getMaterial(false);
}
if (array_key_exists('search', $_POST)) {
    getMaterial();
}
if (array_key_exists('update', $_POST)) {
    updateMaterial();
}
if (array_key_exists('save', $_POST)) {
    saveMaterial();
}
if (array_key_exists('update', $_POST)) {
    updateMaterial();
}
$count = 0;
function getMaterial() {
    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $month      = ($_POST['ibox_month']);
    $class      = ($_POST['ibox_class']);
    $worker     = ($_POST['ibox_worker']);

    if (empty($date) and
        empty($supplier) and
        empty($item) and
        empty($design) and
        empty($month) and
        empty($class) and
        empty($worker)) {

        $sql = "SELECT * FROM material ORDER BY no DESC";
        $table_title = "전체검색";

    } else {
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
        if (!empty($worker)) {
            $sql = $sql."worker='{$worker}' AND ";
            $table_title = $table_title."worker = {$class},";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql."ORDER BY no DESC";
        $table_title = substr($table_title, 0, -1);
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $res = mysqli_query($conn, $sql);

    global $count;
    $count = 0;
//    style="overflow-x: auto; min-font-size: 9pt; text-align: center; justify-content: center"
    $new_page = "<table id=\"mat_table\" class='responsive-table' style='min-font-size: 9pt'>
                        <thead>
                        <tr>
                            <th style='display: none'>No</th>
                            <th>Date</th>
                            <th style='display: none'>Supplier</th>
                            <th>Item</th>
                            <th>Design</th>
                            <th>Qty</th>
                            <th style='display: none'>Month</th>
                            <th>Class</th>
                            <th style='display: none'>Worker</th>
                            <th>Edit</th>
                            <th>Del</th>
                        </tr>
                        </thead>
                        <tbody>";


    while ($row = mysqli_fetch_array($res)) {
        $new_page = $new_page.
            "<tr style=\"border-bottom: 1px dotted silver\">
                <td style=\"display: none\">".$row['no']."</td>
                <td>".$row['date']."</td>
                <td style='display: none'>".$row['supplier']."</td>
                <td>".$row['item']."</td>
                <td>".$row['design'] . "</td>
                <td>".$row['qty'] . "</td>
                <td style='display: none'>".$row['month'] . "</td>
                <td>".$row['class'] . "</td>
                <td style='display: none'>".$row['worker'] . "</td>
                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
                <td>"."<button id=\".$count.\" class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">D</button></td>
            </tr>";
        $count++;
    }
    $new_page = $new_page."</tbody></table>";

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
    $month      = ($_POST['ibox_month']);
    $class      = ($_POST['ibox_class']);
    $worker     = ($_POST['ibox_worker']);

    if (empty($date)) {
        alert("date 값을 입력하세요.");
        return;
    }
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
        $new_row = "<tr style=\"border-bottom: 1px dotted silver\">
                <td style=\"display: none\">".$no."</td>
                <td>".$date."</td>
                <td style='display: none'>".$supplier."</td>
                <td>".$item."</td>
                <td>".$design . "</td>
                <td>".$qty . "</td>
                <td style='display: none'>".$month . "</td>
                <td>".$class . "</td>
                <td style='display: none'>".$worker . "</td>
                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
                <td>"."<button id=\".$count.\" class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">D</button></td>
            </tr>";
        echo "<script>addRow('#mat_table', $new_row)</script>";
        $count++;
    }

    if (mysqli_query($conn, $sql)) {
        alert("정상적으로 '저장'되었습니다.");
    }
}

function updateMaterial() {
    $no         = ($_POST['ibox_no']);
    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $qty        = ($_POST['ibox_qty']);
    $month      = ($_POST['ibox_month']);
    $class      = ($_POST['ibox_class']);
    $worker     = ($_POST['ibox_worker']);

    if (empty($date)) {
        alert("date 값을 입력하세요.");
        return;
    }
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
    $sql = "UPDATE material SET date = '{$date}', supplier = '{$supplier}', item = '{$item}', design = '{$design}', qty = {$qty}, month = '{$month}', class = '{$class}', worker = '{$worker}' WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
        alert("정상적으로 '수정'되었습니다.");
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