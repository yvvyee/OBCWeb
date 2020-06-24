<?php
include_once 'globals.php';
include_once 'table_basic.php';

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('请重新登录'); window.location = '../../login.php'; </script>";
}


if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'setInput') {
        set_input_form();
    }
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

function set_input_form() {
    global $fmt_input;
    global $input_list;
    global $input_type;
    global $translate;
    global $conn;

    $sql = "SELECT * FROM datalist ORDER BY seq";
    $res = mysqli_query( $conn, $sql );
    $datalist = mysqli_fetch_all($res);

    $page = $_POST['page'];

    $input_form = '';
    foreach ($input_list[$page] as $i => $name) {
        $id = $page . '_' . $name;

        if ($name == 'no') {
            $temp = sprintf($fmt_input, $id, $name, $input_type[$name], $translate[$name], 'display: none', '');
        } else {
            $options = '';
            if ($name == 'orderno') {
                $sql = "SELECT DISTINCT orderno FROM $page";
                $res = mysqli_query( $conn, $sql );
                $orderno = mysqli_fetch_all($res);
                foreach ($orderno as $str) {
                    $var = htmlentities($str[0]);
                    $options =  $options. "<option value='$var'>";
                }
            } else {
                foreach ($datalist as $row) {
                    if ($row[2] == $name) {
                        if ($row[4] == '') {
                            $var = htmlentities($row[1]);
                            $options =  $options. "<option value='$var'>";
                        } else {
                            if ($row[4] == $page) {
                                $var = htmlentities($row[1]);
                                $options =  $options. "<option value='$var'>";
                            }
                        }
                    }
                }
            }
            $temp = sprintf($fmt_input, $id, $name, $input_type[$name], $translate[$name], '', $options);
        }
        $input_form = $input_form . $temp;
    }

    echo "<script type='text/html' id='temp_page'>$input_form</script>";
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
    
    // TODO: 삭제하고 DB에서 가져올 것
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
    # mysql
    global $conn;
    global $sql_search_one;
    global $sql_distinct;
    # 테이블 포맷
    global $fmt_btn;
    global $fmt_td;
    global $fmt_tr;
    global $fmt_row;
    global $fmt_table;
    # 문자열 치환
    global $translate;
    global $relation;

    $color = random_color();
    
    $tname = $_POST['page'];        # 페이지명 = 테이블명
    $showing = $_POST['showing'];   # 컬럼 visualization 태그
    
    // custom 테이블의 모든 item
    $sql = sprintf($sql_distinct, 'item', $tname);
    $res = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($res);
    
    // custom 테이블의 모든 deisgn
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
            
            // 인박스 수량 계산 carton x packing rate
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
            $cell = sprintf($fmt_td[$val], 'td', $key, $fmt_btn[$key]);
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
