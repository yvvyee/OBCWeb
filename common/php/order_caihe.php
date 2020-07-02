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

    $tr = "";
    $thead = "";

    $waixiang = "外箱";

    foreach ($designs as $j => $design) {
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
            #region MySQL
            $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$design[0]';";               // 주문량 합계
            $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            if ($carton == null) { continue; } // 주문정보 없음

            $query = "SELECT rate FROM shipping WHERE item='$item[0]'  AND design='$design[0]' AND class='白瓷';";           // 포장율
            $rateBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM stock WHERE item='$item[0]'  AND design='$design[0]' AND class='包装物';";
            $stkBaozhuang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM stock WHERE item='$item[0].$waixiang'  AND design='$design[0]' AND class='包装物';";
            $stkBaozhuangWaixiang = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $share_design = '';
            foreach ($share as $key => $val) { if (in_array($design[0], $val)) { $share_design = $key; } }

            if (empty($share_design)) {
                $query1 = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='彩盒';";        // caihe material
                $query2 = "SELECT sum(qty) FROM material WHERE item='$item[0].$waixiang'  AND design='$design[0]' AND class='彩盒';";        // caihe material
            } else {
                $query1 = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$share_design' AND class='彩盒';";        // caihe material
                $query2 = "SELECT sum(qty) FROM material WHERE item='$item[0].$waixiang' AND design='$share_design' AND class='彩盒';";        // caihe material
            }
            $matCaihe = mysqli_fetch_array(mysqli_query($conn, $query1))[0];
            $matCaiheWaixiang = mysqli_fetch_array(mysqli_query($conn, $query2))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]'  AND design='$design[0]' AND class='完成品';";
            $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$share_design' AND class='彩盒';";
            $rateCaihe = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $cells = "";

            $qtyOrder = intval($carton) * intval($rateBaici);
            $qtyCaihe = intval($stkBaozhuang) + intval($matCaihe);
            $qtyCaiheWaixiang = intval($stkBaozhuangWaixiang) + intval($matCaiheWaixiang);
            $qtyChengpin = intval($matChengpin) * intval($rateCaihe);
            $qtySum = $qtyOrder - $qtyCaihe - $qtyChengpin;
            $qtySumWaixiang = $qtyOrder - $qtyCaiheWaixiang - $qtyChengpin;

            $cell = sprintf($fmt_td[true], $item[0]);
            $cells = $cells . $cell;

            if (empty($share_design)) {
                $cell = sprintf($fmt_td[true], $design[0]);
            } else {
                $cell = sprintf($fmt_td[true], $share_design);
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyOrder);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyCaihe);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyChengpin);
            $cells = $cells . $cell;

            if ($qtySum < 0) {
                $cell = sprintf($fmt_td['alert'], $qtySum);
            } else {
                $cell = sprintf($fmt_td['right'], $qtySum);
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $item[0].$waixiang);
            $cells = $cells . $cell;

            if ($qtySumWaixiang < 0) {
                $cell = sprintf($fmt_td['alert'], $qtySumWaixiang);
            } else {
                $cell = sprintf($fmt_td['right'], $qtySumWaixiang);
            }
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $fmt_btn['order']);
            $cells = $cells . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells);
        }
    }

    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);

    $new_table = sprintf($fmt_table, '', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}
?>
