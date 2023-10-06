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
        <div class="header">Selamat Datang!</div>
        <div class="info">
            <h1 style="text-align:center;">Kuiz Baharu</h1>
            <br><br>
            <?php
            $sudahbuat= array();
            //Dapatkan idtopik bagi topik yang telah pernah dijawab oleh pengguna
            $topikarray=mysqli_query($conn,"SELECT idtopik FROM perekodan WHERE idpeng='$idpeng'");
            if ($topikarray){
            while ($row = mysqli_fetch_array($topikarray)){
                array_push($sudahbuat,$row['idtopik']);
            }
        }
            $idtopikbuat = implode("','",$sudahbuat);
            //Dapatkan topik yang tidak pernah dijawab oleh pengguna
            $belumbuat=mysqli_query($conn, "SELECT * FROM topik WHERE idtopik NOT IN ('$idtopikbuat')");
            //Paparkan kuiz yang belum dibuat oleh pengguna
            if (mysqli_num_rows($belumbuat)!=0){
                while ($row = mysqli_fetch_array($belumbuat)){
                    echo '<div class="topik">'.$row['topik'].'</div>';
                    $idtopik=$row['idtopik'];
                    $soalan = mysqli_query($conn, "SELECT soalan FROM soalan WHERE idtopik='$idtopik'");
                    $nosoalan = mysqli_num_rows($soalan);
                    echo '<div class="penerangan"><p>Status: <i class="fas fa-circle"></i>Belum jawab</p>
                    <p>Jumlah Soalan: '.$nosoalan.'</p><form action="transition2.php" method="post" 
                    style="display:inline;"><input type="hidden" name="topik" value="'.$row['topik'].'">
                    <button type="submit" class="jawab");">Jawab Sekarang</button></form></div><br>';
                } 
            } else{
                echo '<div style="text-align:center"><br><br><br><br><i class="fas fa-laugh-beam"></i>
                <br><br><br><p style="font-size:25px">Tiada kerja baharu...</p></div>';
            }
            ?>
</div>
</div></div>
</body>
</html>