<?php
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('请重新登录'); window.location = './login.php'; </script>";
}

$conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
$fmt_table = '<table id=\'obc_table\' class=\'responsive-table\' style=\'min-font-size: 9pt\'>
              <caption style=\'text-align: center\'>%s</caption>%s</table>';
$fmt_row = '<%1$s style=\'border: 3px solid %2$s\'>%3$s</%1$s>';
$fmt_tr = '<tr style=\'border-bottom: 1px dotted silver\'>%s</tr>';

$fmt_td = array(
    'show'  => '<%1$s name=\'%2$s\'>%3$s</%1$s>',
    'none'  => '<%1$s name=\'%2$s\' style=\'display: none\'>%3$s</%1$s>',
    'red'   => '<%1$s name=\'%2$s\' style=\'background-color: red; color: black\'>%3$s</%1$s>'
);

$btn = array(
    'edit'  => '<button name=\'edit\' class=\'btn-success\' onclick=\'displayRow(this); return false;\'>E</button></td>',
    'del'   => '<button name=\'del\' class=\'btn-danger\' onclick=\'submit_basic(this); return false;\'>D</button></td>',
    'order' => '<button name=\'order\' class=\'btn-dark\' onclick=\'submit_order(this); return false;\' data-toggle="modal" data-target="#order_form">O</button></td>'
);

$translate = array(
    'no'        => 'no',
    'date'      => '日期',
    'supplier'  => '企业',
    'customer'  => '客户',
    'item'      => '品名',
    'design'    => '花面',
    'qty'       => '数量',
    'month'     => '月份',
    'class'     => '分类',
    'worker'    => '贴花人',
    'rate'      => '包装率',
    'price'     => '单价',
    'edit'      => '修改',
    'del'       => '删除',
    'orderno'   => '订单号码',
    'total'     => '合计',
    'factory'   => '工厂',
    'order'     => '订货',
    'baici'     => '白瓷',
    'huazhi'    => '花纸',
    'chengpin'  => '完成品',
    'baozhuang' => '包装期',
    'caici'     => '彩瓷'
);

$relation = array(
    'baici'     => '贴花',
    'huazhi'    => '贴花',
    'chengpin'  => '出库',
    'baozhuang' => '彩盒',
    'caici'     => ['贴花', '包装']
);

$sql_search_all     = 'SELECT * FROM %s ORDER BY no DESC';
$sql_search_con     = 'SELECT * FROM %s WHERE %s ORDER BY no DESC';
$sql_search_one     = 'SELECT %s FROM %s WHERE %s';
$sql_insert         = 'INSERT INTO %s (%s) VALUES (%s)';
$sql_update         = 'UPDATE %s SET %s WHERE %s';
$sql_delete         = 'DELETE FROM %s WHERE no = %s';
$sql_distinct       = 'SELECT DISTINCT %s FROM %s';

if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'search' || $_POST['msg'] == 'payment') {
        search();
    }
    if ($_POST['msg'] == 'save' || $_POST['msg'] == 'ordering') {
        save();
    }
    if ($_POST['msg'] == 'order') {
        order();
    }
    if ($_POST['msg'] == 'update') {
        update();
    }
    if ($_POST['msg'] == 'del') {
        del();
    }
    if ($_POST['msg'] == 'logout') {
        session_destroy();
    }
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function makeCondition($arr) : string {
    $condition = "";
    foreach ($arr as $key => $val) {
        if ($key != 'msg' &&
            $key != 'page' &&
            $key != 'showing' &&
            $key != 'edit' &&
            $key != 'del') {
            if (!empty($arr[$key])) {
                $condition = $condition . "$key = '$val' AND ";
            }
        }
    }
    if (empty($condition)) {
        return '整体搜索';
    } else {
        return substr($condition, 0, -4);
    }
}

function getAmount($select, $table, $condition) : string {
    global $conn;
    global $sql_search_one;
    $sql = sprintf($sql_search_one, $select, $table, $condition);
    $res = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

    if ($res != null) {
        return $res;
    } else {
        return 0;
    }
}

function calcByItem($clsA, $clsB, $item) : string {
    $cond = makeCondition(array('class'=>$clsA, 'item'=>$item));
    $stk = getAmount('qty', 'stock', $cond);
    $mat = getAmount('sum(qty)', 'material', $cond);

    $cond = makeCondition(array('class'=>$clsB, 'item'=>$item));
    $sub = getAmount('sum(qty)', 'material', $cond);

    return (intval($stk) + intval($mat) - intval($sub));
}

