<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo "<h2>{$_SESSION['user_id']} 님 환영합니다.</h2>";
    ?>
    <a href="../login.php"><input type="button" value="로그아웃" onclick="<?php session_destroy(); ?>" /></a>
    <?php
}else{
    echo "<script>alert('허용되지 않은 접근입니다.'); history.back();</script>";
}
?>