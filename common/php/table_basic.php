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

function set_input_form() {
    global $fmt_input;
    global $input_list;
    global $input_type;
    global $translate;
    global $conn;
    
    // datalist 불러오기
    $sql = "SELECT * FROM datalist ORDER BY seq";
    $res = mysqli_query( $conn, $sql );
    $datalist = mysqli_fetch_all($res);

    $tname = $_POST['page'];    // 테이블명

    $input_form = '';
    foreach ($input_list[$tname] as $i => $cname) { // 컬럼명
        $id = $tname . '_' . $cname;
        
        if ($cname == 'no')
        {
            // no 는 시각화하지 않음
            $temp = sprintf($fmt_input, $id, $cname, $input_type[$cname], $translate[$cname], 'display: none', '');
        }
        else
        {
            $options = '';
            if ($cname == 'orderno') // orderno 는 datalist 테이블에서 따로 관리하지 않음
            {
                // 저장된 모든 orderno 를 가져옴
                $sql = "SELECT DISTINCT orderno FROM $tname";
                $res = mysqli_query( $conn, $sql );
                $orderno = mysqli_fetch_all($res);
                foreach ($orderno as $str)
                {
                    $var = htmlentities($str[0]);
                    $options =  $options. "<option value='$var'>";
                }
            }
            else
            {
                foreach ($datalist as $row)
                {
                    if ($row[2] == $cname) // kind == column name
                    {
                        if ($row[4] == '') // sep == null, 페이지 구분없이 공통
                        {
                            $var = htmlentities($row[1]);
                            $options =  $options. "<option value='$var'>";
                        }
                        else
                        {
                            if ($row[4] == $tname) // sep == table name, 페이지마다 리스트 내용이 다름
                            {
                                $var = htmlentities($row[1]);
                                $options =  $options. "<option value='$var'>";
                            }
                        }
                    }
                }
            }
            // payment 페이지는 별도로 처리
            if ($tname == 'payment' && ($cname != 'month' && $cname != 'supplier')) {
                $temp = sprintf($fmt_input, $id, $cname, $input_type[$cname], $translate[$cname], 'display: none', '');
            } else {
                $temp = sprintf($fmt_input, $id, $cname, $input_type[$cname], $translate[$cname], '', $options);
            }
        }
        $input_form = $input_form . $temp;
    }
    echo "<script type='text/html' id='temp_page'>$input_form</script>";
}

function search() {
    global $conn;
    global $sql_search_all;
    global $sql_search_where;
    global $fmt_th;
    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $fmt_btn;

    $tname = $_POST['page'];
    $show = $_POST['show'];
    $cols = $_POST['cols'];

    $condition = makeCondition($cols);

    if ($condition == '整体搜索') {
        $query = sprintf($sql_search_all, $tname);
    } else {
        $query = sprintf($sql_search_where, $tname, $condition);
    }
    $res = mysqli_query($conn, $query);

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = "";
        foreach ($show as $key => $val) {
            // no 는 항상 숨김
            if ($key == 'no') {
                $cell = sprintf($fmt_td[false], $row[$key], 'no');
            }
            // 체크박스 상태에 맞게 테이블 내용 시각화
            else {
                $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
                $cell = sprintf($fmt_td[$bval], $row[$key], $key);
            }
            $cells = $cells . $cell;
        }
        // 수정 & 삭제 버튼
        $cell = sprintf($fmt_td[true], $fmt_btn['edit'], 'edit');
        $cells = $cells . $cell;
        $cell = sprintf($fmt_td[true], $fmt_btn['del'], 'del');
        $cells = $cells . $cell;
        // Row
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    // 테이블 바디
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);

    // 테이블 헤더 부분
    $cells = "";
    foreach ($show as $key => $val) {
        if ($key == 'no') {
            $cell = sprintf($fmt_th[false], $translate[$key]);
        } else {
            $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            $cell = sprintf($fmt_th[$bval], $translate[$key]);
        }
        $cells = $cells . $cell;
    }
    // 수정 & 삭제 버튼
    $cell = sprintf($fmt_th[true], $translate['edit']);
    $cells = $cells . $cell;
    $cell = sprintf($fmt_th[true], $translate['del']);
    $cells = $cells . $cell;
    // Row
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', 'none', $tr);

    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function save() {
    global $conn;
    global $sql_insert;

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

    $query = sprintf($sql_insert, $tname, $into, $vals);
    $res = mysqli_query($conn, $query);

    // custom - modal 에서 저장한 경우
    if ($tname == 'ordering' && $show == null) {
        echo $res;
    }
    // 이외에는 테이블을 갱신
    else {
        // 마지막으로 저장된 데이터 ID
        $query = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $cells = '';
        foreach ($show as $key => $val) {
            if ($key == 'no') {
                $cell = sprintf($fmt_td[false], $no, 'no');
            }
            else {
                $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
                $cell = sprintf($fmt_td[$bval], $cols[$key], $key);
            }
            $cells = $cells . $cell;
        }
        // 수정 & 삭제 버튼
        $cell = sprintf($fmt_td[true], $fmt_btn['edit'], 'edit');
        $cells = $cells . $cell;
        $cell = sprintf($fmt_td[true], $fmt_btn['del'], 'del');
        $cells = $cells . $cell;
        $tr = sprintf($fmt_tr, $cells);
        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function update() {
    global $conn;
    global $sql_update;

    $tname = $_POST['page'];
    $cols = $_POST['cols'];
    $set = "";
    $where = "no = ";
    foreach ($cols as $key => $val) {
        if ($key == 'no') {
            $where = $where . "$val";
        } else {
            $set = $set . $key . "='$val',";
        }
    }
    $set = substr($set, 0, -1);
    $query = sprintf($sql_update, $tname, $set, $where);

    echo mysqli_query($conn, $query);
}

function del() {
    global $conn;
    global $sql_delete;

    $table = $_POST['page'];
    $noCol = $_POST['no'];

    $query = sprintf($sql_delete, $table, $noCol);

    echo mysqli_query($conn, $query);
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