<?php
session_start();
if (!isset($_SESSION['user_id']))
{
    header('Location: obc/login.php');
}
else
{
    header('Location: obc/material.php');
}
?>
