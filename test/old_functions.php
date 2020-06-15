<?php
function getMaterial() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_table;
    global $fmt_row;
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
    $cells = sprintf($fmt_mat,'th','No', '日期', '客户', '品名', '花面', '数量', '月份', '分类', '贴花人', '修改', '删除');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = sprintf($fmt_mat, 'td', $row['no'], $row['date'], $row['supplier'], $row['item'],
            $row['design'], $row['qty'], $row['month'], $row['class'], $row['worker'], $btn_e, $btn_d);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
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

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
                VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    global $fmt_mat;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $tr = sprintf($fmt_mat, 'td', $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $btn_e, $btn_d);

        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function updateMaterial() {
    global $conn;
    $no         = ($_POST['no']);
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "UPDATE material 
            SET date        = '{$date}', 
                supplier    = '{$supplier}', 
                item        = '{$item}', 
                design      = '{$design}', 
                qty         = {$qty}, 
                month       = '{$month}', 
                class       = '{$class}', 
                worker      = '{$worker}' 
            WHERE no        = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function deleteMaterial() {
    global $conn;
    $no         = ($_POST['no']);
    $sql = "DELETE FROM material WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function getStock() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_table;
    global $fmt_row;
    global $fmt_basic;

    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $class      = ($_POST['class']);

    if (empty($item) and
        empty($design) and
        empty($class)) {

        $sql = "SELECT * FROM stock ORDER BY no DESC";
        $condition = "전체검색";

    } else {
        $sql = "SELECT * FROM stock WHERE ";
        $condition = "검색조건 = ";
        if (!empty($item)) {
            $sql = $sql."item='{$item}' AND ";
            $condition = $condition."item = {$item},";
        }
        if (!empty($design)) {
            $sql = $sql."design='{$design}' AND ";
            $condition = $condition."design = '{$design}',";
        }
        if (!empty($class)) {
            $sql = $sql."class='{$class}' AND ";
            $condition = $condition."class = {$class},";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql."ORDER BY no DESC";
        $condition = substr($condition, 0, -1);
    }

    $res = mysqli_query($conn, $sql);
    $cells = sprintf($fmt_basic,'th','No', '品名', '花面', '数量', '分类', '修改', '删除');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = sprintf($fmt_basic, 'td', $row['no'], $row['item'],
            $row['design'], $row['qty'], $row['class'], $btn_e, $btn_d);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function saveStock() {
    global $conn;
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $class      = ($_POST['class']);

    $sql = "INSERT INTO stock (item, design, qty, class)
            VALUES ('{$item}', '{$design}', {$qty}, '{$class}')";

    global $fmt_basic;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $tr = sprintf($fmt_basic, 'td', $no, $item, $design, $qty, $class, $btn_e, $btn_d);

        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function updateStock() {
    global $conn;
    $no         = ($_POST['no']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $class      = ($_POST['class']);

    $sql = "UPDATE stock 
            SET item        = '{$item}', 
                design      = '{$design}', 
                qty         = {$qty}, 
                class       = '{$class}' 
            WHERE no        = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function deleteStock() {
    global $conn;
    $no = ($_POST['no']);
    $sql = "DELETE FROM stock WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function makeTotalStock() {
    $class = '白瓷';
    $sub_name = "贴花";
    $t1 = calc($class, $sub_name);

    $class = '花纸';
    $sub_name = "贴花";
    $t2 = calcStockA($class, $sub_name, 'red');

    $class = '完成品';
    $sub_name = "出库";
    $t3 = calcStockA($class, $sub_name, 'yellow');

    global $fmt_table;
    $new_table = sprintf($fmt_table, '전체재고', $t1 . $t2 . $t3);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function calcBaici($class, $sub_name) : string
{
    global $conn;
    global $fmt_stock;
    global $fmt_row;

    $basic = array();
    $mat = array();
    $sub = array();

    $sql = "SELECT item FROM stock WHERE class='{$class}'";
    $items = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($items)) {
        $sql = "SELECT qty FROM stock WHERE class='{$class}' AND item='{$row['item']}'";
        $basic[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $sql = "SELECT sum(qty) FROM material WHERE class='{$class}' AND item='{$row['item']}'";
        $mat[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$row['item']}'";
        $sub[$row['item']] = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
    }

    $cells = sprintf($fmt_stock,'th', $class, '期初', '白瓷入库', '贴花出库', '宣账白瓷');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    foreach ($basic as $item => $qty) {
        $sum = (intval($qty) + intval($mat[$item]) - intval($sub[$item]));
        $cells = sprintf($fmt_stock, 'td', $item, $qty, $mat[$item], $sub[$item], $sum);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    return $thead . $tbody;
}

function calcStock($class, $sub_name, $color): string
{
    global $conn;
    global $fmt_row;
    global $fmt_stock;

    $basic = array();
    $mat = array();
    $sub = array();

    $sql = "SELECT DISTINCT item FROM stock WHERE class='{$class}'";
    $items = mysqli_query($conn, $sql);

    $sql = "SELECT DISTINCT design FROM stock WHERE class='{$class}'";
    $designs = mysqli_query($conn, $sql);

    $tables = "";
    while ($dsgn_row = mysqli_fetch_array($designs)) {
        while ($item_row = mysqli_fetch_array($items)) {
            $sql = "SELECT qty FROM stock WHERE class='{$class}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $basic[$item_row['item']] = mysqli_fetch_array($res)[0];
            } else {
                $basic[$item_row['item']] = 0;
            }

            $sql = "SELECT sum(qty) FROM material WHERE class='{$class}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $mat[$item_row['item']] = mysqli_fetch_array($res)[0];
            } else {
                $mat[$item_row['item']] = 0;
            }


            $sql = "SELECT sum(qty) FROM material WHERE class='{$sub_name}' AND item='{$item_row['item']}' AND design='{$dsgn_row['design']}'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $sub[$item_row['item']] = mysqli_fetch_array($res)[0];
            } else {
                $sub[$item_row['item']] = 0;
            }
        }

        $cells = sprintf($fmt_stock,'th', $dsgn_row['design'], '期初', $class.'入库', $sub_name.'出库', '现在库存');
        $thead = sprintf($fmt_row, 'thead', 'none', $cells);

        $tr = "";
        foreach ($basic as $item => $qty) {
            $sum = (intval($qty) + intval($mat[$item]) - intval($sub[$item]));
            $cells = sprintf($fmt_stock, 'td', $item, $qty, $mat[$item], $sub[$item], $sum);
            $tr = $tr . $cells;
        }
        $tbody = sprintf($fmt_row, 'tbody', $color, $tr);
        $tables = $tables . $thead . $tbody;
    }

    return $tables;
}

function getShipping() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_table;
    global $fmt_row;
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
    $cells = sprintf($fmt_mat,'th','No', '日期', '客户', '品名', '花面', '数量', '月份', '分类', '贴花人', '修改', '删除');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = sprintf($fmt_mat, 'td', $row['no'], $row['date'], $row['supplier'], $row['item'],
            $row['design'], $row['qty'], $row['month'], $row['class'], $row['worker'], $btn_e, $btn_d);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function saveShipping() {
    global $conn;
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
                VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    global $fmt_mat;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $tr = sprintf($fmt_mat, 'td', $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $btn_e, $btn_d);

        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function updateShipping() {
    global $conn;
    $no         = ($_POST['no']);
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "UPDATE material 
            SET date        = '{$date}', 
                supplier    = '{$supplier}', 
                item        = '{$item}', 
                design      = '{$design}', 
                qty         = {$qty}, 
                month       = '{$month}', 
                class       = '{$class}', 
                worker      = '{$worker}' 
            WHERE no        = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function deleteShipping() {
    global $conn;
    $no         = ($_POST['no']);
    $sql = "DELETE FROM material WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function getOrdering() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_table;
    global $fmt_row;
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
    $cells = sprintf($fmt_mat,'th','No', '日期', '客户', '品名', '花面', '数量', '月份', '分类', '贴花人', '修改', '删除');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = sprintf($fmt_mat, 'td', $row['no'], $row['date'], $row['supplier'], $row['item'],
            $row['design'], $row['qty'], $row['month'], $row['class'], $row['worker'], $btn_e, $btn_d);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function saveOrdering() {
    global $conn;
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
                VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    global $fmt_mat;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $tr = sprintf($fmt_mat, 'td', $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $btn_e, $btn_d);

        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function updateOrdering() {
    global $conn;
    $no         = ($_POST['no']);
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "UPDATE material 
            SET date        = '{$date}', 
                supplier    = '{$supplier}', 
                item        = '{$item}', 
                design      = '{$design}', 
                qty         = {$qty}, 
                month       = '{$month}', 
                class       = '{$class}', 
                worker      = '{$worker}' 
            WHERE no        = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function deleteOrdering() {
    global $conn;
    $no         = ($_POST['no']);
    $sql = "DELETE FROM material WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function getProduct() {
    global $conn;
    global $btn_e;
    global $btn_d;
    global $fmt_table;
    global $fmt_row;
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
    $cells = sprintf($fmt_mat,'th','No', '日期', '客户', '品名', '花面', '数量', '月份', '分类', '贴花人', '修改', '删除');
    $thead = sprintf($fmt_row, 'thead', 'none', $cells);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = sprintf($fmt_mat, 'td', $row['no'], $row['date'], $row['supplier'], $row['item'],
            $row['design'], $row['qty'], $row['month'], $row['class'], $row['worker'], $btn_e, $btn_d);
        $tr = $tr . $cells;
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function saveProduct() {
    global $conn;
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
                VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    global $fmt_mat;
    global $btn_e;
    global $btn_d;
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $tr = sprintf($fmt_mat, 'td', $no, $date, $supplier, $item, $design, $qty, $month, $class, $worker, $btn_e, $btn_d);

        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function updateProduct() {
    global $conn;
    $no         = ($_POST['no']);
    $date       = ($_POST['date']);
    $supplier   = ($_POST['supplier']);
    $item       = ($_POST['item']);
    $design     = ($_POST['design']);
    $qty        = ($_POST['qty']);
    $month      = ($_POST['month']);
    $class      = ($_POST['class']);
    $worker     = ($_POST['worker']);

    $sql = "UPDATE material 
            SET date        = '{$date}', 
                supplier    = '{$supplier}', 
                item        = '{$item}', 
                design      = '{$design}', 
                qty         = {$qty}, 
                month       = '{$month}', 
                class       = '{$class}', 
                worker      = '{$worker}' 
            WHERE no        = {$no}";

    if (mysqli_query($conn, $sql)) {}
}

function deleteProduct() {
    global $conn;
    $no         = ($_POST['no']);
    $sql = "DELETE FROM material WHERE no = {$no}";

    if (mysqli_query($conn, $sql)) {}
}
?>

<script>
    function isEmpty(str) {
        return (!str || 0 === str.length);
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
        $("#obc_table").children("tbody").children("tr").prepend(content_str)
    }
</script>




<!--<script>-->
<!--    function submit_order(ctl) {-->
<!--        var s = showing['custom'];-->
<!--        var ibox = document.getElementsByClassName('input_box')-->
<!--        var data = {};-->
<!--        for (var key in s) {-->
<!--            if ($(ibox.namedItem(key)).length > 0) {-->
<!--                data[key] = $(ibox.namedItem(key)).val();-->
<!--            } else {-->
<!--                data[key] = "";-->
<!--            }-->
<!--        }-->
<!--        data['showing'] = s;-->
<!--        data['msg'] = 'custom';-->
<!---->
<!--        $.ajax({-->
<!--            type: 'post',-->
<!--            url: 'ordering.php',-->
<!--            data: data,-->
<!---->
<!--            success: function (response) {-->
<!--                if (ctl.name === 'search') {-->
<!--                    changeTable(response);-->
<!--                }-->
<!--            }-->
<!--        });-->
<!--        return false;-->
<!--    }-->
<!---->
<!--    $('#order_form').on('hidden.bs.modal', function () {-->
<!--        var orderno     = $('#div_orderno');-->
<!--        var design      = $('#div_design');-->
<!--        $('#order_main').append(orderno);-->
<!--        $('#order_main').append(design);-->
<!--    });-->
<!---->
<!--    $('#order_modal').click(function () {-->
<!--        var orderno     = $('#div_orderno');-->
<!--        var design      = $('#div_design');-->
<!--        $('#div_item').after(design);-->
<!--        $('#div_qty').after(orderno);-->
<!--    });-->
<!--</script>-->











