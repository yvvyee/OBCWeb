<?php
//session_start();
//if(!isset($_SESSION['user_id'])) {
//    echo "<script>alert('세션이 만료되었습니다.'); window.location = './login.php'; </script>";
//}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>OBC-Web</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        @media (min-width: 126px)
        .custom_container {
            background: none;
            max-width: 100px;
            margin-right: 3%;
            margin-left: 3%;
            top: 10%;
        }
        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
        }




            /* Standard Tables */

            table {
                margin: 1em 0;
                border-collapse: collapse;
                /*border: 0.1em solid #d6d6d6;*/
                border: none;
            }

            caption {
                text-align: left;
                font-style: italic;
                padding: 0.25em 0.5em 0.5em 0.5em;
            }

            th,
            td {
                padding: 0.25em 0.5em 0.25em 1em;
                vertical-align: text-top;
                text-align: left;
                text-indent: -0.5em;
            }

            th {
                vertical-align: bottom;
                /*background-color: #666;*/
                color: #fff;
            }

            tr:nth-child(even) th[scope=row] {
                /*background-color: #f2f2f2;*/
                background-color: rgba(0, 0, 0, 0.05);
            }

            tr:nth-child(odd) th[scope=row] {
                /*background-color: #fff;*/
                background-color: rgba(255, 255, 255, 0.05);
            }

            tr:nth-child(even) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            tr:nth-child(odd) {
                background-color: rgba(255, 255, 255, 0.05);
                /*background-color: transparent;*/
            }

            td:nth-of-type(2) {
                font-style: italic;
            }

            th:nth-of-type(3),
            td:nth-of-type(3) {
                text-align: right;
            }

            /* Fixed Headers */

            th {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 2;
            }

            th[scope=row] {
                position: -webkit-sticky;
                position: sticky;
                left: 0;
                z-index: 1;
            }

            th[scope=row] {
                vertical-align: top;
                color: inherit;
                background-color: transparent;
                /*background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);*/
            }

            th:not([scope=row]):first-child {
                left: 0;
                z-index: 3;
                /*background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);*/
                background-color: transparent;
            }

            /* Scrolling wrapper */

            div[tabindex="0"][aria-labelledby][role="region"] {
                overflow: auto;
            }

            div[tabindex="0"][aria-labelledby][role="region"]:focus {
                box-shadow: 0 0 .5em rgba(0,0,0,.5);
                outline: .1em solid rgba(0,0,0,.1);
            }

            div[tabindex="0"][aria-labelledby][role="region"] table {
                margin: 0;
            }

            div[tabindex="0"][aria-labelledby][role="region"].rowheaders {
                /*background:*/
                /*    linear-gradient(to right, transparent 30%, rgba(255,255,255,0)),*/
                /*    linear-gradient(to right, rgba(255,255,255,0), white 70%) 0 100%,*/
                /*    radial-gradient(farthest-side at 0% 50%, rgba(0,0,0,0.2), rgba(0,0,0,0)),*/
                /*    radial-gradient(farthest-side at 100% 50%, rgba(0,0,0,0.2), rgba(0,0,0,0)) 0 100%;*/
                background-repeat: no-repeat;
                background-color: transparent;
                background-size: 4em 100%, 4em 100%, 1.4em 100%, 1.4em 100%;
                background-position: 0 0, 100%, 0 0, 100%;
                background-attachment: local, local, scroll, scroll;
            }

            div[tabindex="0"][aria-labelledby][role="region"].colheaders {
                /*background:*/
                /*        linear-gradient(white 30%, rgba(255,255,255,0)),*/
                /*        linear-gradient(rgba(255,255,255,0), white 70%) 0 100%,*/
                /*        radial-gradient(farthest-side at 50% 0, rgba(0,0,0,.2), rgba(0,0,0,0)),*/
                /*        radial-gradient(farthest-side at 50% 100%, rgba(0,0,0,.2), rgba(0,0,0,0)) 0 100%;*/
                background-repeat: no-repeat;
                background-color: transparent;
                /*background-size: 100% 4em, 100% 4em, 100% 1.4em, 100% 1.4em;*/
                background-attachment: local, local, scroll, scroll;
            }

            /* Strictly for making the scrolling happen. */

            th[scope=row] {
                min-width: 40vw;
            }

            @media all and (min-width: 30px) {
                th[scope=row] {
                    min-width: 20px;
                }
            }

            th[scope=row] + td {
                min-width: 24px;
            }

            div[tabindex="0"][aria-labelledby][role="region"]:nth-child(3) {
                max-height: 18px;
            }

            div[tabindex="0"][aria-labelledby][role="region"]:nth-child(7) {
                max-height: 15px;
                margin: 0 1px;
            }
    </style>

    <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
