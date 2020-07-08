<?php
function stockC() {
    global $conn;
    global $share;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $fmt_th;
    global $translate;
    global $relation;

    $classStock = $translate['baozhuang'];
    $classSubtr = $relation['baozhuang'];
    $waixiang = '外箱';

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
                $cells_head_1 = sprintf($fmt_th[true], $translate['design']);
                $cells_head_2 = sprintf($fmt_th[true], $translate['item']);
                $cells_head_2 .= sprintf($fmt_th[true],'期初');
                $cells_head_2 .= sprintf($fmt_th[true],'彩盒');

                if (array_key_exists($design[0], $share))
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
                    $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='4'", $design[0]);
                    $cells_head_2 .= sprintf($fmt_th[true],'完成品');
                    $cells_head_2 .= sprintf($fmt_th[true],'出库');
                }

                $cells_head_1 .= sprintf($fmt_th[true], '');
                $cells_head_2 .= sprintf($fmt_th[true], '现在库存');

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }
            // 테이블 바디
            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='包装物';"; // stock
            $stkBaozhuang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='彩盒';"; // material
            $matCaihe = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            if (substr($item[0], -6) == $waixiang)
            {
                $itemName = str_replace($waixiang, '', $item[0]);
            }
            else
            {
                $itemName = $item[0];
            }

            $cellArray = array();
            $cellArrayWaixiang = array();

            if (array_key_exists($design[0], $share)) {
                $matShare = array();
                $matShareWaixiang = array();
                foreach ($share[$design[0]] as $key => $share_design) {
                    $query = "SELECT sum(qty) FROM material WHERE item='$itemName' AND design='$share_design' AND class='完成品';"; // 완성품
                    $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                    array_push($cellArray, intval($matChengpin));
                    array_push($cellArrayWaixiang, intval($matChengpin));

                    $query = "SELECT rate FROM shipping WHERE item='$itemName' AND design='$share_design' AND class='彩盒';"; // for subtraction
                    $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $qty = intval($matChengpin) * intval($rate);
                    array_push($matShare, $qty);
                    array_push($matShareWaixiang, intval($matChengpin));
                    array_push($cellArray, $qty);
                    array_push($cellArrayWaixiang, null);
                }
                if (substr($item[0], -6) == $waixiang) {
                    $subtract = array_sum($matShareWaixiang);
                } else {
                    $subtract = array_sum($matShare);
                }
            }
            else {
                $query = "SELECT sum(qty) FROM material WHERE item='$itemName' AND design='$design[0]' AND class='完成品';"; // 완성품
                $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                array_push($cellArray, intval($matChengpin));
                array_push($cellMatChengpin, intval($matChengpin));

                $query = "SELECT rate FROM shipping WHERE item='$itemName' AND design='$design[0]' AND class='彩盒';";
                $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                if (substr($item[0], -6) == $waixiang) {
                    $subtract = intval($matChengpin);
                } else {
                    $subtract = intval($matChengpin) * intval($rate);
                }

                array_push($cellArray, $subtract);
            }

            $hasValue = false;
            foreach ($cellArray as $k => $cell) { $hasValue = true ? ($stkBaozhuang > 0 || $matCaihe > 0 || $cell > 0) : false; }
            if (!$hasValue) { continue; }

            $cell = sprintf($fmt_td[true], $item[0], '');
            $cells_body = $cell;

            $cell = sprintf($fmt_td['right'], $stkBaozhuang, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $matCaihe, '');
            $cells_body .= $cell;

            if (substr($item[0], -6) == $waixiang) {
                foreach ($cellArrayWaixiang as $k => $cell) {
                    $cell = sprintf($fmt_td['right'], $cell, '');
                    $cells_body .= $cell;
                }
            }
            else
            {
                foreach ($cellArray as $k => $cell) {
                    $cell = sprintf($fmt_td['right'], $cell, '');
                    $cells_body .= $cell;
                }
            }
            $sum = (intval($stkBaozhuang) + intval($matCaihe) - intval($subtract));    // 현재 재고
            $cell = sprintf($fmt_td['right'], $sum, '');
            $cells_body .= $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }
        if (empty($tr)) { continue; }
        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate['baozhuang'].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}