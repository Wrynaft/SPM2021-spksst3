<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="maindeco.css">
    <script src="https://kit.fontawesome.com/1529aa3718.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <h2>SPKSST3</h2>
        <ul>
            <li><a href="mainMurid.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="kuiz.php"><i class="fas fa-book"></i>Kuiz</a></li>
            <li><a href="rekod.php"><i class="fas fa-clipboard"></i>Rekod Prestasi</a></li>
            <li><a href="logkeluar.php"><i class="fas fa-sign-out-alt"></i>Log Keluar</a></li>
        </ul>
    </div>
    <div class="main_content">
        <div class="header">Sistem Penilaian Kuiz Subjek Sains Tingkatan 3</div>
        <div class="info">
            <h1 style="text-align:center;">Profil Pengguna</h1>
            <br><br>
            <img style="width:20%;display:block;margin:auto;" src="Assets/murid.png">
            <br>
            <?php
            $dataA=mysqli_query($conn, "SELECT*FROM pengguna WHERE idpeng='$idpeng'");
            $infoA=mysqli_fetch_array($dataA);
            ?>
            <div class="infobox">
            <div style="display:inline;">
            <i class="fas fa-id-card"></i> ID Pengguna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $idpeng;?><br>
            <i class="fas fa-user"></i> Nama Pengguna &nbsp;: <?php echo $infoA['nama'];?><br>
            <i class="fas fa-graduation-cap"></i> Peranan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $infoA['peranan'];?><br>
            <i class="fas fa-phone"></i> Nombor Telefon &nbsp;&nbsp;: <?php echo $infoA['notel'];?><br>
</div>
</div></div>
</body>
</html>