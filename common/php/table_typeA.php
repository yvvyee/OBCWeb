<?php
function stockA() {
    global $conn;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $fmt_th;
    global $translate;
    global $relation;

    // stock 테이블의 모든 item
    $query = "SELECT DISTINCT stock.item, datalist.seq 
            FROM stock, datalist 
            WHERE stock.class = '白瓷'
            AND datalist.kind = 'item'
            AND datalist.name = stock.item 
            ORDER BY datalist.seq;";
    $items = mysqli_fetch_all(mysqli_query($conn, $query));
    
    // 테이블 바디
    $tr = "";
    foreach ($items as $i => $item) {
        $cells = "";

        $cell = sprintf($fmt_td[true], $item[0]); // 아이템 이름
        $cells = $cells . $cell;

        $query = "SELECT qty FROM stock WHERE item='$item[0]' AND class='白瓷';"; // baici stock
        $stkBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];
        $cell = sprintf($fmt_td['right'], $stkBaici);
        $cells = $cells . $cell;

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='白瓷';"; // baici material
        $matBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];
        $cell = sprintf($fmt_td['right'], $matBaici);
        $cells = $cells . $cell;

        $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='贴花';"; // tiehua with item only
        $tiehua = mysqli_fetch_array(mysqli_query($conn, $query))[0];
        $cell = sprintf($fmt_td['right'], $tiehua);
        $cells = $cells . $cell;

        $sum = (intval($stkBaici) + intval($matBaici) - intval($tiehua));  // 합계수량
        $cell = sprintf($fmt_td['right'], $sum);
        $cells = $cells . $cell;

        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);

    // 테이블 헤더 부분
    $cells = "";
    $cell = sprintf($fmt_th[true], '品名');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_th[true], '期初');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_th[true], '入库');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_th[true], '出库');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_th[true], '现在库存');
    $cells = $cells . $cell;

    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', 'none', $tr);

    // 전체 테이블 완성
    $new_table = sprintf($fmt_table, '白瓷库存', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}