function calcByItemDesign($clsA, $clsB, $item, $design) : string {
    $cond = makeCondition(array('class'=>$clsA, 'item'=>$item, 'design'=>$design));
    $stk = getAmount('qty', 'stock', $cond);
    $mat = getAmount('sum(qty)', 'material', $cond);

    $cond = makeCondition(array('class'=>$clsB, 'item'=>$item, 'design'=>$design));
    $sub = getAmount('sum(qty)', 'material', $cond);

    return (intval($stk) + intval($mat) - intval($sub));
}

//function getStock($item, $design) : array {
//    return array(
//        'baici'     => calcByItem('白瓷', '贴花', $item),
//        'huazhi'    => calcByItemDesign('花纸', '贴花', $item, $design),
//        'chengpin'  => calcByItemDesign('完成品', '出库', $item, $design)
//    );
//}

//function makeTotalStock() {
//    global $conn;
//    global $sql_search_one;
//    global $translate;
//
//    $sql = sprintf($sql_search_one, 'item', 'stock', $translate['baici']);
//    $items = mysqli_query($conn, $sql);
//
//    while ($row = mysqli_fetch_array($items)) {
//        $class = '花纸';
//        $sub_name = "贴花";
//        $t2 = calcStock($class, $sub_name, 'red');
//
//        $class = '完成品';
//        $sub_name = "出库";
//        $t3 = calcStock($class, $sub_name, 'yellow');
//
//        global $fmt_table;
//        $new_table = sprintf($fmt_table, '전체재고', $t1 . $t2 . $t3);
//        echo "<script type='text/html' id='temp_page'>$new_table</script>";
//    }
//}