<!--            <h1><a>Main</a></h1>-->
             <a href="#intro"><img src="img/logo.png" alt="" title="OBC" width="30%"></a>
        </div>
        <!--==========================
          상단 메뉴
        ============================-->
        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="./login.php"><input type="button" class="btn-danger" value="Logout" onclick="<?php session_destroy(); ?>" /></a></li>
                <li><a href="material.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>원자재입력</br></a></li>
                <li><a href="basic_stock.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>기본재고입력</br></a></li>
                <li><a href="stock.php"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>재고생성</a></li>
                <li><a href="#order"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>材料订货</a></li>
                <li><a href="#check"><input type="image" src="img/icon/HOME.png" alt="submit" style="width: 35px"><br>入库对账</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header>

<section id="intro">
    <section id=""
        <div class="custom_container">
            <div role="region" aria-labelledby="HeadersCol" tabindex="0" class="rowheaders">
                <table>
                    <caption id="HeadersCol">Books with a Fixed Row Header Column</caption>
                    <thead>

<!--                    <tr>-->
<!--                        <th>No</th>-->
<!--                        <th>Date</th>-->
<!--                        <th>Supplier</th>-->
<!--                        <th>Item</th>-->
<!--                        <th>Design</th>-->
<!--                        <th>Qty</th>-->
<!--                        <th>Month</th>-->
<!--                        <th>Class</th>-->
<!--                        <th>Worker</th>-->
<!--                        <th></th>-->
<!--                    </tr>-->
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">No</th>
                        <td>The Ingenious Gentleman Don Quixote of La Mancha</td>
                        <td>1605</td>
                        <td>9783125798502</td>
                        <td>3125798507</td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td>La Belle et la Bête</td>
                        <td>1740</td>
                        <td>9781910880067</td>
                        <td>191088006X</td>
                    </tr>
                    <tr>
                        <th scope="row">Supplier</th>
                        <td>The Method of Fluxions and Infinite Series: With Its Application to the Geometry of Curve-lines</td>
                        <td>1763</td>
                        <td>9781330454862</td>
                        <td>1330454863</td>
                    </tr>
                    <tr>
                        <th scope="row">Item</th>
                        <td>Frankenstein; or, The Modern Prometheus</td>
                        <td>1818</td>
                        <td>9781530278442</td>
                        <td>1530278449</td>
                    </tr>
                    <tr>
                        <th scope="row">Design</th>
                        <td>Moby-Dick; or, The Whale</td>
                        <td>1851</td>
                        <td>9781530697908</td>
                        <td>1530697905</td>
                    </tr>
                    <tr>
                        <th scope="row">Qty</th>
                        <td>The Hidden Hand</td>
                        <td>1888</td>
                        <td>9780813512969</td>
                        <td>0813512964</td>
                    </tr>
                    <tr>
                        <th scope="row">Month</th>
                        <td>The Great Gatsby</td>
                        <td>1925</td>
                        <td>9780743273565</td>
                        <td>0743273567</td>
                    </tr>
                    <tr>
                        <th scope="row">Class</th>
                        <td>Nineteen Eighty-Four</td>
                        <td>1948</td>
                        <td>9780451524935</td>
                        <td>0451524934</td>
                    </tr>
                    <tr>
                        <th scope="row">Worker</th>
                        <td>Who Fears Death</td>
                        <td>2010</td>
                        <td>9780756406691</td>
                        <td>0756406692</td>
                    </tr>
                    <tr>
                        <th scope="row">Button</th>
                        <td>Who Fears Death</td>
                        <td>2010</td>
                        <td>9780756406691</td>
                        <td>0756406692</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>



