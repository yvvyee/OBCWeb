<?php
session_start();
if (!isset($_SESSION['user_id']))
{
    header('Location: ./login.php');
}
else
{
    header('Location: ./main.php');
}
?>

insert into supplier_info (supplier) select DISTINCT supplier from material
