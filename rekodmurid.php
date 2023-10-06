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
        <li><a href="mainGuru.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="senaraimurid.php"><i class="fas fa-users"></i>Senarai Murid</a></li>
            <li><a href="rekodmurid.php"><i class="fas fa-clipboard"></i>Prestasi Murid</a></li>
            <li><a href="koleksisoalan.php"><i class="fas fa-book-open"></i>Koleksi Soalan</a></li>
            <li><a href="daftarsoalan.php"><i class="fas fa-plus"></i>Tambah Kuiz</a></li>
            <li><a href="logkeluar.php"><i class="fas fa-sign-out-alt"></i>Log Keluar</a></li>
        </ul>
    </div>
    <div class="main_content">
        <div class="header">Selamat Datang!</div>
        <div class="info">
            <h1 id="title" style="text-align:center;">Rekod Prestasi Murid</h1>
            <br><br>
            <?php
            $topikquery=mysqli_query($conn, "SELECT*FROM topik ORDER BY CAST(substr(idtopik,2,6) AS int)");
            while ($row = mysqli_fetch_array($topikquery)){
                echo '<div class="topik">'.$row['topik'].'<i class="fas fa-plus plus" id="'.$row['idtopik'].'" onclick="expand(this.id)"></i></div>';
                $idtopik=$row['idtopik'];
                $rekodquery=mysqli_query($conn, "SELECT*FROM perekodan WHERE idtopik = '$idtopik' ORDER BY CAST(substr(idrekod,2,6) AS int)");
                echo '<div class="perekodan '.$idtopik.'" style="display: none;"><table>';
                while ($row2 = mysqli_fetch_array($rekodquery)){
                    $idpeng = $row2['idpeng'];
                    $namaquery = mysqli_fetch_array(mysqli_query($conn, "SELECT nama FROM pengguna WHERE idpeng = '$idpeng'"));
                    $nama = $namaquery['nama'];
                    $tarikh = $row2['tarikh'];
                    $markah = $row2['markah'];
                    $gred = $row2['gred'];
                    echo '<tr><td width="30%">'.$nama.'</td><td width="30%">'.$tarikh.'</td><td width="30%">'.$markah.'%</td><td width="10%">'.$gred.'</td></tr>';
                }
                echo '</table></div><br>';
            }
            ?>
            <br><br>
            <button class="btn" style="float:right;" onClick="javascript:window.print()">Cetak laporan</button>
            <script>
                function expand(elem) {
                    var situasi = document.getElementsByClassName(elem);
                    for(i = 0; i < situasi.length; i++) {
                        if (situasi[i].style.display == "none"){
                            situasi[i].style.display = "block";
                        } else{
                            situasi[i].style.display = "none";
                    }
                    }
                    var thing = document.getElementById(elem);
                    if (thing.className == "fas fa-plus plus"){
                        thing.className = "fas fa-minus";
                    } else{
                        thing.className = "fas fa-plus plus";
                    }
                }
                function kksoal(topik){
                    $_SESSION['topik']=topik
                    
                }
            </script>
</div></div>
</div>
</body>
</html>