<!--    <div class="tb_wrap">-->
<!--        <div class="tb_box">-->
<!--            <table class="tb">-->
<!--                <caption>교육센터 강좌 목록</caption>-->
<!--                <tr class="fixed_top">-->
<!--                    <th class="cell1 cross" scope="col">강좌 명</th>-->
<!--                    <th class="cell2" scope="col">강사</th>-->
<!--                    <th class="cell3" scope="col">진행기간</th>-->
<!--                    <th class="cell4" scope="col">신청현황</th>-->
<!--                    <th class="cell5" scope="col">비고</th>-->
<!--                    <th class="cell6" scope="col">상태</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">농구</th>-->
<!--                    <td class="cell2">마이클 조던</td>-->
<!--                    <td class="cell3">2020.04~2020.06 (3개월)</td>-->
<!--                    <td class="cell4">27/40</td>-->
<!--                    <td class="cell5">우천 시 실내진행</td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">축구</th>-->
<!--                    <td class="cell2">제라드</td>-->
<!--                    <td class="cell3">2020.04~2020.06 (3개월)</td>-->
<!--                    <td class="cell4">33/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">축구Ⅱ</th>-->
<!--                    <td class="cell2">메시</td>-->
<!--                    <td class="cell3">2020.04~2020.06 (3개월)</td>-->
<!--                    <td class="cell4">7/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr class="end">-->
<!--                    <th class="cell1 fixed_col" scope="row">축구Ⅲ</th>-->
<!--                    <td class="cell2">찰리 아담</td>-->
<!--                    <td class="cell3">2020.04~2020.06 (3개월)</td>-->
<!--                    <td class="cell4">40/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">마감</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">야구</th>-->
<!--                    <td class="cell2">데릭 지터</td>-->
<!--                    <td class="cell3">2020.09~2020.10 (2개월)</td>-->
<!--                    <td class="cell4">29/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">바둑</th>-->
<!--                    <td class="cell2">이세돌</td>-->
<!--                    <td class="cell3">2020.01~2020.03 (3개월)</td>-->
<!--                    <td class="cell4">38/40</td>-->
<!--                    <td class="cell5">알파고 강사님으로 변경될 수 있습니다.</td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr class="end">-->
<!--                    <th class="cell1 fixed_col" scope="row">영화감상</th>-->
<!--                    <td class="cell2">쿠엔틴 타란티노</td>-->
<!--                    <td class="cell3">2020.01~2020.02 (2개월)</td>-->
<!--                    <td class="cell4">40/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">마감</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="cell1 fixed_col" scope="row">종합격투기</th>-->
<!--                    <td class="cell2">크로캅</td>-->
<!--                    <td class="cell3">2020.03~2020.07 (5개월)</td>-->
<!--                    <td class="cell4">13/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">신청 가능</td>-->
<!--                </tr>-->
<!--                <tr class="end">-->
<!--                    <th class="cell1 fixed_col" scope="row">서핑</th>-->
<!--                    <td class="cell2">외부강사</td>-->
<!--                    <td class="cell3">2020.07~2020.08 (2개월)</td>-->
<!--                    <td class="cell4">40/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">마감</td>-->
<!--                </tr>-->
<!--                <tr class="end">-->
<!--                    <th class="cell1 fixed_col" scope="row">스키</th>-->
<!--                    <td class="cell2">외부강사</td>-->
<!--                    <td class="cell3">2020.12~2021.01 (2개월)</td>-->
<!--                    <td class="cell4">40/40</td>-->
<!--                    <td class="cell5"></td>-->
<!--                    <td class="cell6">마감</td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->


    <!--    <div class="tb_wrap">-->
