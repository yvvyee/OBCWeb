<?php
function makeCondition($arr) : string {
    $condition = "";
    foreach ($arr as $key => $val) {
        if ($key != 'edit' &&
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

function set_input_form() {
    global $fmt_input;
    global $input_list;
    global $input_type;
    global $translate;
    global $conn;

    $sql = "SELECT * FROM datalist ORDER BY seq";
    $res = mysqli_query( $conn, $sql );
    $datalist = mysqli_fetch_all($res);

    $page = $_POST['page'];

    $input_form = '';
    foreach ($input_list[$page] as $i => $name) {
        $id = $page . '_' . $name;

        if ($name == 'no') {
            $temp = sprintf($fmt_input, $id, $name, $input_type[$name], $translate[$name], 'display: none', '');
        } else {
            $options = '';
            if ($name == 'orderno') {
                $sql = "SELECT DISTINCT orderno FROM $page";
                $res = mysqli_query( $conn, $sql );
                $orderno = mysqli_fetch_all($res);
                foreach ($orderno as $str) {
                    $var = htmlentities($str[0]);
                    $options =  $options. "<option value='$var'>";
                }
            } else {
                foreach ($datalist as $row) {
                    if ($row[2] == $name) {
                        if ($row[4] == '') {
                            $var = htmlentities($row[1]);
                            $options =  $options. "<option value='$var'>";
                        } else {
                            if ($row[4] == $page) {
                                $var = htmlentities($row[1]);
                                $options =  $options. "<option value='$var'>";
                            }
                        }
                    }
                }
            }
            $temp = sprintf($fmt_input, $id, $name, $input_type[$name], $translate[$name], '', $options);
        }
        $input_form = $input_form . $temp;
    }

    echo "<script type='text/html' id='temp_page'>$input_form</script>";
}

function search() {
    global $conn;
    global $sql_search_all;
    global $sql_search_where;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $fmt_btn;

    $color = random_color();

    $tname = $_POST['page'];
    $show = $_POST['show'];
    $cols = $_POST['cols'];

    $condition = makeCondition($cols);

    if ($condition == '整体搜索') {
        $sql = sprintf($sql_search_all, $tname);
    } else {
        $sql = sprintf($sql_search_where, $tname, $condition);
    }
    $res = mysqli_query($conn, $sql);

    $sum = 0.;

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = "";
        foreach ($show as $key => $val) {
            // no 는 항상 숨김
            if ($key == 'no') {
                $cell = sprintf($fmt_td[false], 'td', $key, $row[$key]);
            }
            // 체크박스 상태에 맞게 테이블 내용 시각화
            else {
                $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
                $cell = sprintf($fmt_td[$bval], 'td', $key, $row[$key]);
            }
            $cells = $cells . $cell;
        }
        // 수정 & 삭제 버튼
        $cell = sprintf($fmt_td[true], 'td', $key, $fmt_btn['edit']);
        $cells = $cells . $cell;
        $cell = sprintf($fmt_td[true], 'td', $key, $fmt_btn['del']);
        $cells = $cells . $cell;
        // Row
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    // 테이블 바디
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    // 테이블 헤더 부분
    $cells = "";
    foreach ($show as $key => $val) {
        if ($key == 'no') {
            $cell = sprintf($fmt_td[false], 'th', $key, $translate[$key]);
        } else {
            $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            $cell = sprintf($fmt_td[$bval], 'th', $key, $translate[$key]);
        }
        $cells = $cells . $cell;
    }
    // 수정 & 삭제 버튼
    $cell = sprintf($fmt_td[true], 'th', $key, $translate['edit']);
    $cells = $cells . $cell;
    $cell = sprintf($fmt_td[true], 'th', $key, $translate['del']);
    $cells = $cells . $cell;
    // Row
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
    $show = $_POST['show'];
    $cols = $_POST['cols'];

    $vals = '';
    $into = '';
    foreach ($cols as $key => $val) {
        if ($key != 'no') {
            $vals = $vals . "'$val'". ', ';
            $into = $into . $key. ', ';
        }
    }
    $vals = substr($vals, 0, -2);
    $into = substr($into, 0, -2);

    $sql = sprintf($sql_insert, $tname, $into, $vals);
    $res = mysqli_query($conn, $sql);

    // custom - modal 에서 저장한 경우
    if ($tname == 'ordering' && $show == null) {
        echo $res;
    }
    // 이외에는 테이블을 갱신
    else {
        // 마지막으로 저장된 데이터 ID
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
//        $cells = sprintf($fmt_td[false], 'no', $no);
        $cells = '';
        foreach ($show as $key => $val) {
            if ($key == 'no') {
                $cell = sprintf($fmt_td[false], 'td', $key, $no);
            }
//            else if ($tname == 'custom' && $key == 'qty') {
//
//                $cond = makeCondition(array(
//                    'item' => $_POST['item'],
//                    'design' => $_POST['design'],
//                    'class' => '白瓷'
//                ));
//                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);
//
//                $output = mysqli_query($conn, $sql);
//                $rate = mysqli_fetch_array($output);
//
//                if ($rate) {
//                    $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", intval($_POST[$key]) * intval($rate['rate']));
//                } else {
//                    $cell = sprintf($fmt_td['alert'], 'td', $key, intval($_POST[$key]));
//                }
//            }
            else {
                $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
                $cell = sprintf($fmt_td[$bval], 'td', $key, $cols[$key]);
            }
            $cells = $cells . $cell;
        }
        // 수정 & 삭제 버튼
        $cell = sprintf($fmt_td[true], 'td', $key, $fmt_btn['edit']);
        $cells = $cells . $cell;
        $cell = sprintf($fmt_td[true], 'td', $key, $fmt_btn['del']);
        $cells = $cells . $cell;
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

    $table = $_POST['page'];
    $noCol = $_POST['no'];

    $sql = sprintf($sql_delete, $table, $noCol);

    echo mysqli_query($conn, $sql);
}

















//            if ($key == 'edit' || $key == 'del' || $key == 'order') {
//                $cell = sprintf($fmt_td[$val], 'td', $key, $fmt_btn[$key]);
//            }
//
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
//
//            else if (($tname == 'material') && ($key == 'total' || $key == 'price')) {
//                $cond = makeCondition(array(
//                    'supplier'  => $row['supplier'],
//                    'item'      => $row['item'],
//                    'design'    => $row['design'],
//                    'class'     => $row['class']
//                ));
//                $sql = sprintf($sql_search_one, 'price', 'price', $cond);
//                $output = mysqli_query($conn, $sql);
//                $price = mysqli_fetch_array($output);
//
//                if ($key == 'total') {
//                    if ($price) {
//                        $result = floatval($row['qty']) * floatval($price[0]);
//                        $sum += $result;
//                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $result);
//                    } else {
//                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
//                    }
//                }
//                if ($key == 'price') {
//                    if ($price) {
//                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $price[0]);
//                    } else {
//                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
//                    }
//                }
//            }