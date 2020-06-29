<?php
function searchPayment() {
    global $conn;
    global $sql_search_all;
    global $sql_search_where;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;

    $color = random_color();

    $tname = 'material';
    $show = $_POST['show'];
    $cols = $_POST['cols'];

    $condition = makeCondition($cols);

    if ($condition == '整体搜索') {
        $query = sprintf($sql_search_all, $tname);
    } else {
        $query = sprintf($sql_search_where, $tname, $condition);
    }
    $res = mysqli_query($conn, $query);

    $sum = 0.;

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $qty = $row['qty'];
        $item = $row['item'];
        $class = $row['class'];
        $design = $row['design'];
        $supplier = $row['supplier'];

        $query = "SELECT price FROM price WHERE item='$item' AND class='$class' AND design='$design' AND supplier='$supplier';";
        $price = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $cells = "";
        foreach ($show as $key => $val) {
            // payment 페이지에서 숨겨지는 항목
            if ($key == 'no' || $key == 'month' || $key == 'supplier') {
                $cell = sprintf($fmt_td[false], 'td', $key, $row[$key]);
            }
            // 체크박스 상태에 맞게 테이블 내용 시각화
            else {
                $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
                $cellVal = $row[$key];

                if ($key == 'qty') { $sum += floatval($qty); }
                if ($key == 'price') { $cellVal = $price; }
                if ($key == 'total') { $cellVal = floatval($qty) * floatval($price); }

                $cell = sprintf($fmt_td[$bval], 'td', $key, $cellVal);
            }
            $cells = $cells . $cell;
        }
        // Row
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    // 테이블 바디
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    // 테이블 헤더 부분
    $cells = "";
    foreach ($show as $key => $val) {
        if ($key == 'no' || $key == 'month' || $key == 'supplier') {
            $cell = sprintf($fmt_td[false], 'th', $key, $translate[$key]);
        } else {
            $bval = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            $cell = sprintf($fmt_td[$bval], 'th', $key, $translate[$key]);
        }
        $cells = $cells . $cell;
    }
    // Row
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

    $condition .= " / 整体合计 = $sum";

    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}