function order() {
    global $conn;
    global $sql_search_one;
    global $sql_distinct;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $relation;
    global $btn;

    $color = random_color();

    $tname = $_POST['page'];
    $showing = $_POST['showing'];

    $sql = sprintf($sql_distinct, 'item', $tname);
    $res = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($res);

    $sql = sprintf($sql_distinct, 'design', $tname);
    $res = mysqli_query($conn, $sql);
    $designs = mysqli_fetch_all($res);

    $tr = "";

    foreach ($items as $i => $item) {
        foreach ($designs as $j => $design) {
            $cells = "";

            $key = 'item';
            $val = $showing[$key];
            $cell = sprintf($fmt_td[$val], 'td', $key, $item[0]);
            $cells = $cells . $cell;

            $key = 'design';
            $val = $showing[$key];
            $cell = sprintf($fmt_td[$val], 'td', $key, $design[0]);
            $cells = $cells . $cell;

            $key = 'qty';
            $val = $showing[$key];
            $sql = sprintf($sql_search_one, 'sum(qty)', $tname,
                makeCondition(array('item'=>$item[0], 'design'=>$design[0])));

            $sum = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
            if ($sum == null) {
                $sum = 0;
            }

            $cond = makeCondition(array(
                'item' => $item,
                'design' => $design,
                'class' => '白瓷'
            ));
            $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

            $output = mysqli_query($conn, $sql);
            $rate = mysqli_fetch_array($output)[0];

            if ($rate) {
                $cell = sprintf($fmt_td[$val], 'td', $key, intval($sum) * intval($rate));
            } else {
                $cell = sprintf($fmt_td['red'], 'td', $key, $sum);
            }
            $cells = $cells . $cell;


            $key = 'baici';
            $val = $showing[$key];
            $qty = calcByItem($translate[$key], $relation[$key], $item[0]);

            if ($qty > 0) {
                $cell = sprintf($fmt_td[$val], 'td', $key, $qty);
            } else {
                $cell = sprintf($fmt_td['red'], 'td', $key, $qty);
            }
            $cells = $cells . $cell;

            $key = 'huazhi';
            $val = $showing[$key];
            $qty = calcByItemDesign($translate[$key], $relation[$key], $item[0], $design[0]);

            if ($qty > 0) {
                $cell = sprintf($fmt_td[$val], 'td', $key, $qty);
            } else {
                $cell = sprintf($fmt_td['red'], 'td', $key, $qty);
            }
            $cells = $cells . $cell;

            $key = 'chengpin';
            $val = $showing[$key];
            $qty = calcByItemDesign($translate[$key], $relation[$key], $item[0], $design[0]);

            if ($qty > 0) {
                $cell = sprintf($fmt_td[$val], 'td', $key, $qty);
            } else {
                $cell = sprintf($fmt_td['red'], 'td', $key, $qty);
            }
            $cells = $cells . $cell;

            $key = 'order';
            $val = $showing[$key];
            $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            $cells = $cells . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells);
        }
    }
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    $cells = "";
    foreach ($showing as $key => $val) {
        $cell = sprintf($fmt_td[$val], 'th', $key, $translate[$key]);
        $cells = $cells . $cell;
    }
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

    $new_table = sprintf($fmt_table, '', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function search() {
    global $conn;
    global $sql_search_all;
    global $sql_search_con;
    global $sql_search_one;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $btn;

    $color = random_color();

    $tname = $_POST['page'];
    $showing = $_POST['showing'];

    $condition = makeCondition($_POST);

    if ($condition == '整体搜索') {
        $sql = sprintf($sql_search_all, $tname);
    } else {
        $sql = sprintf($sql_search_con, $tname, $condition);
    }
    $res = mysqli_query($conn, $sql);

    $sum = 0.;

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = "";
        foreach ($showing as $key => $val) {
            if ($key == 'edit' || $key == 'del' || $key == 'order') {
                $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            }

            #region custom 페이지 carton 계산 (수량정보 없으면 붉은 표시)
            else if ($tname == 'custom' && $key == 'qty') {

                $cond = makeCondition(array(
                    'item' => $row['item'],
                    'design' => $row['design'],
                    'class' => '白瓷'
                ));
                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

                $output = mysqli_query($conn, $sql);
                $rate = mysqli_fetch_array($output);

                if ($rate) {
                    $cell = sprintf($fmt_td[$val], 'td', $key, intval($row[$key]) * intval($rate['rate']));
                } else {
                    $cell = sprintf($fmt_td['red'], 'td', $key, intval($row[$key]));
                }
            }

            else if ($key == 'total' || $key == 'price') {
                $cond = makeCondition(array(
                    'supplier'  => $row['supplier'],
                    'item'      => $row['item'],
                    'design'    => $row['design'],
                    'class'     => $row['class']
                ));
                $sql = sprintf($sql_search_one, 'price', 'price', $cond);
                $output = mysqli_query($conn, $sql);
                $price = mysqli_fetch_array($output);

                if ($key == 'total') {
                    if ($price) {
                        $result = floatval($row['qty']) * floatval($price[0]);
                        $sum += $result;
                        $cell = sprintf($fmt_td[$val], 'td', $key, $result);
                    } else {
                        $cell = sprintf($fmt_td['red'], 'td', $key, '-');
                    }
                }
                if ($key == 'price') {
                    if ($price) {
                        $cell = sprintf($fmt_td[$val], 'td', $key, $price[0]);
                    } else {
                        $cell = sprintf($fmt_td['red'], 'td', $key, '-');
                    }
                }
            }

            else {
                $cell = sprintf($fmt_td[$val], 'td', $key, $row[$key]);
            }
            $cells = $cells . $cell;
        }
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    $cells = "";
    foreach ($showing as $key => $val) {
        $cell = sprintf($fmt_td[$val], 'th', $key, $translate[$key]);
        $cells = $cells . $cell;
    }
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

    if ($_POST['msg'] == 'payment') {
        $condition = "整体合计 = $sum";
    }

    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function getList($post_data) : array {
    $save_list = array();
    foreach ($post_data as $key => $val) {
        if ($key != 'msg' &&
            $key != 'page' &&
            $key != 'showing') {
            $save_list[$key] = $val;
        }
    }
    return $save_list;
}

function save() {
    global $conn;
    global $sql_insert;

    global $fmt_td;
    global $fmt_tr;
    global $btn;

    $showing = $_POST['showing'];
    $save_list = getList($_POST);

    $src = '';
    $dest = '';
    foreach ($save_list as $key => $val) {
        if ($key != 'no') {
            $src = $src . "'$val'". ', ';
            $dest = $dest . $key. ', ';
        }
    }
    $src = substr($src, 0, -2);
    $dest = substr($dest, 0, -2);

    $sql = sprintf($sql_insert, $_POST['page'], $dest, $src);

    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $idx = $showing['no'];
        $cells = sprintf($fmt_td[$idx], 'no', $no);

        foreach ($showing as $key => $val) {
            if ($key == 'edit' || $key == 'del' || $key == 'order') {
                $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            } else {
                $cell = sprintf($fmt_td[$val], 'td', $key, $val);
            }
            $cells = $cells . $cell;
        }

        $tr = sprintf($fmt_tr, $cells);
        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function update() {
    global $conn;
    global $sql_update;

    $update_list = getList($_POST);
    $set = "";
    $where = "no = ";
    foreach ($update_list as $key => $val) {
        if ($key == 'no') {
            $where = $where . "$val";
        } else {
            $set = $set . $key . "='$val',";
        }
    }
    $set = substr($set, 0, -1);
    $sql = sprintf($sql_update, $_POST['page'], $set, $where);

    echo mysqli_query($conn, $sql);
}

function del() {
    global $conn;
    global $sql_delete;
    $sql = sprintf($sql_delete, $_POST['page'], $_POST['no']);
    echo mysqli_query($conn, $sql);
}

function updateDatalist($name) {
    global $conn;
    $sql = "SELECT DISTINCT {$name} FROM material";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row[$name]);
        echo "<option value='$var'>";
    }
}
?>