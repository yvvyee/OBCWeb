<?php
function orderBaici() {
    // mysql
    global $conn;
    // 테이블 포맷
    global $fmt_btn;
    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    // 문자열 치환
    global $translate;

    // custom 테이블의 모든 item
    $query = "SELECT DISTINCT custom.item, datalist.seq 
            FROM custom, datalist 
            WHERE datalist.kind = 'item' 
            AND datalist.name = custom.item 
            ORDER BY datalist.seq;";
    $items = mysqli_fetch_all(mysqli_query($conn, $query));

    $tr = "";
    $thead = "";
    foreach ($items as $i => $item) {
        if ($i == 0) {  // 테이블 헤더
            $cells = "";

            $cell = sprintf($fmt_td[true], 'th', '', $translate['item']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['carton']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', 'Order');
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['baici']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['chengpin']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['caici']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['orderqty']);
            $cells = $cells . $cell;
            $cell = sprintf($fmt_td[true], 'th', '', $translate['order']);
            $cells = $cells . $cell;
            $tr = sprintf($fmt_tr, $cells);
            $thead = sprintf($fmt_row, 'thead', 'none', $tr);

            $tr = "";
        }

        $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]';";   // 주문량 합계
        $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND class='白瓷';"; // 포장율
        $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT qty FROM stock WHERE item='$item[0]' AND class='白瓷';"; // baici stock
        $stkBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM stock WHERE item='$item[0]' AND class='完成品';";    // chengpin stock
        $stkChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM stock WHERE item='$item[0]' AND class='彩瓷';"; // caici stock
        $stkCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='白瓷';"; // baici material
        $matBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='完成品';"; // chengpin material
        $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='贴花';"; // tiehua with item only
        $tiehuaA = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='出库';"; // chuku
        $chuku = mysqli_fetch_array(mysqli_query($conn, $query))[0];

        $cells = "";

        $qtyOrder = intval($carton) * intval($rate);
        $qtyChengpin = (intval($stkChengpin) + intval($matChengpin) - intval($chuku)) * intval($rate);
//        $sumChengpin = intval($stkChengpin) + intval($matChengpin) - intval($chuku);
        $qtyBaici = intval($stkBaici) + intval($matBaici) - intval($tiehuaA);
        $qtySum = $qtyBaici - $qtyOrder + $stkChengpin + $stkCaici;

        $cell = sprintf($fmt_td[true], 'td', 'item', $item[0]);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $carton);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qtyOrder);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qtyBaici);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qtyChengpin);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $stkCaici);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qtySum);
        $cells = $cells . $cell;

        $cell = sprintf($fmt_td[true], 'td', 'order', $fmt_btn['order']);
        $cells = $cells . $cell;

        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);

    $new_table = sprintf($fmt_table, '', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}
?>
