<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];

$_SESSION['topik'] = $_POST['topik'];
header("Location: keputusan2.php");
?>