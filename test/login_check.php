<script type="text/javascript">
    function popupMsg(key) {
        if (key === 1) {
            var popup = document.getElementById('login_popup_1');
        }
        if (key === 2) {
            var popup = document.getElementById('login_popup_2');
        }
        if (key === 3) {
            var popup = document.getElementById('login_popup_3');
        }
        if (key === 4) {
            var popup = document.getElementById('login_popup_4');
        }
        popup.classList.toggle("show");
        // if (key === 'uid') {
        //     var popup = document.getElementById('uid_popup');
        //     popup.classList.toggle("show");
        // }
        // if (key === 'pwd') {
        //     var popup = document.getElementById('pwd_popup');
        //     popup.classList.toggle("show");
        // }
    }
    function enterMain() {
        location.href = 'material.php';
    }
</script>

<?php
session_start();
if (isset($_SESSION['user_id']))
{
    header('Location: main.php');
}
$user_id = $_POST['user_id'];
$passwd = $_POST['passwd'];

if ($user_id == "" || $passwd == "") {
    echo "<script>popupMsg(1);</script>";
    return;
}

$conn = mysqli_connect("localhost", "admin", "qwer1234", "outlook_bone_china");
$sql = "SELECT * FROM user_info WHERE user_id='$user_id'";

$res = mysqli_query($conn, $sql);
if ($res->num_rows != 1) {
    echo "<script>popupMsg(2);</script>";
    return;
}

$row = mysqli_fetch_array( $res );
if ($row['passwd'] != $passwd) {
    echo "<script>popupMsg(3);</script>";
    return;
}

$_SESSION['user_id'] = $user_id;
if (!isset($_SESSION['user_id'])) {
    echo "<script>popupMsg(4);</script>";
    return;
}
//    echo "<script>location.replace(./material.php);</script>";
//    echo "<script>enterMain();</script>";
header('location:./material.php');
?>