<!--        <div class="intro-text custom_container tb_box" style="overflow-x: scroll; height: auto; margin-top: 10%">-->
<!--            <table id="tb" style="color: white; text-align: right; font-size: 25px">-->
<!--                <thead>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">No : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Date : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Supp : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Item : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Design : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Qty : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Month : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Class : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Worker : </th></tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <th class="fixed-col" colspan="10">Erase : </th></tr>-->
<!--                </thead>-->
<!--                <tbody id="mat_tbody" class="dynamics">-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                    <td>test1</td>-->
<!--                </tr>-->
<!--                <tr style="border-bottom: 1px dotted silver">-->
<!--                    <td><input type="submit" class="btn-success" style="font-size: 10px" value="삭제"></td>-->
<!--                    <td><input type="submit" class="btn-success" style="font-size: 10px" value="삭제"></td>-->
<!--                    <td><input type="submit" class="btn-success" style="font-size: 10px" value="삭제"></td>-->
<!--                    <td><input type="submit" class="btn-success" style="font-size: 10px" value="삭제"></td>-->
<!--                    <td><input type="submit" class="btn-success" style="font-size: 10px" value="삭제"></td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->



            <div id="input_form" class="modal fade" style="display: none">
                <form method="post" >
                    <div class="modal-dialog">
                        <div  class="intro-text modal-content" style="background: none; width: 180px; height: auto; border-width: 0px; margin-left: auto; margin-right: auto" >
                            <!--==========================
                              Date
                            ============================-->
                            <div>
                                <label for="ibox_date">
                                    <input type="date"
                                           id="ibox_date"
                                           name="ibox_date"
                                           placeholder="Date"
                                           style="width: 162px; height: 33px"
                                           value="<?php
                                           if (isset($_POST['ibox_date'])) {
                                               echo htmlentities($_POST['ibox_date']);
                                           }
                                           ?>">
                                </label>
                            </div>
                            <!--==========================
                              Supplier
                            ============================-->
                            <div>
                                <label for="ibox_supplier">
                                    <input type="text"
                                           name="ibox_supplier"
                                           id="ibox_supplier"
                                           list="supplier_list"
                                           placeholder="Supplier"
                                           autocomplete="off"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_supplier'])) {
                                               echo htmlentities($_POST['ibox_supplier']);
                                           } ?>">
                                </label>
                                <datalist id="supplier_list">
                                    <?php echo update('supplier'); ?>
                                </datalist>
                            </div>
                            <!--==========================
                              Item
                            ============================-->
                            <div>
                                <label for="ibox_item">
                                    <input type="text"
                                           name="ibox_item"
                                           id="ibox_item"
                                           list="item_list"
                                           placeholder="Item"
                                           autocomplete="off"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_item'])) {
                                               echo htmlentities($_POST['ibox_item']);
                                           } ?>">
                                </label>
                                <datalist id="item_list">
                                    <?php echo update('item'); ?>
                                </datalist>
                            </div>
                            <!--==========================
                              Design
                            ============================-->
                            <div>
                                <label for="ibox_design">
                                    <input type="text"
                                           name="ibox_design"
                                           id="ibox_design"
                                           list="design_list"
                                           placeholder="Design"
                                           autocomplete="off"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_design'])) {
                                               echo htmlentities($_POST['ibox_design']);
                                           } ?>">
                                </label>
                                <datalist id="design_list">
                                    <?php echo update('design'); ?>
                            </div>
                            <!--==========================
                              Quantity
                            ============================-->
                            <div>
                                <label for="ibox_qty">
                                    <input type="number"
                                           name="ibox_qty"
                                           id="ibox_qty"
                                           placeholder="Qty"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_qty'])) {
                                               echo htmlentities($_POST['ibox_qty']);
                                           } ?>">
                                </label>
                            </div>
                            <!--==========================
                              Month
                            ============================-->
                            <div>
                                <label for="ibox_month">
                                    <input type="number"
                                           name="ibox_month"
                                           id="ibox_month"
                                           placeholder="Month"
                                           min="0"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_month'])) {
                                               echo htmlentities($_POST['ibox_month']);
                                           } ?>">
                                </label>
                            </div>
                            <!--==========================
                              Class
                            ============================-->
                            <div>
                                <label for="ibox_class">
                                    <input type="text"
                                           name="ibox_class"
                                           id="ibox_class"
                                           list="class_list"
                                           placeholder="Class"
                                           autocomplete="off"
                                           style="width: 162px"
                                           value="<?php
                                           if (isset($_POST['ibox_class'])) {
                                               echo htmlentities($_POST['ibox_class']);
                                           } ?>">
                                </label>
                                <datalist id="class_list">
                                    <?php echo update('class'); ?>
                                </datalist>
                            </div>
                            <a href="#material_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('material_view')"><i class="fa fa-link"></i>보기
                            </a>
                            <input type="submit" name="show_all" class="btn-get-started scrollto" value="전체검색" style="background: none; outline: none">
                            <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="저장">


                            <!--==========================
                              Buttons onclick="showMaterial('material')"
                            ============================-->
                            <!--                    <div>-->
                            <!--                        <a href="#material_view" class="btn-get-started btn-info scrollto" style="outline: none" onclick="showMaterial('material_view')"><i class="fa fa-link"></i>보기-->
                            <!--                        </a>-->
                            <!--                        <input type="submit" name="show_all" class="btn-get-started scrollto" value="전체검색" style="background: none; outline: none">-->
                            <!--                        <input type="submit" name="show_cond" class="btn-get-started scrollto" value="조건부검색" style="background: none; outline: none">-->
                            <!--                        <input type="submit" name="save_material" class="btn-get-started" style="background: none; outline: none" value="저장">-->
                            <!--                    </div>-->

                            <!--                    <button class="btn-get-started open-button" onclick="openForm()">　</button>-->
                            <!--                    <div class="form-popup" id="myForm">-->
                            <!--                        <form action="/action_page.php" class="form-container">-->
                            <!--                            <h1>Login</h1>-->
                            <!---->
                            <!--                            <label for="email"><b>Email</b></label>-->
                            <!--                            <input type="text" placeholder="Enter Email" name="email" required>-->
                            <!---->
                            <!--                            <label for="psw"><b>Password</b></label>-->
                            <!--                            <input type="password" placeholder="Enter Password" name="psw" required>-->
                            <!---->
                            <!--                            <button type="submit" class="btn">Login</button>-->
                            <!--                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>-->
                            <!--                        </form>-->
                            <!--                    </div>-->
                        </div>
                    </div>
                </form>
            </div>

            <button class="btn-get-started open-button" style="outline: none" data-toggle="modal" data-target="#input_form" onclick="openForm()">열기</button>

    </section>

