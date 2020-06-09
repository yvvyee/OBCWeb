<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
}
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
    </head>
    <body>
    <header>
        <!--==============================================================================

                        타이틀 영역

            ================================================================================-->
        <div class="section-header" style="background-color: transparent; text-align: center; justify-content: center">
            <a href="./main.php"><img src="./img/obc_logo.JPG" alt="Outlook Bone China Logo" title="OBC" style="width: 200px"></a>
            <p style="font-style: italic; font-family: 'Monotype Corsiva'; font-size: 12pt; color: black">Tangshan outlook bone china co,.ltd</p>
        </div>
    </header>
    <form id="submit-form" method="POST">
        <!--==============================================================================

                        입력 영역

            ================================================================================-->
        <div id="input_form" style="position: relative">
            <div class="center">
                <h1>出货资料</h1>
            </div>
            <div class="center">
                <label for="ibox_no">
                    <input type="number"
                           id="ibox_no"
                           name="ibox_no"
                           placeholder="No"
                           style="min-width: 200px; min-height: 40px; display: none">
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
                  Packing rate
                ============================-->
            <div class="center">
                <label for="ibox_rate">
                    <input type="number"
                           name="ibox_rate"
                           id="ibox_rate"
                           placeholder="Packing rate"
                           style="min-width: 200px; min-height: 40px"
                           value="<?php
                           if (isset($_POST['ibox_rate'])) {
                               echo htmlentities($_POST['ibox_rate']);
                           } ?>">
                </label>
            </div>
            <!--==========================
                  Unit price
                ============================-->
            <div class="center">
                <label for="ibox_price">
                    <input type="number"
                           step="any"
                           name="ibox_price"
                           id="ibox_price"
                           placeholder="Unit price"
                           style="min-width: 200px; min-height: 40px"
                           value="<?php
                           if (isset($_POST['ibox_price'])) {
                               echo htmlentities($_POST['ibox_price']);
                           } ?>">
                </label>
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
                <input class="btn-get-started btn-info scrollto"
                       id="updateButton"
                       type="button"
                       name="save"
                       style="outline: none"
                       onclick="submit_data(this)"
                       value="Save">
                <input class="btn-get-started btn-success"
                       id="searchButton"
                       type="button"
                       name="search"
                       style="outline: none"
                       onclick="submit_data(this)"
                       value="Search">
            </div>
        </div>
    </form>
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

        function submit_data(ctl)
        {
            var msg = ctl.name;
            if (msg === 'del') {
                fillIBox(ctl);
            }
            var ib_no = document.getElementById( "ibox_no" );
            var ib_supplier = document.getElementById( "ibox_supplier" );
            var ib_item = document.getElementById( "ibox_item" );
            var ib_design = document.getElementById( "ibox_design" );
            var ib_rate = document.getElementById( "ibox_rate" );
            var ib_price = document.getElementById( "ibox_price" );
            var ib_worker = document.getElementById( "ibox_worker" );

            $.ajax({
                type: 'post',
                url: 'shipping.php',
                data: {
                    msg:msg,
                    no:ib_no.value,
                    supplier:ib_supplier.value,
                    item:ib_item.value,
                    design:ib_design.value,
                    rate:ib_rate.value,
                    price:ib_price.value,
                    worker:ib_worker.value,
                },

                success: function (response) {
                    if (msg === 'search') {
                        changeTable(response);
                    }
                    if (msg === 'save') {
                        updateRow(response);
                        alert("저장 완료");
                    }
                    if (msg === 'update') {
                        updateRow(response);
                        alert("수정 완료");
                    }
                    if (msg === 'del') {
                        deleteRow(ctl);
                        alert("삭제 완료");
                    }
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

        function addRow(content_str) {
            if ($("#ship_table", "tbody").length === 0) {
                $("#ship_table").append("<tbody></tbody>");
            }
            $("#mat_table").children("tbody").children("tr").prepend(content_str)
        }

        var _row = null;

        function fillIBox(ctl) {
            _row = $(ctl).parents("tr");
            var cols = _row.children("td");

            $("#ibox_no").val($(cols[0]).text());
            $("#ibox_supplier").val($(cols[1]).text());
            $("#ibox_item").val($(cols[2]).text());
            $("#ibox_design").val($(cols[3]).text());
            $("#ibox_rate").val($(cols[4]).text());
            $("#ibox_price").val($(cols[5]).text());
            $("#ibox_worker").val($(cols[6]).text());
        }

        function displayRow(ctl) {
            _activeId = ctl.id;

            fillIBox(ctl);

            $("#updateButton").val("Update");
            $("#updateButton").attr("name", "update");
            window.location.href = "#input_form";
        }

        function updateRow(src) {
            if ($("#updateButton").val() == "Update") {
                updateRowInTable();
            } else {
                addToTable(src);
            }
            $("#ibox_date").focus();
        }

        function deleteRow(ctl) {
            $(ctl).parents("tr").remove();
            formClear();
        }

        function formClear() {
            if ($("#updateButton").val() == "Update") {
                $("#updateButton").val("Save");
                $("#updateButton").attr("name", "save");
                window.location.href = "#input_form";
            }
            $("#ibox_no").val("");
            $("#ibox_supplier").val("");
            $("#ibox_item").val("");
            $("#ibox_design").val("");
            $("#ibox_rate").val("");
            $("#ibox_price").val("");
            $("#ibox_worker").val("");
        }

        function isEmpty(str) {
            return (!str || 0 === str.length);
        }

        function addToTable(src) {
            if ($("#ship_table").length == 0) {
                $("#table_root").append("<table id='ship_table' class='responsive-table' style='min-font-size: 9pt'>"
                    + "<thead>"
                    + "<tr>"
                    + "<th style='display: none'>No</th>"
                    + "<th>Supplier</th>"
                    + "<th>Item</th>"
                    + "<th>Design</th>"
                    + "<th>Rate</th>"
                    + "<th>Price</th>"
                    + "<th style='display: none'>Worker</th>"
                    + "<th>Edit</th>"
                    + "<th>Del</th>"
                    + "</tr>"
                    + "</thead>"
                    + "<tbody></tbody>");
            }

            var parser = new DOMParser();
            var htmlDoc = parser.parseFromString(src, 'text/html');
            var new_row = $(htmlDoc).find('#temp_row').html();

            $("#ship_table tbody").prepend(new_row);
        }

        function updateRowInTable() {
            var cols = _row.children("td");

            $(cols[0]).text($("#ibox_no").val());
            $(cols[1]).text($("#ibox_supplier").val());
            $(cols[2]).text($("#ibox_item").val());
            $(cols[3]).text($("#ibox_design").val());
            $(cols[4]).text($("#ibox_rate").val());
            $(cols[5]).text($("#ibox_price").val());
            $(cols[6]).text($("#ibox_worker").val());

            formClear();

            $("#updateButton").val("Save");
            $("#updateButton").attr("name", "save");
        }

        function changeTable(src) {
            _activeId = 0;
            _nextId = 0;
            var parser = new DOMParser();
            var htmlDoc = parser.parseFromString(src, 'text/html');

            if ($("#ship_table").length > 0) {
                header = document.querySelector("#ship_table");
                header.parentElement.removeChild(header);
            }

            var new_page = $(htmlDoc).find('#temp_page').html();
            $("#table_root").append(new_page);

            formClear();
        }

        $(document).keydown(function(e) {
            // ESCAPE key pressed
            if (e.keyCode == 27) {
                formClear();
            }
        });
    </script>
    <!--==============================================================================

                    PHP 코드

        ================================================================================-->
<?php
if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'search') {
        getShipping();
    }
    if ($_POST['msg'] == 'update') {
        updateShipping();
    }
    if ($_POST['msg'] == 'save') {
        saveShipping();
    }
    if ($_POST['msg'] == 'del') {
        deleteShipping();
    }
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$count = 0;
function getShipping() {
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $rate       = ($_POST['rate']);
    $price      = ($_POST['price']);
    $worker     = ($_POST['worker']);

    if (empty($supplier) and
        empty($item) and
        empty($design) and
        empty($rate) and
        empty($price) and
        empty($worker)) {

        $sql = "SELECT * FROM shipping ORDER BY no DESC";
        $condition = "전체검색";

    } else {
        $sql = "SELECT * FROM shipping WHERE ";
        $condition = "검색조건 = ";
        if (!empty($supplier)) {
            $sql = $sql."supplier='{$supplier}' AND ";
            $condition = $condition."supplier = {$supplier},";
        }
        if (!empty($item)) {
            $sql = $sql."item='{$item}' AND ";
            $condition = $condition."item = {$item},";
        }
        if (!empty($design)) {
            $sql = $sql."design='{$design}' AND ";
            $condition = $condition."design '{$design}',";
        }
        if (!empty($class)) {
            $sql = $sql."class='{$class}' AND ";
            $condition = $condition."class = {$class},";
        }
        if (!empty($rate)) {
            $sql = $sql."rate='{$rate}' AND ";
            $condition = $condition."rate = {$rate},";
        }
        if (!empty($price)) {
            $sql = $sql."price='{$price}' AND ";
            $condition = $condition."price = {$price},";
        }
        if (!empty($worker)) {
            $sql = $sql."worker='{$worker}' AND ";
            $condition = $condition."worker = {$worker},";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql."ORDER BY no DESC";
        $condition = substr($condition, 0, -1);
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $res = mysqli_query($conn, $sql);

    global $count;
    $count = 0;
    $new_page = "<table id=\"ship_table\" class='responsive-table' style='min-font-size: 9pt'>
                    <caption style='text-align: center'>{$condition}</caption>
                        <thead>
                        <tr>
                            <th style='display: none'>No</th>
                            <th>Supplier</th>
                            <th>Item</th>
                            <th>Design</th>
                            <th>Rate</th>
                            <th>Price</th>
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
                <td>".$row['supplier']."</td>
                <td>".$row['item']."</td>
                <td>".$row['design'] . "</td>
                <td>".$row['rate'] . "</td>
                <td>".$row['price'] . "</td>
                <td>".$row['class'] . "</td>
                <td style='display: none'>".$row['worker'] . "</td>
                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
                <td><button id=\"$count\" name=\"del\" class=\"btn-danger\" onclick=\"submit_data(this); return false;\">D</button></td>
            </tr>";
        $count++;
    }
    $new_page = $new_page."</tbody></table>";

    echo "<script type='text/html' id='temp_page'>$new_page</script>";
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

function saveShipping() {
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $rate       = ($_POST['rate']);
    $price      = ($_POST['price']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

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
    if (empty($class)) {
        alert("class 값을 입력하세요.");
        return;
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "INSERT INTO shipping (supplier, item, design, rate, price, class, worker) 
                VALUES ('{$supplier}', '{$item}', '{$design}', {$rate}, '{$price}', '{$class}', '{$worker}')";

    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        global $count;
        $new_row = "<tr style=\"border-bottom: 1px dotted silver\">
                <td style=\"display: none\">".$no."</td>
                <td>".$supplier."</td>
                <td>".$item."</td>
                <td>".$design . "</td>
                <td>".$rate . "</td>
                <td>".$price . "</td>
                <td>".$class . "</td>
                <td style='display: none'>".$worker . "</td>
                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
                <td><button id=\"$count\" class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">D</button></td>
            </tr>";
        $count++;
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/html' id='temp_row'>".$new_row."</script>";
    }
}

function updateShipping() {
    $no         = ($_POST['no']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $rate       = ($_POST['rate']);
    $price      = ($_POST['price']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

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
    $sql = "UPDATE shipping SET supplier = '{$supplier}', item = '{$item}', design = '{$design}', rate = {$rate}, price = '{$price}', class = '{$class}', worker = '{$worker}' WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}

function deleteShipping() {
    $no         = ($_POST['no']);
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "DELETE FROM shipping WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}
?>