<?php
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

$fmt_btn = array(
    'edit'  => '<button name=\'edit\' class=\'btn-success\' onclick=\'displayRow(this); return false;\'>E</button></td>',
    'del'   => '<button name=\'del\' class=\'btn-danger\' onclick=\'submit_basic(this); return false;\'>D</button></td>',
    'order' => '<button name=\'order\' class=\'btn-dark\' onclick=\'submit_basic(this); return false;\' data-toggle="modal" data-target="#order_form" style="background-color: #993366">O</button></td>'
);

$fmt_input = '<div class="center" id="div_%1$s">
                <label for="ibox_%1$s">
                    <input class="input_box"
                           type="%3$s"
                           name="%2$s"
                           id="%1$s"
                           list="%1$s_list"
                           placeholder="%4$s"
                           autocomplete="off"
                           ondblclick="$(this).val(\'\');"
                           style="font-size: 16pt; text-align: center; font-family: 微软雅黑; min-width: 247px; height: 41px; %5$s">
                </label>
                <datalist id="%1$s_list">
                    %6$s
                </datalist>
            </div>';

$input_list = array(
    'custom'    => ['no', 'date', 'customer', 'item', 'design', 'qty', 'orderno'],
    'ordering'  => ['no', 'date', 'supplier', 'item', 'design', 'qty', 'orderno', 'class'],
    'material'  => ['no', 'date', 'supplier', 'item', 'design', 'qty', 'month', 'class', 'worker'],
    'payment'   => ['month', 'supplier'],
    'price'     => ['no', 'supplier', 'item', 'design', 'price', 'class'],
    'shipping'  => ['no', 'customer', 'item', 'design', 'class', 'rate', 'price', 'worker'],
    'stock'     => ['no', 'item', 'design', 'qty', 'class'],
    'datalist'  => ['no', 'name', 'kind', 'seq', 'sep']
);

$input_type = array(
    'no'        => 'text',
    'date'      => 'date',
    'customer'  => 'text',
    'item'      => 'text',
    'design'    => 'text',
    'qty'       => 'number',
    'orderno'   => 'text',
    'supplier'  => 'text',
    'month'     => 'text',
    'class'     => 'text',
    'worker'    => 'text',
    'price'     => 'number',
    'rate'      => 'number',
    'name'      => 'text',
    'kind'      => 'text',
    'seq'       => 'number',
    'sep'       => 'text'
);

$translate = array(
    'no'        => 'no',
    'date'      => '日期',
    'supplier'  => '企业',
    'customer'  => '客户',
    'item'      => '品名',
    'design'    => '花面',
    'qty'       => '数量',
    'carton'    => '纸箱',
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
    'caici'     => '彩瓷',
    'name'      => '名称',
    'kind'      => '种类',
    'seq'       => '顺序',
    'sep'       => '页面'
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
?>