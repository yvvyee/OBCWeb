<?php
function orderCustom() {
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

    $orderno = $_POST['cols']['orderno'];

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

    $tr = "";
    $thead = "";
    foreach ($designs as $j => $design) {
        foreach ($items as $i => $item) {
            if ($i == 0 && $j == 0) {
                $cells_head_1 = sprintf($fmt_th[true], $translate['orderno']);
                $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='6'", $orderno);

                $cells_head_2 = sprintf($fmt_th[true], $translate['item']);
                $cells_head_2 .= sprintf($fmt_th[true], $translate['design']);
                $cells_head_2 .= sprintf($fmt_th[true], 'Order');
                $cells_head_2 .= sprintf($fmt_th[true], $translate['chengpin']);
                $cells_head_2 .= sprintf($fmt_th[true], $translate['caici']);
                $cells_head_2 .= sprintf($fmt_th[true], '未包彩瓷');
                $cells_head_2 .= sprintf($fmt_th[true], $translate['order']);

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }

            if (empty($orderno)) {
                $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$design[0]';";               // 주문량 합계
            } else {
                $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$design[0]' AND orderno='$orderno';";               // 주문량 합계
            }

            $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            if ($carton == null) { continue; } // 주문정보 없음

            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';"; // stock
            $stkCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='贴花';"; // material
            $matTiehua = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';";        // chengpin stock
            $stkChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';"; // 완성품
            $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';";
            $rateCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='破损';";
            $posun = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='白瓷';";           // 포장율
            $rateBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='出库';";       // chuku
            $chuku = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            
            // 계산
            $qtyOrder = intval($carton);
            $qtyChengpin = intval($stkChengpin) + intval($matChengpin) - intval($chuku);
            $subtract = intval($matChengpin) * intval($rateCaici);
            $sumCaici = (intval($stkCaici) + intval($matTiehua) - intval($subtract) - intval($posun));
            $qtyWeibao = $sumCaici / intval($rateBaici);

            // 셀 작업
            $cells = "";

            $cell = sprintf($fmt_td[true], $item[0], '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $design[0], '');
            $cells = $cells . $cell;

            if ($qtyChengpin < $qtyOrder) {
                $cell = sprintf($fmt_td['alert'], $qtyOrder, '');
            } else {
                $cell = sprintf($fmt_td['right'], $qtyOrder, '');
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyChengpin, '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $sumCaici, '');
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], floor($qtyWeibao), '');
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