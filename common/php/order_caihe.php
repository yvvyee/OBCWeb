<?php
function orderCaihe() {
    // mysql
    global $conn;
    // 테이블 포맷
    global $fmt_btn;
    global $fmt_th;
    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    // 문자열 치환
    global $translate;

    global $share;

    // custom 테이블의 모든 item
    $query = "SELECT DISTINCT custom.item, datalist.seq 
            FROM custom, datalist 
            WHERE datalist.kind = 'item' 
            AND datalist.name = custom.item 
            ORDER BY datalist.seq;";
    $items = mysqli_fetch_all(mysqli_query($conn, $query));

    // custom 테이블의 모든 deisgn
    $query = "SELECT DISTINCT custom.design, datalist.seq 
            FROM custom, datalist 
            WHERE datalist.kind = 'design' 
            AND datalist.name = custom.design 
            ORDER BY datalist.seq;";
    $designs = mysqli_fetch_all(mysqli_query($conn, $query));
    
    // 共用
    $designsShare = array();
    foreach ($designs as $j => $design) {
        if (in_array($design[0], $share['green共用']))
        {
            if (!in_array('green共用', $designsShare))
            {
                array_push($designsShare, 'green共用');
            }
        } else
        if (in_array($design[0], $share['bon&heim共用']))
        {
            if (!in_array('bon&heim共用', $designsShare))
            {
                array_push($designsShare, 'bon&heim共用');
            }
        }
        else
        {
            array_push($designsShare, $design[0]);
        }
    }

    $tr = "";
    $thead = "";
    $waixiang = "外箱";

    foreach ($designsShare as $j => $design) {
        foreach ($items as $i => $item) {
            if ($i == 0 && $j == 0) { // 최초에 테이블 헤더 세팅
                $cells = "";

                $cell = sprintf($fmt_th[true], $translate['item']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['design']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], 'Order');
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['caihe']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['chengpin']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['orderqty']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['waixiang']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['orderqty']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['order']);
                $cells = $cells . $cell;
                $tr = sprintf($fmt_tr, $cells);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr);

                $tr = "";
            }

            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design' AND class='包装物';"; // stock
            $stkBaozhuang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design' AND class='彩盒';"; // material
            $matCaihe = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT qty FROM stock WHERE item='$item[0].$waixiang' AND design='$design' AND class='包装物';"; // stock
            $stkBaozhuangWaixiang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0].$waixiang' AND design='$design' AND class='彩盒';"; // material
            $matCaiheWaixiang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            if (!array_key_exists($design, $share)) {
                // 주문량 합계
                $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$design';";
                $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                $query = "SELECT rate FROM shipping WHERE item='$item[0]'  AND design='$design' AND class='彩盒';";
                $rateOrder = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                $qtyOrder = intval($carton) * intval($rateOrder);

                // 완성품
                $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design' AND class='完成品';";
                $qtyMatChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design' AND class='彩盒';";
                $rateChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                $qtyChengpin = intval($qtyMatChengpin) * intval($rateChengpin);

            } else {
                $tempOrder = array();
                $tempChengpin = array();
                $tempMatChengpin = array();
                foreach ($share[$design] as $key => $dname) {
                    // 주문량 합계
                    $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$dname';";
                    $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $query = "SELECT rate FROM shipping WHERE item='$item[0]'  AND design='$dname' AND class='彩盒';";
                    $rateOrder = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $qty1 = intval($carton) * intval($rateOrder);
                    array_push($tempOrder, $qty1);

                    // 완성품
                    $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$dname' AND class='完成品';";
                    $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];
                    array_push($tempMatChengpin, intval($matChengpin));

                    $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$dname' AND class='彩盒';";
                    $rateChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

                    $qty2 = intval($matChengpin) * intval($rateChengpin);
                    array_push($tempChengpin, $qty2);
                }
                $qtyOrder = array_sum($tempOrder);
                $qtyChengpin = array_sum($tempChengpin);
                $qtyMatChengpin = array_sum($tempMatChengpin);
            }

            if ($qtyOrder == null) {
                continue;
            } // 주문정보 없음

            $cells = "";

            $qtyCaihe = intval($stkBaozhuang) + intval($matCaihe);
            $qtyCaiheWaixiang = intval($stkBaozhuangWaixiang) + intval($matCaiheWaixiang);
            $qtySum = $qtyCaihe - $qtyOrder - $qtyChengpin;
            $qtySumWaixiang = $qtyCaiheWaixiang - $qtyOrder - $qtyMatChengpin;

            $cell = sprintf($fmt_td[true], $item[0], '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $design, '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyOrder, '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyCaihe, '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyChengpin, '');
            $cells = $cells . $cell;

            if ($qtySum < 0) {
                $cell = sprintf($fmt_td['alert'], $qtySum, '');
            } else {
                $cell = sprintf($fmt_td['right'], $qtySum, '');
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $item[0] . $waixiang, '');
            $cells = $cells . $cell;

            if ($qtySumWaixiang < 0) {
                $cell = sprintf($fmt_td['alert'], $qtySumWaixiang, '');
            } else {
                $cell = sprintf($fmt_td['right'], $qtySumWaixiang, '');
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $fmt_btn['order'], '');
            $cells = $cells . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells);

        }
    }

    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);

    $new_table = sprintf($fmt_table, '', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}
?>