<?php
$conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
$fmt_t = '<table id=\'obc_table\' class=\'responsive-table\' style=\'min-font-size: 9pt\'>
          <caption style=\'text-align: center\'>%s</caption>
          <thead><tr>%s</tr></thead><tbody>%s</tbody>';
$fmt_r = '<tr style=\'border-bottom: 1px dotted silver\'>%s</tr>';
$btn_e = '<button name=\'edit\' class=\'btn-success\' onclick=\'displayRow(this); return false;\'>E</button></td>';
$btn_d = '<button name=\'del\' class=\'btn-danger\' onclick=\'submit_data(this); return false;\'>D</button></td>';
$fmt_mat = '<%1$s style=\'display: none\'>%2$s</%1$s>
            <%1$s>%3$s</%1$s>
            <%1$s style=\'display: none\'>%4$s</%1$s>
            <%1$s>%5$s</%1$s>
            <%1$s>%6$s</%1$s>
            <%1$s>%7$s</%1$s>
            <%1$s style=\'display: none\'>%8$s</%1$s>
            <%1$s>%9$s</%1$s>
            <%1$s style=\'display: none\'>%10$s</%1$s>
            <%1$s>%11$s</%1$s>
            <%1$s>%12$s</%1$s>';

if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'search') {
        getMaterial();
    }
    if ($_POST['msg'] == 'update') {
        updateMaterial();
    }
    if ($_POST['msg'] == 'save') {
        saveMaterial();
    }
    if ($_POST['msg'] == 'del') {
        deleteMaterial();
    }
}
if (isset($_POST['btn_login'])) {
    login();
}
function alert($msg) {
    echo "<script>alert('$msg');</script>";
}
//----------------------------------------------------------------------------------------------------------------------
function login() {
    $user_id = $_POST['user_id'];
    $passwd = $_POST['passwd'];

    if ($user_id == "" || $passwd == "") {
        alert("请输入账号/密码");
        return;
    }

    global $conn;
    $sql = "SELECT * FROM user WHERE user_id='$user_id'";

    $res = mysqli_query($conn, $sql);
    if ($res->num_rows != 1) {
        alert("不存在的账户");
        return;
    }

    $row = mysqli_fetch_array( $res );
    if ($row['passwd'] != $passwd) {
        alert("密码不一致");
        return;
    }

    $_SESSION['user_id'] = $user_id;
    if (!isset($_SESSION['user_id'])) {
        alert("Session 生成失败");
        return;
    }
    header("location: main.php");
}

$count = 0;
function getMaterial() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_t;
    global $fmt_r;
    global $fmt_mat;

    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    if (empty($date) and
        empty($supplier) and
        empty($item) and
        empty($design) and
        empty($month) and
        empty($class) and
        empty($worker)) {

        $sql = "SELECT * FROM material ORDER BY no DESC";
        $condition = "전체검색";

    } else {
        $sql = "SELECT * FROM material WHERE ";
        $condition = "검색조건 = ";
        if (!empty($date)) {
            $sql = $sql."date='{$date}' AND ";
            $condition = $condition."date = {$date},";
        }
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
        if (!empty($month)) {
            $sql = $sql."month='{$month}' AND ";
            $condition = $condition."month = {$month},";
        }
        if (!empty($class)) {
            $sql = $sql."class='{$class}' AND ";
            $condition = $condition."class = {$class},";
        }
        if (!empty($worker)) {
            $sql = $sql."worker='{$worker}' AND ";
            $condition = $condition."worker = {$worker},";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql."ORDER BY no DESC";
        $condition = substr($condition, 0, -1);
    }

    $res = mysqli_query($conn, $sql);
    $thead = sprintf($fmt_mat,'th','No', '日期', '客户', '品名', '花面', '数量', '月份', '分类', '贴花人', '修改', '删除');

    $tbody = "";
    while ($row = mysqli_fetch_array($res)) {
        $cell = sprintf($fmt_mat, 'td', $row['no'], $row['date'], $row['supplier'], $row['item'],
            $row['design'], $row['qty'], $row['month'], $row['class'], $row['worker'], $btn_e, $btn_d);
        $tr = sprintf($fmt_r, $cell);
        $tbody = $tbody . $tr;
    }
    $new_table = sprintf($fmt_t, $condition, $thead, $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
    echo "<script>changeTable()</script>";
}
function saveMaterial() {
    global $conn;
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
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

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
                VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    global $fmt_mat;
    global $fmt_r;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $cell = sprintf($fmt_mat, 'td', $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $btn_e, $btn_d);
        $new_row = sprintf($fmt_r, $cell);

        echo "<script type='text/html' id='temp_row'>$new_row</script>";
    }
}
function updateDatalist($name) {
    global $conn;
    $sql = "SELECT * FROM name_info WHERE kind='{$name}'";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row['name']);
        echo "<option value='$var'>";
    }
}
//----------------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------
function updateMaterial() {
    $no         = ($_POST['no']);
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
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
    $sql = "UPDATE material 
            SET date = '{$date}', 
                supplier = '{$supplier}', 
                item = '{$item}', 
                design = '{$design}', 
                qty = {$qty}, 
                month = '{$month}', 
                class = '{$class}', 
                worker = '{$worker}' 
            WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}