<script>
    function openForm() {
        document.getElementById("input_form").style.display = "block";
    }

    function closeForm() {
        document.getElementById("input_form").style.display = "none";
    }

    $(function(){
        fixTh();

        $(window).on('resize',function(){
            fixTh();
        });
    });

    function fixTh () {
        if ($(window).width() < 1000) {
            $('.tb_box').on('scroll',function(){
                var tbBox = $('.tb_box');
                var th1 = $('.tb_box tr:nth-child(1) th:nth-child(1)')
                var th2 = $('.tb_box tr:nth-child(1) th:nth-child(2)');
                var td1 = $('.tb_box tr:nth-child(n+2) th')
                var td2 = $('.tb_box td:nth-child(2)')
                var scrLeft = tbBox.scrollLeft();
                var fixLeft = tbBox.offset().left;

                tbBox.find('tr:nth-child(1)').css({
                    'transform' : 'translateX(' + - scrLeft + 'px)'
                });

                if ($(this).scrollLeft() > 0) {
                    th1.offset({
                        'left':fixLeft
                    });
                    th2.css({
                        'margin-left': -scrLeft
                    });
                    td1.offset({
                        'left':fixLeft
                    });
                    td2.css({
                        'margin-left': -scrLeft
                    });
                } else {
                    th1.css({
                        'left': 0
                    });
                    td1.css({
                        'left':0
                    });
                }
            });
        }
    };
</script>

<!--==========================
  Showing table
============================-->
<script>
    function showMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "block";
    }
    function hideMaterial(position) {
        var x = document.getElementById(position);
        x.style.display = "none";
    }
</script>

<!--==========================
  Table script
============================-->
<script>

</script>

<?php
//-------------------------
//      POST
//-------------------------
if (array_key_exists('save_material', $_POST)) {
    save_material();
}
if (array_key_exists('show_all', $_POST)) {
    showMaterial('all');
    alert("전체 검색 완료.");
}
if (array_key_exists('show_cond', $_POST)) {
    $arr = array();

    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $month      = ($_POST['ibox_month']);
    $class      = ($_POST['ibox_class']);

    if (!empty($date)) {
        $arr['date'] = $date;
    }
    if (!empty($supplier)) {
        $arr['supplier'] = $supplier;
    }
    if (!empty($item)) {
        $arr['item'] = $item;
    }
    if (!empty($design)) {
        $arr['design'] = $design;
    }
    if (!empty($month)) {
        $arr['month'] = $month."月份";
    }
    if (!empty($class)) {
        $arr['class'] = $class;
    }

    showMaterial($arr);

    $cond = "";
    foreach ($arr as $k => $v) {
        $cond = $cond.$k."=$v,";
    }
    $cond = substr($cond, 0, -1);
    alert($cond." 조건부 검색 완료.");
}

