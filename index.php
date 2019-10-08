<?php
session_start();
if(!isset($_SESSION['id_user'])) {
    echo "<script>window.location='login.php';</script>";
} else {
    echo "<script>window.location='dashboard';</script>";
}
?>