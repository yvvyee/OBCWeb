<?php
include_once 'globals.php';
include_once 'table_basic.php';
include_once 'table_typeA.php';
include_once 'table_typeB.php';
include_once 'table_typeC.php';
include_once 'table_typeD.php';
include_once 'table_payment.php';
include_once 'order_baici.php';
include_once 'order_caihe.php';
include_once 'order_huazhi.php';
include_once 'order_custom.php';
if(!isset($_SESSION['user_id'])) {
    echo "<script> window.location = 'login.php'; </script>";
}
if (array_key_exists('msg', $_POST)) {
    if ($_POST['msg'] == 'setInput') {
        set_input_form();
    }
    if ($_POST['msg'] == 'search') {
        search();
    }
    if ($_POST['msg'] == 'save' || $_POST['msg'] == 'ordering') {
        save();
    }
    if ($_POST['msg'] == 'stock') {
        if ($_POST['title'] == '白瓷') {
            stockA();
        }
        if ($_POST['title'] == '花纸') {
            stockB('huazhi');
        }
        if ($_POST['title'] == '完成品') {
            stockB('chengpin');
        }
        if ($_POST['title'] == '包装物') {
            stockC();
        }
        if ($_POST['title'] == '彩瓷') {
            stockD();
        }
    }
    if ($_POST['msg'] == 'payment') {
        searchPayment();
    }
    if ($_POST['msg'] == 'orderBaici') {
        orderBaici();
    }
    if ($_POST['msg'] == 'orderCaihe') {
        orderCaihe();
    }
    if ($_POST['msg'] == 'orderHuazhi') {
        orderHuazhi();
    }
    if ($_POST['msg'] == 'orderCustom') {
        orderCustom();
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
        global $conn;

        $sql = "SELECT TABLE_NAME 
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_TYPE = 'BASE TABLE' 
                AND TABLE_SCHEMA='outlook_bone_china';";
        $tables = mysqli_query($conn, $sql);

        $sql = "";
        while ($tname = mysqli_fetch_array($tables)) {
            if ($tname[0] == 'user') {
                continue;
            } else {
                $sql .= "SET @CNT = 0; UPDATE $tname[0] SET $tname[0].no = @CNT:=@CNT+1;";
            }
        }
        // 모든 테이블의 no 컬럼 재정렬
        $res = mysqli_multi_query($conn, $sql);
        // 세션 초기화
        session_destroy();
    }
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
