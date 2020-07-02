<?php
function orderHuazhi() {
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
                $cells = "";

                $cell = sprintf($fmt_th[true], $translate['item']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['design']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], 'Order');
                $cells = $cells . $cell;
//                $cell = sprintf($fmt_td[true], 'th', '', $translate['baici']);
//                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['huazhi']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['chengpin']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['caici']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['orderqty']);
                $cells = $cells . $cell;
                $cell = sprintf($fmt_th[true], $translate['order']);
                $cells = $cells . $cell;
                $tr = sprintf($fmt_tr, $cells);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr);

                $tr = "";
            }

            $query = "SELECT sum(carton) FROM custom WHERE item='$item[0]' AND design='$design[0]';";               // 주문량 합계
            $carton = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            if ($carton == null) { continue; } // 주문정보 없음

            $query = "SELECT rate FROM shipping WHERE item='$item[0]' AND design='$design[0]' AND class='白瓷';";           // 포장율
            $rate = mysqli_fetch_array(mysqli_query($conn, $query))[0];

//            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND class='白瓷';";                                    // baici stock
//            $stkBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='花纸';";           // huazhi stock
            $stkHuazhi = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';";        // chengpin stock
            $stkChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];
//            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='包装物';";        // baozhuang stock
//            $stkBaozhuang = mysqli_fetch_array(mysqli_query($conn, $query))[0];
//            $query = "SELECT qty FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';";        // caici stock
//            $stkCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];

//            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='白瓷';";                            // baici material
//            $matBaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='花纸';";   // huazhi material
            $matHuazhi = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='完成品';"; // chengpin material
            $matChengpin = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT sum(qty) FROM stock WHERE item='$item[0]' AND design='$design[0]' AND class='彩瓷';";        // caihe material
            $stkCaici = mysqli_fetch_array(mysqli_query($conn, $query))[0];
//            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='破损';";        // posun material
//            $posun = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND class='贴花';";                               // tiehua with item only
            $tiehuaA = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='贴花';"; // tiehua with item and design
            $tiehuaC = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            $query = "SELECT sum(qty) FROM material WHERE item='$item[0]' AND design='$design[0]' AND class='出库';";       // chuku
            $chuku = mysqli_fetch_array(mysqli_query($conn, $query))[0];

            $cells = "";
            $qtyOrder = intval($carton) * intval($rate);
//            $sumBaici = intval($stkBaici) + intval($matBaici) - intval($tiehuaA);
            $qtyHuazhi = intval($stkHuazhi) + intval($matHuazhi) - intval($tiehuaC);
            $qtyChengpin = (intval($stkChengpin) + intval($matChengpin) - intval($chuku)) * intval($rate);
            $qtySum = $qtyOrder - $qtyHuazhi - $qtyChengpin - intval($stkCaici);

            $cell = sprintf($fmt_td[true], $item[0]);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td[true], $design[0]);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyOrder);
            $cells = $cells . $cell;

//            $cell = sprintf($fmt_td['attr'], 'td', "name='baici'; style='text-align: right'", $sumBaici);
//            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyHuazhi);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $qtyChengpin);
            $cells = $cells . $cell;

            $cell = sprintf($fmt_td['right'], $stkCaici);
            $cells = $cells . $cell;

            if ($qtySum < 0) {
                $cell = sprintf($fmt_td['alert'], $qtySum);
            } else {
                $cell = sprintf($fmt_td['right'], $qtySum);
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