//----------------------------------------------------------------------------------------------------------------------
function deleteMaterial() {
    $no         = ($_POST['no']);

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "DELETE FROM material WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}

function updateBasic() {
    $no         = ($_POST['no']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

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
    $sql = "UPDATE basic SET item = '{$item}', design = '{$design}', qty = {$qty}, class = '{$class}', worker = '{$worker}' WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}

function deleteBasic() {
    $no         = ($_POST['no']);

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "DELETE FROM basic WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {
    }
}
?>






<?php
//if (array_key_exists('msg', $_POST)) {
//    if ($_POST['msg'] == 'search') {
//        getBasic();
//    }
//    if ($_POST['msg'] == 'update') {
//        updateBasic();
//    }
//    if ($_POST['msg'] == 'save') {
//        saveBasic();
//    }
//    if ($_POST['msg'] == 'del') {
//        deleteBasic();
//    }
//    if ($_POST['msg'] == 'make') {
//        makeStock();
//    }
//}
//
//function alert($msg) {
//    echo "<script type='text/javascript'>alert('$msg');</script>";
//}
//
//$count = 0;
//function makeStock() {
//    $class = $_POST['class'];
//
//    if (empty($class)) {
//        alert("class 값을 입력하세요.");
//        return;
//    }
//
//    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
//
//    $basic = array();
//    $mat = array();
//    $sub = array();
//
//    if ($class == '白瓷') {
//        calcBaici($class, $conn, $basic, $mat, $sub);
//    }
//
//    if ($class == '花纸') {
//        $sub_name = "贴花";
//        calcStock($class, $sub_name, $conn, $basic, $mat, $sub);
//    }
//
//    if ($class == '完成品') {
//        $sub_name = "出库";
//        calcStock($class, $sub_name, $conn, $basic, $mat, $sub);
//    }
//
//    if ($class == '完成品') {
//        $sub_name = "出库";
//        calcStock($class, $sub_name, $conn, $basic, $mat, $sub);
//    }
//
//    alert($class.'库存 생성완료');
//}
//
///**
// * @param $class
// * @param mysqli $conn
// * @param array $basic
// * @param array $mat
// * @param array $sub
// * @return array
// */
//function calcBaici($class, mysqli $conn, array $basic, array $mat, array $sub)
//{
//    $sub_name = "贴花";
//    $sql = "SELECT item FROM basic WHERE class='{$class}'";
//    $items = mysqli_query($conn, $sql);
//
//    while ($row = mysqli_fetch_array($items)) {
//        $sql = "SELECT qty FROM basic WHERE class='{$class}' AND item='{$row['item']}'";
//        $basic[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
//
//        $sql = "SELECT sum(qty) FROM material WHERE class='{$class}' AND item='{$row['item']}'";
//        $mat[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
//
//        $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$row['item']}'";
//        $sub[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
//    }
//
//    $new_page = "<table id='stock_table' class='responsive-table' style='min-font-size: 9pt'>
//                    <caption style='text-align: center'>{$class}</caption>
//                        <thead>
//                        <tr>
//                            <th>{$class}</th>
//                            <th>期初</th>
//                            <th>白瓷入库</th>
//                            <th>贴花出库</th>
//                            <th>宣账白瓷</th>
//                        </tr>
//                        </thead>
//                        <tbody>";
//
//    global $count;
//    $count = 0;
//    foreach ($basic as $item => $qty) {
//        $new_page = $new_page .
//            "<tr style=\"border-bottom: 1px dotted silver\">
//                <td>" . $item . "</td>
//                <td>" . $qty . "</td>
//                <td>" . $mat[$item] . "</td>
//                <td>" . $sub[$item] . "</td>
//                <td>" . (intval($qty) + intval($mat[$item]) - intval($sub[$item])) . "</td>
//            </tr>";
//        $count++;
//    }
//    $new_page = $new_page . "</tbody></table>";
//    echo "<script type='text/html' id='temp_page'>$new_page</script>";
//}
//
///**
// * @param $class
// * @param mysqli $conn
// * @param array $basic
// * @param array $mat
// * @param array $sub
// */
//function calcStock($class, $sub_name, mysqli $conn, array $basic, array $mat, array $sub): void
//{
//    $sql = "SELECT DISTINCT item FROM basic WHERE class='{$class}'";
//    $items = mysqli_query($conn, $sql);
//
//    $sql = "SELECT DISTINCT design FROM basic WHERE class='{$class}'";
//    $designs = mysqli_query($conn, $sql);
//
//    global $count;
//    $count = 0;
//    $new_page = "<table id='stock_table' class='responsive-table' style='min-font-size: 9pt'><caption style='text-align: center'>{$class}</caption>";
//    while ($dsgn_row = mysqli_fetch_array($designs)) {
//        while ($item_row = mysqli_fetch_array($items)) {
//            $sql = "SELECT qty FROM basic WHERE class='{$class}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
//            $res = mysqli_query($conn, $sql);
//            if ($res) {
//                $basic[$item_row['item']] = mysqli_fetch_array($res)[0];
//            } else {
//                $basic[$item_row['item']] = 0;
//            }
//
//            $sql = "SELECT sum(qty) FROM material WHERE class='{$class}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
//            $res = mysqli_query($conn, $sql);
//            if ($res) {
//                $mat[$item_row['item']] = mysqli_fetch_array($res)[0];
//            } else {
//                $mat[$item_row['item']] = 0;
//            }
//
//
//            $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
//            $res = mysqli_query($conn, $sql);
//            if ($res) {
//                $sub[$item_row['item']] = mysqli_fetch_array($res)[0];
//            } else {
//                $sub[$item_row['item']] = 0;
//            }
//        }
//
//        $new_page = $new_page .
//            "<thead>
//                        <tr>
//                            <th>{$dsgn_row['design']}</th>
//                            <th>期初</th>
//                            <th>{$class}入库</th>
//                            <th>{$sub_name}出库</th>
//                            <th>现在库存</th>
//                        </tr>
//                        </thead>
//                        <tbody style='border: 3px black solid'>";
//
//        foreach ($basic as $item => $qty) {
//            $new_page = $new_page .
//                "<tr style=\"border-bottom: 1px dotted silver\">
//                <td>" . $item . "</td>
//                <td>" . $qty . "</td>
//                <td>" . $mat[$item] . "</td>
//                <td>" . $sub[$item] . "</td>
//                <td>" . (intval($qty) + intval($mat[$item]) - intval($sub[$item])) . "</td>
//            </tr>";
//            $count++;
//        }
//        $new_page = $new_page . "</tbody>";
//    }
//    $new_page = $new_page . "</table>";
//    echo "<script type='text/html' id='temp_page'>$new_page</script>";
//}
//
//function getBasic() {
//    $item       = ($_POST['item']);
//    $design     = ($_POST['design']);
//    $class      = ($_POST['class']);
//    $worker     = ($_POST['worker']);
//
//    if (empty($item) and
//        empty($design) and
//        empty($class) and
//        empty($worker)) {
//
//        $sql = "SELECT * FROM basic ORDER BY no DESC";
//        $table_title = "전체검색";
//
//    } else {
//        $sql = "SELECT * FROM basic WHERE ";
//        $table_title = "검색조건 = ";
//        if (!empty($item)) {
//            $sql = $sql."item='{$item}' AND ";
//            $table_title = $table_title."item = {$item},";
//        }
//        if (!empty($design)) {
//            $sql = $sql."design='{$design}' AND ";
//            $table_title = $table_title."design = '{$design}',";
//        }
//        if (!empty($class)) {
//            $sql = $sql."class='{$class}' AND ";
//            $table_title = $table_title."class = {$class},";
//        }
//        if (!empty($worker)) {
//            $sql = $sql."worker='{$worker}' AND ";
//            $table_title = $table_title."worker = {$worker},";
//        }
//        $sql = substr($sql, 0, -4);
//        $sql = $sql."ORDER BY no DESC";
//        $table_title = substr($table_title, 0, -1);
//    }
//
//    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
//    $res = mysqli_query($conn, $sql);
//
//    global $count;
//    $count = 0;
//    $new_page = "<table id='basic_table' class='responsive-table' style='min-font-size: 9pt'>
//                        <thead>
//                        <tr>
//                            <th style='display: none'>No</th>
//                            <th>Item</th>
//                            <th>Design</th>
//                            <th>Qty</th>
//                            <th>Class</th>
//                            <th style='display: none'>Worker</th>
//                            <th>Edit</th>
//                            <th>Del</th>
//                        </tr>
//                        </thead>
//                        <tbody>";
//
//
//    while ($row = mysqli_fetch_array($res)) {
//        $new_page = $new_page.
//            "<tr style=\"border-bottom: 1px dotted silver\">
//                <td style=\"display: none\">".$row['no']."</td>
//                <td>".$row['item']."</td>
//                <td>".$row['design'] . "</td>
//                <td>".$row['qty'] . "</td>
//                <td>".$row['class'] . "</td>
//                <td style='display: none'>".$row['worker'] . "</td>
//                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
//                <td><button id=\"$count\" name=\"del\" class=\"btn-danger\" onclick=\"submit_data(this); return false;\">D</button></td>
//            </tr>";
//        $count++;
//    }
//    $new_page = $new_page."</tbody></table>";
//
//    echo "<script type='text/html' id='temp_page'>$new_page</script>";
//    echo "<script>changeTable()</script>";
//}
//
//function updateDatalist($name) {
//    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
//    $sql = "SELECT * FROM name_info WHERE kind='{$name}'";
//    $res = mysqli_query( $conn, $sql );
//    while( $row = mysqli_fetch_array( $res ) ) {
//        $var = htmlentities($row['name']);
//        echo "<option value='$var'>";
//    }
//}
//
//function saveBasic() {
//    $item       = ($_POST['item']);
//    $design     = ($_POST['design']);
//    $qty        = ($_POST['qty']);
//    $class      = ($_POST['class']);
//    $worker     = ($_POST['worker']);
//
//    if (empty($item)) {
//        alert("item 값을 입력하세요.");
//        return;
//    }
//    if (empty($design)) {
//        alert("design 값을 입력하세요.");
//        return;
//    }
//    if (empty($qty)) {
//        alert("quantity 값을 입력하세요.");
//        return;
//    }
//    if (empty($class)) {
//        alert("class 값을 입력하세요.");
//        return;
//    }
//
//    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
//    $sql = "INSERT INTO basic (item, design, qty, class, worker)
//                VALUES ('{$item}', '{$design}', {$qty}, '{$class}', '{$worker}')";
//
//    if (mysqli_query($conn, $sql)) {
//        $sql = "SELECT LAST_INSERT_ID()";
//        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
//        global $count;
//        $new_row = "<tr style=\"border-bottom: 1px dotted silver\">
//                <td style=\"display: none\">".$no."</td>
//                <td>".$item."</td>
//                <td>".$design . "</td>
//                <td>".$qty . "</td>
//                <td>".$class . "</td>
//                <td style='display: none'>".$worker . "</td>
//                <td nowrap><button id=\"$count\" class=\"btn-success\" onclick=\"displayRow(this); return false;\">E</button></td>
//                <td><button id=\"$count\" class=\"btn-danger\" onclick=\"deleteRow(this); return false;\">D</button></td>
//            </tr>";
//        $count++;
//    }
//
//    if (mysqli_query($conn, $sql)) {
//        echo "<script type='text/html' id='temp_row'>".$new_row."</script>";
//    }
//}
//

//?>