function showMaterial($condition) {
    if ($condition == 'all') {
        $sql = "SELECT * FROM material";
    }
    else {
        $sql = "SELECT * FROM material WHERE ";
        $cnt = 0;
        foreach ($condition as $k => $v) {
            $sql = $sql.$k."='{$v}'";
            if (($cnt + 1) != count($condition)) {
                $sql = $sql." AND ";
            }
            $cnt += 1;
        }
    }
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $res = mysqli_query($conn, $sql);

    echo '
        <section id="material_view" class="section-bg" style="display: none; margin-bottom: 10%">
        <div class="container-fluid">
        <div class="section-header">
        <h3 class="section-title">원자재목록</h3>
        <span class="section-divider"></span>
        <table id="mat_table" class="container" style="overflow-x: auto; font-size: 10pt; text-align: center">
        <thead>
        <tr style="border-bottom: 1px dotted silver;">
        <th>No</th>
        <th>Date</th>
        <th>Supp</th>
        <th>Item</th>
        <th>Design</th>
        <th>Qty</th>
        <th>Month</th>
        <th>Class</th>
        <th>Worker</th>
        <th>Erase</th>
        </tr>
        </thead>
        <tbody id="mat_tbody" class="dynamics">
';
    $num = 0;
    while ($row = mysqli_fetch_array($res)) {
        $num += 1;
        $name = "tItem".strval($num);
        echo '<tr style="border-bottom: 1px dotted silver"><td>' .
            $num . '</td><td>' .
            $row['date'] . '</td><td>' .
            $row['supplier'] . '</td><td>' .
            $row['item'] . '</td><td>' .
            $row['design'] . '</td><td>' .
            $row['qty'] . '</td><td>' .
            $row['month'] . '</td><td>' .
            $row['class'] . '</td><td>' .
            $row['worker'] . '</td><td>
            <input type="submit" class="btn-success" value="삭제"></td></tr>';
    }
    echo
    '</tbody>
    </table>
    </div>
    </div>
    </section>';
}

if (array_key_exists('test', $_POST)) {
    alert();
}

function update($name) {
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT * FROM name_info WHERE kind='{$name}'";
    $res = mysqli_query( $conn, $sql );
    while( $row = mysqli_fetch_array( $res ) ) {
        $var = htmlentities($row['name']);
        echo "<option value='$var'>";
    }
}

function save_material() {
    $date       = ($_POST['ibox_date']);
    $supplier   = ($_POST['ibox_supplier']);
    $item       = ($_POST['ibox_item']);
    $design     = ($_POST['ibox_design']);
    $qty        = ($_POST['ibox_qty']);
    $month      = ($_POST['ibox_month'])."月份";
    $class      = ($_POST['ibox_class']);
    $worker     = ($_SESSION['user_id']);

    if (empty($supplier)) {
        alert("supplier 값을 입력하세요.");
        return;
    }
    if (empty($item)) {
        alert("item 값을 입력하세요.");
        return;
    }
    if (empty($design)) {
        alert("design 값을 입력하세요.");
        return;
    }
    if (empty($qty)) {
        alert("quantity 값을 입력하세요.");
        return;
    }
    if (empty($class)) {
        alert("class 값을 입력하세요.");
        return;
    }

    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");

    $sql = "INSERT INTO material (date, supplier, item, design, qty, month, class, worker) 
            VALUES ('{$date}', '{$supplier}', '{$item}', '{$design}', {$qty}, '{$month}', '{$class}', '{$worker}')";

    if (mysqli_query($conn, $sql)) {
        alert("정상적으로 저장되었습니다.");
    }
}

function add_list($value, $name) {
    if (empty($value)) {
        alert("{$name} 값을 입력하세요.");
        return;
    }
    $conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
    $sql = "SELECT EXISTS (SELECT * FROM {$name} where {$name}={$value}) as Chk";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (intval($res['Chk'])) {
        alert("{$name} : {$value} 항목은 이미 존재합니다.");
        return;
    }

    $sql = "INSERT INTO {$name} VALUES ({$value})";
    if (mysqli_query($conn, $sql)) {
        alert("{$name} : {$value} 항목 추가 완료");
    }
}

function pop_list($value, $name) {

}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>

<a href="#" class="back-to-top" onclick="hideMaterial('material_view')"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/magnific-popup/magnific-popup.min.js"></script>

<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="js/main.js"></script>

</body>
</html>