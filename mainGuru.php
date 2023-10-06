<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
#https://www.youtube.com/watch?v=YesSVqjcDts
#f3f5f9 - white grey bg
#4b4276 - dark purple sidenav bg
#bdb8d7 - ligh purple sidenax text
#594f8d - hover color
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
            <li><a href="mainGuru.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="senaraimurid.php"><i class="fas fa-users"></i>Senarai Murid</a></li>
            <li><a href="rekodmurid.php"><i class="fas fa-clipboard"></i>Prestasi Murid</a></li>
            <li><a href="koleksisoalan.php"><i class="fas fa-book-open"></i>Koleksi Soalan</a></li>
            <li><a href="daftarsoalan.php"><i class="fas fa-plus"></i>Tambah Kuiz</a></li>
            <li><a href="logkeluar.php"><i class="fas fa-sign-out-alt"></i>Log Keluar</a></li>
        </ul>
    </div>
    <div class="main_content">
        <div class="header">Sistem Penilaian Kuiz Subjek Sains Tingkatan 3</div>
        <div class="info">
            <h1 style="text-align:center;">Profil Pengguna</h1>
            <br><br>
            <img style="width:20%;display:block;margin:auto;" src="Assets/guru.png">
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
</div>

        </div>
        </div>
</div>
</body>
</html>