<?php
function stockC($title) {
    global $conn;
    global $share;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $fmt_th;
    global $translate;
    global $relation;

    $classStock = $translate[$title];
    $classSubtr = $relation[$title];

    // stock 테이블의 모든 item
    $query = "SELECT DISTINCT stock.item, datalist.seq 
            FROM stock, datalist 
            WHERE stock.class = '$classStock'
            AND datalist.kind = 'item'
            AND datalist.name = stock.item 
            ORDER BY datalist.seq;";
    $items = mysqli_fetch_all(mysqli_query($conn, $query));

    // stock 테이블의 모든 deisgn
    $query = "SELECT DISTINCT stock.design, datalist.seq 
            FROM stock, datalist 
            WHERE stock.class = '$classStock'
            AND datalist.kind = 'design' 
            AND datalist.name = stock.design 
            ORDER BY datalist.seq;";
    $designs = mysqli_fetch_all(mysqli_query($conn, $query));

    $total = "";
    foreach ($designs as $j => $design) {
        $tr = "";
        $thead = "";
        foreach ($items as $i => $item) {
            if ($i == 0) {  // 테이블 헤더
//                $cells_head_1 = sprintf($fmt_td['attr'], 'th', "rowspan='2' style='text-align: center'", $translate['item']);
                $cells_head_1 = sprintf($fmt_th[true], $translate['design']);
                $cells_head_2 = sprintf($fmt_th[true], $translate['item']);
                $cells_head_2 .= sprintf($fmt_th[true],'期初');
                $cells_head_2 .= sprintf($fmt_th[true], $classSubtr);

                if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') // 포장물 공용
                {
                    $cells_head_1 .= sprintf($fmt_th['attr'],"colspan='2'", $design[0]);

                    foreach ($share[$design[0]] as $j => $share_design) {   // 공용 헤더
                        $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='2'", $share_design);
                        $cells_head_2 .= sprintf($fmt_th[true], '完成品');
                        $cells_head_2 .= sprintf($fmt_th[true], '出库');
                    }
                }
                else
                {
                    $cells_head_2 .= sprintf($fmt_th[true],'完成品');
                    $cells_head_2 .= sprintf($fmt_th[true],'出库');
                    if ($title == 'caici') {
                        $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='5'", $design[0]);
                        $cells_head_2 .= sprintf($fmt_th[true], '破损');
                    } else {
                        $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='4'", $design[0]);
                    }
                }
//                $cells_head_1 .= sprintf($fmt_td['attr'], 'th', "rowspan='2'", '现在库存');
                $cells_head_1 .= sprintf($fmt_th[true], '');
                $cells_head_2 .= sprintf($fmt_th[true], '现在库存');

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }
            // 테이블 바디
            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='$classStock';"; // stock
            $stock = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='$classSubtr';"; // material
            $material = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $cellArray = array();
            if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') {    // 공용처리
                $matShare = array();
                foreach ($share[$design[0]] as $key => $share_design) {
                    $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$share_design' AND class='完成品';"; // 완성품
                    $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                    array_push($cellArray, intval($carton));

                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$share_design' AND class='$classSubtr';"; // for subtraction
                    $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $qty = intval($carton) * intval($rate);
                    array_push($matShare, $qty);
                    array_push($cellArray, $qty);
                }
                $subtract = array_sum($matShare);
            }
            else {  //
                $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';"; // 완성품
                $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                array_push($cellArray, intval($carton));

                if ($title == 'baozhuang') {
                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='彩盒';";
                } else {
                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';";
                }

                $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                if ($title == 'caici') {
                    $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$share_design' AND class='破损';";
                    $posun = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                    $subtract = intval($carton) * intval($rate) + intval($posun);
                    array_push($cellArray, $subtract);
                    array_push($cellArray, $posun);
                } else {
                    $subtract = intval($carton) * intval($rate);
                    array_push($cellArray, $subtract);
                }
            }

            $hasValue = false;
            foreach ($cellArray as $k => $cell) { $hasValue = true ? ($stock > 0 || $material > 0 || $cell > 0) : false; }
            if (!$hasValue) { continue; }

            $cell = sprintf($fmt_td[true], $item[0]);    // item 이름
            $cells_body = $cell;

            $cell = sprintf($fmt_td['right'], $stock);
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $material);
            $cells_body .= $cell;

            foreach ($cellArray as $k => $cell) {
                $cell = sprintf($fmt_td['right'], $cell);
                $cells_body .= $cell;
            }

            $sum = (intval($stock) + intval($material) - intval($subtract));    // 현재 재고
            $cell = sprintf($fmt_td['right'], $sum);
            $cells_body .= $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }
        if (empty($tr)) { continue; }
        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate[$title].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}