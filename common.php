<?php
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('请重新登录'); window.location = './login.php'; </script>";
}
$conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
$fmt_table = '<table id=\'obc_table\' style=\'min-font-size: 9pt\'>
              <caption style=\'text-align: left\'>%s</caption>%s</table>';
$fmt_row = '<%1$s style=\'border: 3px solid %2$s\'>%3$s</%1$s>';
$fmt_tr = '<tr style=\'border-bottom: 1px dotted silver\'>%s</tr>';

$fmt_td = array(
    'attr'  => '<%1$s %2$s>%3$s</%1$s>',
    'show'  => '<%1$s name=\'%2$s\'>%3$s</%1$s>',
    'none'  => '<%1$s name=\'%2$s\' style=\'display: none\'>%3$s</%1$s>',
    'alert' => '<%1$s name=\'%2$s\' style=\'background-color: #993366; color: #ffffff\'>%3$s</%1$s>'
);

$btn = array(
    'edit'  => '<button name=\'edit\' class=\'btn-success\' onclick=\'displayRow(this); return false;\'>E</button></td>',
    'del'   => '<button name=\'del\' class=\'btn-danger\' onclick=\'submit_basic(this); return false;\'>D</button></td>',
    'order' => '<button name=\'order\' class=\'btn-dark\' onclick=\'submit_basic(this); return false;\' data-toggle="modal" data-target="#order_form" style="background-color: #993366">O</button></td>'
);

$translate = array(
    'no'        => 'no',
    'date'      => '日期',
    'supplier'  => '企业',
    'customer'  => '客户',
    'item'      => '品名',
    'design'    => '花面',
    'qty'       => '数量',
    'month'     => '月份',
    'class'     => '分类',
    'worker'    => '贴花人',
    'rate'      => '包装率',
    'price'     => '单价',
    'edit'      => '修改',
    'del'       => '删除',
    'orderno'   => '订单号码',
    'total'     => '合计',
    'factory'   => '工厂',
    'order'     => '订货',
    'baici'     => '白瓷',
    'huazhi'    => '花纸',
    'chengpin'  => '完成品',
    'baozhuang' => '包装物',
    'caici'     => '彩瓷'
);

$relation = array(
    'baici'     => '贴花',
    'huazhi'    => '贴花',
    'chengpin'  => '出库',
    'baozhuang' => '彩盒',
    'caici'     => '贴花'
);

$items = [
        "4绿碗",
        "5绿碗",
        "7绿碗",
        "3.5汤",
        "5圆汤",
        "6圆汤",
        "7圆汤",
        "8圆平",
        "9圆平",
        "11圆平",
        "7正平",
        "9正平",
        "11正平",
        "方鱼盘",
        "4天龙碗",
        "5天龙碗",
        "7天龙碗",
        "2P杯碟",
        "5P杯碟",
        "2P皇室杯",
        "5P皇室杯",
        "22p",
        "6格碟",
        "4绿碗外箱",
        "5绿碗外箱",
        "7绿碗外箱",
        "3.5汤外箱",
        "5圆汤外箱",
        "6圆汤外箱",
        "7圆汤外箱",
        "8圆平外箱",
        "9圆平外箱",
        "11圆平外箱",
        "7正平外箱",
        "9正平外箱",
        "11正平外箱",
        "方鱼盘外箱",
        "4天龙碗外箱",
        "5天龙碗外箱",
        "7天龙碗外箱",
        "2P杯碟外箱",
        "5P杯碟外箱",
        "2P皇室杯外箱",
        "5P皇室杯外箱",
        "22p外箱",
        "6格碟外箱"
];

$share = array(
    'green共用' => ['8694', '7230'],
    'bon&heim共用' => ['aileen', 'lavie', 'flora', ]
);

