<?php
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
    global $fmt_btn;

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
                $cell = sprintf($fmt_td[$val], 'td', $key, $fmt_btn[$key]);
            }

//            else if ($tname == 'custom' && $key == 'qty') {
//
//                $cond = makeCondition(array(
//                    'item' => $row['item'],
//                    'design' => $row['design'],
//                    'class' => '白瓷'
//                ));
//                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);
//
//                $output = mysqli_query($conn, $sql);
//                $rate = mysqli_fetch_array($output);
//
//                if ($rate) {
//                    $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", intval($row[$key]) * intval($rate['rate']));
//                } else {
//                    $cell = sprintf($fmt_td['alert'], 'td', $key, intval($row[$key]));
//                }
//            }

            else if (($tname == 'material') && ($key == 'total' || $key == 'price')) {
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
                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $result);
                    } else {
                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
                    }
                }
                if ($key == 'price') {
                    if ($price) {
                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $price[0]);
                    } else {
                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
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

    // 테이블 헤더 부분
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

function save() {
    global $conn;
    global $sql_insert;
    global $sql_search_one;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_btn;

    $tname = $_POST['page'];
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

    $sql = sprintf($sql_insert, $tname, $dest, $src);
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $idx = $showing['no'];
        $cells = sprintf($fmt_td[$idx], 'no', $no);

        foreach ($showing as $key => $val) {
            if ($key == 'edit' || $key == 'del' || $key == 'order') {
                $cell = sprintf($fmt_td[$val], 'td', $key, $fmt_btn[$key]);
            } else if ($tname == 'custom' && $key == 'qty') {

                $cond = makeCondition(array(
                    'item' => $_POST['item'],
                    'design' => $_POST['design'],
                    'class' => '白瓷'
                ));
                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

                $output = mysqli_query($conn, $sql);
                $rate = mysqli_fetch_array($output);

                if ($rate) {
                    $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", intval($_POST[$key]) * intval($rate['rate']));
                } else {
                    $cell = sprintf($fmt_td['alert'], 'td', $key, intval($_POST[$key]));
                }
            } else {
                $cell = sprintf($fmt_td[$val], 'td', $key, $_POST[$key]);
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