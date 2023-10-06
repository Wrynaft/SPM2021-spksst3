<?php
session_start();

if(!isset($_SESSION['idpeng'])){
    header('location:login.php');
    exit();
}
?>