$sql_search_all     = 'SELECT * FROM %s ORDER BY no DESC';
$sql_search_con     = 'SELECT * FROM %s WHERE %s ORDER BY no DESC';
$sql_search_one     = 'SELECT %s FROM %s WHERE %s';
$sql_select_all     = 'SELECT * FROM %s WHERE %s';
$sql_insert         = 'INSERT INTO %s (%s) VALUES (%s)';
$sql_update         = 'UPDATE %s SET %s WHERE %s';
$sql_delete         = 'DELETE FROM %s WHERE no = %s';
$sql_distinct       = 'SELECT DISTINCT %s FROM %s';
$sql_distinct_one   = 'SELECT DISTINCT %s FROM %s WHERE %s';

if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'search' || $_POST['msg'] == 'payment') {
        search();
    }
    if ($_POST['msg'] == 'save' || $_POST['msg'] == 'ordering') {
        save();
    }
    if ($_POST['msg'] == 'stock') {
        if ($_POST['title'] == '白瓷') {
            calcBaici();
        }
        if ($_POST['title'] == '花纸') {
            calcStockA('huazhi');
        }
        if ($_POST['title'] == '完成品') {
            calcStockA('chengpin');
        }
        if ($_POST['title'] == '包装物') {
            calcStockB('baozhuang');
        }
        if ($_POST['title'] == '彩瓷') {
            calcStockB('caici');
        }
    }
    if ($_POST['msg'] == 'order') {
        order();
    }
    if ($_POST['msg'] == 'update') {
        update();
    }
    if ($_POST['msg'] == 'del') {
        del();
    }
    if ($_POST['msg'] == 'ibox') {
        updateDatalist($_POST['kind'], $_POST['where']);
    }
    if ($_POST['msg'] == 'logout') {
        session_destroy();
    }
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function makeCondition($arr) : string {
    $condition = "";
    foreach ($arr as $key => $val) {
        if ($key != 'msg' &&
            $key != 'page' &&
            $key != 'showing' &&
            $key != 'edit' &&
            $key != 'del') {
            if (!empty($arr[$key])) {
                $condition = $condition . "$key = '$val' AND ";
            }
        }
    }
    if (empty($condition)) {
        return '整体搜索';
    } else {
        return substr($condition, 0, -4);
    }
}

function getAmount($select, $table, $condition) : string {
    global $conn;
    global $sql_search_one;
    $sql = sprintf($sql_search_one, $select, $table, $condition);
    $res = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

    if ($res != null) {
        return $res;
    } else {
        return 0;
    }
}

function calcByItem($clsA, $clsB, $item) : string {
    $cond = makeCondition(array('class'=>$clsA, 'item'=>$item));
    $stk = getAmount('qty', 'stock', $cond);
    $mat = getAmount('sum(qty)', 'material', $cond);

    $cond = makeCondition(array('class'=>$clsB, 'item'=>$item));
    $sub = getAmount('sum(qty)', 'material', $cond);

    return (intval($stk) + intval($mat) - intval($sub));
}

function calcByItemDesign($clsA, $clsB, $item, $design) : string {
    $cond = makeCondition(array('class'=>$clsA, 'item'=>$item, 'design'=>$design));
    $stk = getAmount('qty', 'stock', $cond);
    $mat = getAmount('sum(qty)', 'material', $cond);

    $cond = makeCondition(array('class'=>$clsB, 'item'=>$item, 'design'=>$design));
    $sub = getAmount('sum(qty)', 'material', $cond);

    return (intval($stk) + intval($mat) - intval($sub));
}

