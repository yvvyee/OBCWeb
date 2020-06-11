<?php
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('请重新登录'); window.location = './login.php'; </script>";
}

$conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
$btn_o = '<button name=\'order\' class=\'btn-dark\' onclick=\'return false;\' id="order_modal" data-toggle="modal" data-target="#order_form">O</button></td>';
$btn_e = '<button name=\'edit\' class=\'btn-success\' onclick=\'displayRow(this); return false;\'>E</button></td>';
$btn_d = '<button name=\'del\' class=\'btn-danger\' onclick=\'submit_data(this); return false;\'>D</button></td>';
$fmt_table = '<table id=\'obc_table\' class=\'responsive-table\' style=\'min-font-size: 9pt\'>
              <caption style=\'text-align: center\'>%s</caption>%s</table>';
$fmt_row = '<%1$s style=\'border: 3px solid %2$s\'>%3$s</%1$s>';
$fmt_tr = '<tr style=\'border-bottom: 1px dotted silver\'>%s</tr>';

$fmt_td = array(
    true => '<%1$s name=\'%2$s\'>%3$s</%1$s>',
    false => '<%1$s name=\'%2$s\' style=\'display: none\'>%3$s</%1$s>'
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
    'factory'   => '工厂'
);

$sql_search_all = 'SELECT * FROM %s ORDER BY no DESC';
$sql_search_con = 'SELECT * FROM %s WHERE %s ORDER BY no DESC';
$sql_insert = 'INSERT INTO %s (%s) VALUES (%s)';
$sql_update = 'UPDATE %s SET %s WHERE %s';
$sql_delete = 'DELETE FROM %s WHERE no = %s';

if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'search') {
        search();
    }
    if ($_POST['msg'] == 'save') {
        save();
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

function getCondition($post_data) : string {
    $condition = "";
    foreach ($post_data as $key => $val) {
        if ($key != 'msg' &&
            $key != 'page' &&
            $key != 'showing' &&
            $key != 'edit' &&
            $key != 'del') {
            if (!empty($post_data[$key])) {
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

function search() {
    global $conn;
    global $sql_search_all;
    global $sql_search_con;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $btn_e;
    global $btn_d;

    $color = random_color();

    $showing = $_POST['showing'];

    $condition = getCondition($_POST);

    if ($condition == '整体搜索') {
        $sql = sprintf($sql_search_all, $_POST['page']);
    } else {
        $sql = sprintf($sql_search_con, $_POST['page'], $condition);
    }
    $res = mysqli_query($conn, $sql);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = "";
        foreach ($showing as $key => $val) {
            $idx = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            if ($key == 'edit') {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $btn_e);
            } else if ($key == 'del') {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $btn_d);
            } else {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $row[$key]);
            }
            $cells = $cells . $cell;
        }
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    $cells = "";
    foreach ($showing as $key => $val) {
        $idx = filter_var($val, FILTER_VALIDATE_BOOLEAN);
        $cell = sprintf($fmt_td[$idx], 'th', $key, $translate[$key]);
        $cells = $cells . $cell;
    }
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

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
    global $btn_e;
    global $btn_d;

    $showing = $_POST['showing'];
    $save_list = getList($_POST);

    $src = '';
    $dest = '';
    foreach ($save_list as $key => $val) {
        $src = $src . "$val". ', ';
        $dest = $dest . $key. ', ';
    }
    $src = substr($src, 0, -2);
    $dest = substr($dest, 0, -2);

    $sql = sprintf($sql_insert, $_POST['page'], $dest, $src);

    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $idx = filter_var($showing['no'], FILTER_VALIDATE_BOOLEAN);
        $cells = sprintf($fmt_td[$idx], 'no', $no);

        foreach ($save_list as $key => $val) {
            $idx = filter_var($showing[$key], FILTER_VALIDATE_BOOLEAN);
            if ($key == 'edit') {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $btn_e);
            } else if ($key == 'del') {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $btn_d);
            } else {
                $cell = sprintf($fmt_td[$idx], 'td', $key, $val);
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
            $set = $key . '=' . "$val,";
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