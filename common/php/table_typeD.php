<?php
function stockD() {
    global $conn;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $fmt_th;
    global $translate;

    $classStock = $translate['caici'];

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
                $cells_head_1 .= sprintf($fmt_th['attr'], "colspan='5'", $design[0]);
                $cells_head_1 .= sprintf($fmt_th[true], '');

                $cells_head_2 = sprintf($fmt_th[true], $translate['item']);
                $cells_head_2 .= sprintf($fmt_th[true],'期初');
                $cells_head_2 .= sprintf($fmt_th[true],'贴花');
                $cells_head_2 .= sprintf($fmt_th[true],'完成品');
                $cells_head_2 .= sprintf($fmt_th[true],'出库');
                $cells_head_2 .= sprintf($fmt_th[true],'破损');
                $cells_head_2 .= sprintf($fmt_th[true],'现在库存');

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }
            // 테이블 바디
            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';"; // stock
            $stkCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='贴花';"; // material
            $matTiehua = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';"; // 완성품
            $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';";
            $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='破损';";
            $posun = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            if (($stkCaici == null || $stkCaici == '0' || empty($stkCaici)) &&
                ($matTiehua == null || $matTiehua == '0' || empty($matTiehua)) &&
                ($matChengpin == null || $matChengpin == '0' || empty($matChengpin)) &&
                ($posun == null || $posun == '0' || empty($posun))) { continue; }

            $subtract = intval($matChengpin) * intval($rate);
            $sum = (intval($stkCaici) + intval($matTiehua) - intval($subtract) - intval($posun));    // 현재 재고

            $cell = sprintf($fmt_td[true], $item[0], '');
            $cells_body = $cell;

            $cell = sprintf($fmt_td['right'], $stkCaici, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $matTiehua, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $matChengpin, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $subtract, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $posun, '');
            $cells_body .= $cell;

            $cell = sprintf($fmt_td['right'], $sum, '');
            $cells_body .= $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }
        if (empty($tr)) { continue; }
        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate['caici'].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}