function calcBaici() {
    global $conn;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $translate;
    global $relation;
    global $sql_select_all;
    global $sql_search_one;

    $baici = $translate['baici'];
    $tiehua = $relation['baici'];

    $cond = makeCondition(array(
        'class' => $baici
    ));
    $sql = sprintf($sql_select_all, 'stock', $cond);
    $items = mysqli_query($conn, $sql);

    $tr = "";
    while ($row = mysqli_fetch_array($items)) {
        $cells = "";
        
        // 아이템 이름
        $cell = sprintf($fmt_td['show'], 'td', "", $row['item']);
        $cells = $cells . $cell;


        // 기초 재고
        $cond = makeCondition(array(
            'class' => $baici,
            'item'  => "{$row['item']}"
        ));
        $sql = sprintf($sql_search_one, 'qty', 'stock', $cond);
        $bas = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $bas);
        $cells = $cells . $cell;
        
        // 원자재 입고
        $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);
        $mat = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $mat);
        $cells = $cells . $cell;
        
        // 원자재 출고
        $cond = makeCondition(array(
            'class' => $tiehua,
            'item'  => "{$row['item']}"
        ));
        $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);
        $sub = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $sub);
        $cells = $cells . $cell;
        
        // 합계수량
        $sum = (intval($bas) + intval($mat) - intval($sub));
        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $sum);
        $cells = $cells . $cell;

        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
    
    // 테이블 헤더 부분
    $cells = "";
    $cell = sprintf($fmt_td['show'], 'th', "", '品名');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_td['show'], 'th', "", '期初');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_td['show'], 'th', "", '入库');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_td['show'], 'th', "", '出库');
    $cells = $cells . $cell;

    $cell = sprintf($fmt_td['show'], 'th', "", '现在库存');
    $cells = $cells . $cell;

    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', 'none', $tr);
    
    // 전체 테이블 완성
    $new_table = sprintf($fmt_table, '白瓷库存', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function calcStockB($title) {
    global $conn;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $sql_distinct_one;
    global $sql_search_one;
    global $translate;
    global $relation;

    $clsA = $translate[$title];
    $clsB = $relation[$title];

    $cond = makeCondition(array(
        'class' => $clsA
    ));

    global $items;

    $sql = sprintf($sql_distinct_one, 'design', 'stock', $cond);
    $res = mysqli_query($conn, $sql);
    $designs = mysqli_fetch_all($res);

    $total = "";
    foreach ($designs as $j => $design) {

        $tr = "";
        $thead = "";
        $count = 0;

        foreach ($items as $i => $item) {

            if ($count == 0) {
                $count++;

                // 테이블 헤더
                $cell = sprintf($fmt_td['attr'], 'th',
                    "rowspan='2' style='text-align: center'", '');
                $cells_head_1 = $cell;

                $cell = sprintf($fmt_td['show'], 'th', "", '期初');
                $cells_head_2 = $cell;

                $cell = sprintf($fmt_td['show'], 'th', "", $clsB);
                $cells_head_2 = $cells_head_2 . $cell;

                if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') {

                    $cell = sprintf($fmt_td['attr'], 'th',
                        "colspan='2' style='text-align: center'", $design[0]);
                    $cells_head_1 = $cells_head_1 . $cell;

                    global $share;

                    foreach ($share[$design[0]] as $j => $share_design) {
                        $cell = sprintf($fmt_td['attr'], 'th',
                            "colspan='2' style='text-align: center'", $share_design);
                        $cells_head_1 = $cells_head_1 . $cell;

                        $cell = sprintf($fmt_td['show'], 'th', "", '完成品');
                        $cells_head_2 = $cells_head_2 . $cell;

                        $cell = sprintf($fmt_td['show'], 'th', "", '出库');
                        $cells_head_2 = $cells_head_2 . $cell;
                    }
                } else {
                    $cell = sprintf($fmt_td['attr'], 'th',
                        "colspan='4' style='text-align: center'", $design[0]);
                    $cells_head_1 = $cells_head_1 . $cell;

                    $cell = sprintf($fmt_td['show'], 'th', "", '完成品');
                    $cells_head_2 = $cells_head_2 . $cell;

                    $cell = sprintf($fmt_td['show'], 'th', "", '出库');
                    $cells_head_2 = $cells_head_2 . $cell;
                }

                $cell = sprintf($fmt_td['attr'], 'th',
                    "rowspan='2'", '现在库存');
                $cells_head_1 = $cells_head_1 . $cell;

                $tr1 = sprintf($fmt_tr, $cells_head_1);
                $tr2 = sprintf($fmt_tr, $cells_head_2);
                $thead = sprintf($fmt_row, 'thead', 'none', $tr1 . $tr2);
            }

            // item 이름
            $cell = sprintf($fmt_td['show'], 'td', "", $item);
            $cells_body = $cell;
            
            // 기초재고
            $cond = makeCondition(array(
                'class'     => $clsA,
                'item'      => $item,
                'design'    => $design[0]
            ));
            $sql = sprintf($sql_search_one, 'qty', 'stock', $cond);

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $bas = mysqli_fetch_array($res)[0];

            } else {
                $bas = 0;
            }
            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $bas);
            $cells_body = $cells_body . $cell;
            
            // 원자재 입고
            $cond = makeCondition(array(
                'class'     => $clsB,
                'item'      => $item,
                'design'    => $design[0]
            ));
            $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $mat = mysqli_fetch_array($res)[0];
            } else {
                $mat = 0;
            }
            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $mat);
            $cells_body = $cells_body . $cell;
            
            // 포장물 재고 계산 로직
            if ($design[0] == 'green共用' || $design[0] == 'bon&heim共用') {
                $temp = array();
                foreach ($share[$design[0]] as $j => $share_design) {
                    // 완성품 출고
                    $cond = makeCondition(array(
                        'class'     => '完成品',
                        'item'      => $item,
                        'design'    => $share_design
                    ));
                    $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);

                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                        $qty = mysqli_fetch_array($res)[0];
                    } else {
                        $qty = 0;
                    }
                    $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $qty);
                    $cells_body = $cells_body . $cell;

                    // 포장율
                    $cond = makeCondition(array(
                        'item'      => $item,
                        'design'    => $share_design,
                        'class'     => $clsB
                    ));
                    $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);
                    $output = mysqli_query($conn, $sql);
                    $rate = mysqli_fetch_array($output);
                    $carton = intval($qty) * intval($rate[0]);
                    array_push($temp, $carton);

                    if ($carton >= 0) {
                        $cell = sprintf($fmt_td['attr'], 'td', 'style=\'text-align: right\'', $carton);
                    } else {
                        $cell = sprintf($fmt_td['alert'], 'td', '', $carton);
                    }
                    $cells_body = $cells_body . $cell;
                }
                $sub = array_sum($temp);
            } 
            // 차이허 계산 로직
            else {
                // 완성품 출고
                $cond = makeCondition(array(
                    'class'     => '完成品',
                    'item'      => $item,
                    'design'    => $design[0]
                ));
                $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);

                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $qty = mysqli_fetch_array($res)[0];
                } else {
                    $qty = 0;
                }
                $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $qty);
                $cells_body = $cells_body . $cell;

                // 포장율 계산
                if ($title == 'baozhuang') {
                    $cond = makeCondition(array(
                        'item'      => $item,
                        'design'    => $design[0],
                        'class'     => $clsB
                    ));
                } else {
                    $cond = makeCondition(array(
                        'item'      => $item,
                        'design'    => $design[0],
                        'class'     => $clsA
                    ));
                }

                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);
                $output = mysqli_query($conn, $sql);
                $rate = mysqli_fetch_array($output);
                $sub = intval($qty) * intval($rate[0]);

                if ($sub >= 0) {
                    $cell = sprintf($fmt_td['attr'], 'td', 'style=\'text-align: right\'', $sub);
                } else {
                    $cell = sprintf($fmt_td['alert'], 'td', '', '');
                }
                $cells_body = $cells_body . $cell;

                $sub = intval($qty) * intval($rate[0]);
            }
            // 현재 재고
            $sum = (intval($bas) + intval($mat) - intval($sub));
            if ($sum == 0) {
                $sum = null;
            }
            if ($sum > 0) {
                $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $sum);
            }
            if ($sum < 0) {
                $cell = sprintf($fmt_td['alert'], 'td', "", $sum);
            }

            $cells_body = $cells_body . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }

        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate[$title].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function calcStockA($title) {
    global $conn;
    global $fmt_table;
    global $fmt_row;
    global $fmt_tr;
    global $fmt_td;
    global $sql_distinct_one;
    global $sql_search_one;
    global $translate;
    global $relation;

    $clsA = $translate[$title];
    $clsB = $relation[$title];

    $cond = makeCondition(array(
        'class' => $clsA
    ));

    $sql = sprintf($sql_distinct_one, 'item', 'stock', $cond);
    $res = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($res);

    $sql = sprintf($sql_distinct_one, 'design', 'stock', $cond);
    $res = mysqli_query($conn, $sql);
    $designs = mysqli_fetch_all($res);

    $total = "";
    foreach ($designs as $j => $design) {

        $tr = "";
        $thead = "";
        $count = 0;

        foreach ($items as $i => $item) {
            // 테이블 헤더 설정
            if ($count == 0) {
                $count++;
                $cell = sprintf($fmt_td['attr'], 'th',
                    "rowspan='2' style='text-align: center'", '');
                $cells_head = $cell;

                $cell = sprintf($fmt_td['attr'], 'th',
                    "colspan='4' style='text-align: center'", $design[0]);
                $cells_head = $cells_head . $cell;

                $row1 = sprintf($fmt_tr, $cells_head);

                $cell = sprintf($fmt_td['show'], 'th', "", '期初');
                $cells_head = $cell;

                $cell = sprintf($fmt_td['show'], 'th', "", '入库');
                $cells_head = $cells_head . $cell;

                $cell = sprintf($fmt_td['show'], 'th', "", '出库');
                $cells_head = $cells_head . $cell;

                $cell = sprintf($fmt_td['show'], 'th', "", '现在库存');
                $cells_head = $cells_head . $cell;

                $row2 = sprintf($fmt_tr, $cells_head);
                $thead = sprintf($fmt_row, 'thead', 'none', $row1 . $row2);
            }
            // 아이템 이름
            $cell = sprintf($fmt_td['show'], 'td', "", $item[0]);
            $cells_body = $cell;
            
            // 기초 재고
            $cond = makeCondition(array(
                'class'     => $clsA,
                'item'      => $item[0],
                'design'    => $design[0]
            ));
            $sql = sprintf($sql_search_one, 'qty', 'stock', $cond);

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $bas = mysqli_fetch_array($res)[0];

            } else {
                $bas = 0;
            }
            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $bas);
            $cells_body = $cells_body . $cell;
            
            // 원자재 입고
            $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $mat = mysqli_fetch_array($res)[0];
            } else {
                $mat = 0;
            }
            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $mat);
            $cells_body = $cells_body . $cell;
            
            // 원자재 출고
            $cond = makeCondition(array(
                'class'     => $clsB,
                'item'      => $item[0],
                'design'    => $design[0]
            ));
            $sql = sprintf($sql_search_one, 'sum(qty)', 'material', $cond);

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $sub = mysqli_fetch_array($res)[0];
            } else {
                $sub = 0;
            }
            $cell = sprintf($fmt_td['attr'], 'td','style=\'text-align: right\'', $sub);
            $cells_body = $cells_body . $cell;
            
            // 합계 수량
            $sum = (intval($bas) + intval($mat) - intval($sub));
            if ($sum == 0) {
                $sum = null;
            }
            if ($sum > 0) {
                $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $sum);
            }
            if ($sum < 0) {
                $cell = sprintf($fmt_td['alert'], 'td', "", $sum);
            }

            $cells_body = $cells_body . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells_body);
        }

        $tbody = sprintf($fmt_row, 'tbody', 'none', $tr);
        $total = $total . $thead . $tbody;
    }

    $new_table = sprintf($fmt_table, $translate[$title].'库存', $total);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function order() {
    global $conn;
    global $sql_search_one;
    global $sql_distinct;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $relation;
    global $btn;

    $color = random_color();

    $tname = $_POST['page'];
    $showing = $_POST['showing'];

    $sql = sprintf($sql_distinct, 'item', $tname);
    $res = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($res);

    $sql = sprintf($sql_distinct, 'design', $tname);
    $res = mysqli_query($conn, $sql);
    $designs = mysqli_fetch_all($res);

    $tr = "";

    foreach ($designs as $j => $design) {
        foreach ($items as $i => $item) {
            $cells = "";

            $key = 'item';
            $val = $showing[$key];
            $cell = sprintf($fmt_td[$val], 'td', $key, $item[0]);
            $cells = $cells . $cell;

            $key = 'design';
            $cell = sprintf($fmt_td[$val], 'td', $key, $design[0]);
            $cells = $cells . $cell;

            $key = 'qty';
            $sql = sprintf($sql_search_one, 'sum(qty)', $tname,
                makeCondition(array('item'=>$item[0], 'design'=>$design[0])));

            $sum = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
            if ($sum == null) {
                $sum = 0;
            }
            
            // 인박스 수량 계산
            $cond = makeCondition(array(
                'item' => $item[0],
                'design' => $design[0],
                'class' => '白瓷'
            ));
            $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

            $output = mysqli_query($conn, $sql);
            $rate = mysqli_fetch_array($output)[0];

            $carton = intval($sum) * intval($rate[0]);
            if ($carton > 0) {
                $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $carton);
            } else {
                $cell = sprintf($fmt_td['alert'], 'td', $key, $carton);
            }
            $cells = $cells . $cell;

            // baici 재고
            $key = 'baici';
            $val = $showing[$key];
            $qty = calcByItem($translate[$key], $relation[$key], $item[0]);

            $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qty);
            $cells = $cells . $cell;

            // huazhi 재고
            $key = 'huazhi';
            $val = $showing[$key];
            $qty = calcByItemDesign($translate[$key], $relation[$key], $item[0], $design[0]);

            $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qty);
            $cells = $cells . $cell;
            
            // chengpin 재고
            $key = 'chengpin';
            $val = $showing[$key];
            $qty = calcByItemDesign($translate[$key], $relation[$key], $item[0], $design[0]);

            $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $qty);
            $cells = $cells . $cell;
            
            // 발주버튼
            $key = 'order';
            $val = $showing[$key];
            $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            $cells = $cells . $cell;

            $tr = $tr . sprintf($fmt_tr, $cells);
        }
    }
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);

    $cells = "";
    foreach ($showing as $key => $val) {
        $cell = sprintf($fmt_td[$val], 'th', $key, $translate[$key]);
        $cells = $cells . $cell;
    }
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

    $new_table = sprintf($fmt_table, '', $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function search() {
    global $conn;
    global $sql_search_all;
    global $sql_search_con;
    global $sql_search_one;

    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    global $translate;
    global $btn;

    $color = random_color();

    $tname = $_POST['page'];
    $showing = $_POST['showing'];

    $condition = makeCondition($_POST);

    if ($condition == '整体搜索') {
        $sql = sprintf($sql_search_all, $tname);
    } else {
        $sql = sprintf($sql_search_con, $tname, $condition);
    }
    $res = mysqli_query($conn, $sql);

    $sum = 0.;

    $tr = "";
    while ($row = mysqli_fetch_array($res)) {
        $cells = "";
        foreach ($showing as $key => $val) {
            if ($key == 'edit' || $key == 'del' || $key == 'order') {
                $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            }

            else if ($tname == 'custom' && $key == 'qty') {

                $cond = makeCondition(array(
                    'item' => $row['item'],
                    'design' => $row['design'],
                    'class' => '白瓷'
                ));
                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

                $output = mysqli_query($conn, $sql);
                $rate = mysqli_fetch_array($output);

                if ($rate) {
                    $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", intval($row[$key]) * intval($rate['rate']));
                } else {
                    $cell = sprintf($fmt_td['alert'], 'td', $key, intval($row[$key]));
                }
            }

            else if (($tname == 'material') && ($key == 'total' || $key == 'price')) {
                $cond = makeCondition(array(
                    'supplier'  => $row['supplier'],
                    'item'      => $row['item'],
                    'design'    => $row['design'],
                    'class'     => $row['class']
                ));
                $sql = sprintf($sql_search_one, 'price', 'price', $cond);
                $output = mysqli_query($conn, $sql);
                $price = mysqli_fetch_array($output);

                if ($key == 'total') {
                    if ($price) {
                        $result = floatval($row['qty']) * floatval($price[0]);
                        $sum += $result;
                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $result);
                    } else {
                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
                    }
                }
                if ($key == 'price') {
                    if ($price) {
                        $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", $price[0]);
                    } else {
                        $cell = sprintf($fmt_td['alert'], 'td', $key, '');
                    }
                }
            }

            else {
                $cell = sprintf($fmt_td[$val], 'td', $key, $row[$key]);
            }
            $cells = $cells . $cell;
        }
        $tr = $tr . sprintf($fmt_tr, $cells);
    }
    $tbody = sprintf($fmt_row, 'tbody', $color, $tr);
    
    // 테이블 헤더 부분
    $cells = "";
    foreach ($showing as $key => $val) {
        $cell = sprintf($fmt_td[$val], 'th', $key, $translate[$key]);
        $cells = $cells . $cell;
    }
    $tr = sprintf($fmt_tr, $cells);
    $thead = sprintf($fmt_row, 'thead', $color, $tr);

    if ($_POST['msg'] == 'payment') {
        $condition = "整体合计 = $sum";
    }

    $new_table = sprintf($fmt_table, $condition, $thead . $tbody);
    echo "<script type='text/html' id='temp_page'>$new_table</script>";
}

