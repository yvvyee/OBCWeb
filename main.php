<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>메인페이지</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['user_id'])){
    echo "<h2>{$_SESSION['user_id']} 님 환영합니다.</h2>";
    ?>
    <a href="/member/logout.php"><input type="button" value="로그아웃" /></a>
    <?php
}else{
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
}
?>
</body>
</html>