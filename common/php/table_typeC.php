<?php
function stockC($title) {
    global $conn;
    global $share;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
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
                $cells_head_1 = sprintf($fmt_td['attr'], 'th', "rowspan='2' style='text-align: center'", $translate['item']);
                $cells_head_2 = sprintf($fmt_td[true], 'th', "", '期初');
                $cells_head_2 .= sprintf($fmt_td[true], 'th', "", $classSubtr);

                if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') // 포장물 공용
                {
                    $cells_head_1 .= sprintf($fmt_td['attr'], 'th', "colspan='2' style='text-align: center'", $design[0]);

                    foreach ($share[$design[0]] as $j => $share_design) {   // 공용 헤더
                        $cells_head_1 .= sprintf($fmt_td['attr'], 'th', "colspan='2' style='text-align: center'", $share_design);
                        $cells_head_2 .= sprintf($fmt_td[true], 'th', "", '完成品');
                        $cells_head_2 .= sprintf($fmt_td[true], 'th', "", '出库');
                    }
                }
                else
                {
                    $cells_head_1 .= sprintf($fmt_td['attr'], 'th', "colspan='4' style='text-align: center'", $design[0]);
                    $cells_head_2 .= sprintf($fmt_td[true], 'th', "", '完成品');
                    $cells_head_2 .= sprintf($fmt_td[true], 'th', "", '出库');
                }
                $cells_head_1 .= sprintf($fmt_td['attr'], 'th', "rowspan='2'", '现在库存');

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }
            // 테이블 바디
            $cell = sprintf($fmt_td[true], 'td', "", $item[0]);    // item 이름
            $cells_body = $cell;

            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='$classStock';"; // stock
            $stock = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='$classStock';"; // material
            $material = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $cellArray = array();
            if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') {    // 포장물 재고 계산
                $matShare = array();
                foreach ($share[$design[0]] as $key => $share_design) {
                    $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$share_design' AND class='完成品';"; // 완성품
                    $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                    array_push($cellArray, intval($carton));
//                    $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $carton);
//                    $cells_body .= $cell;

                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$share_design' AND class='$classSubtr';"; // for subtraction
                    $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $qty = intval($carton) * intval($rate);
                    array_push($matShare, $qty);
                    array_push($cellArray, $qty);

//                    $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $qty);
//                    $cells_body .= $cell;
                }
                $subtract = array_sum($matShare);
            }
            else {  // 비공용 포장물 or 차이허 재고 계산
                $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$share_design' AND class='完成品';"; // 완성품
                $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                array_push($cellArray, intval($carton));
//                $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $carton);
//                $cells_body .= $cell;

                if ($title == 'baozhuang') {
                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$share_design' AND class='$classSubtr';";
                } else {
                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$share_design' AND class='$classStock';";
                }
                $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                // 포장율 계산
                $subtract = intval($carton) * intval($rate);
            }

            $hasValue = false;
            foreach ($cellArray as $k => $cell) { $hasValue = true ? ($stock > 0 || $material > 0 || $cell > 0) : false; }
            if (!$hasValue) { continue; }

            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $stock);
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $material);
            $cells_body .= $cell;

//            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $subtract);
//            $cells_body .= $cell;

            foreach ($cellArray as $k => $cell) {
                $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $cell);
                $cells_body .= $cell;
            }

            $sum = (intval($stock) + intval($material) - intval($subtract));    // 현재 재고
            $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $sum);

            $cells_body .= $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }

        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate[$title].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}