function getList($post_data) : array {
    $save_list = array();
    foreach ($post_data as $key => $val) {
        if ($key != 'msg' &&
            $key != 'page' &&
            $key != 'showing') {
            $save_list[$key] = $val;
        }
    }
    return $save_list;
}

function save() {
    global $conn;
    global $sql_insert;
    global $sql_search_one;

    global $fmt_td;
    global $fmt_tr;
    global $btn;

    $tname = $_POST['page'];
    $showing = $_POST['showing'];
    $save_list = getList($_POST);

    $src = '';
    $dest = '';
    foreach ($save_list as $key => $val) {
        if ($key != 'no') {
            $src = $src . "'$val'". ', ';
            $dest = $dest . $key. ', ';
        }
    }
    $src = substr($src, 0, -2);
    $dest = substr($dest, 0, -2);

    $sql = sprintf($sql_insert, $tname, $dest, $src);
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT LAST_INSERT_ID()";
        $no = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        $idx = $showing['no'];
        $cells = sprintf($fmt_td[$idx], 'no', $no);

        foreach ($showing as $key => $val) {
            if ($key == 'edit' || $key == 'del' || $key == 'order') {
                $cell = sprintf($fmt_td[$val], 'td', $key, $btn[$key]);
            } else if ($tname == 'custom' && $key == 'qty') {

                $cond = makeCondition(array(
                    'item' => $_POST['item'],
                    'design' => $_POST['design'],
                    'class' => '白瓷'
                ));
                $sql = sprintf($sql_search_one, 'rate', 'shipping', $cond);

                $output = mysqli_query($conn, $sql);
                $rate = mysqli_fetch_array($output);

                if ($rate) {
                    $cell = sprintf($fmt_td['attr'], 'td', "style='text-align: right'", intval($_POST[$key]) * intval($rate['rate']));
                } else {
                    $cell = sprintf($fmt_td['alert'], 'td', $key, intval($_POST[$key]));
                }
            } else {
                $cell = sprintf($fmt_td[$val], 'td', $key, $_POST[$key]);
            }
            $cells = $cells . $cell;
        }

        $tr = sprintf($fmt_tr, $cells);
        echo "<script type='text/html' id='temp_row'>$tr</script>";
    }
}

function update() {
    global $conn;
    global $sql_update;

    $update_list = getList($_POST);
    $set = "";
    $where = "no = ";
    foreach ($update_list as $key => $val) {
        if ($key == 'no') {
            $where = $where . "$val";
        } else {
            $set = $set . $key . "='$val',";
        }
    }
    $set = substr($set, 0, -1);
    $sql = sprintf($sql_update, $_POST['page'], $set, $where);

    echo mysqli_query($conn, $sql);
}

function del() {
    global $conn;
    global $sql_delete;
    $sql = sprintf($sql_delete, $_POST['page'], $_POST['no']);
    echo mysqli_query($conn, $sql);
}

function updateDatalist($kind, $where) {
    global $conn;
    $sql = "SELECT DISTINCT {$kind} FROM $where";
    $res = mysqli_query( $conn, $sql );

    $options = "";
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row[$kind]);
        $options =  $options. "<option value='$var'>";
    }

    echo "<script type='text/html' id='temp_option'>$options</script>";
}
?>