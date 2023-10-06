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
        <h1 style="text-align:center;">Koleksi Soalan</h1>
        <br><br>
        <?php
            $topikquery=mysqli_query($conn, "SELECT*FROM topik");
            while ($row = mysqli_fetch_array($topikquery)){
                echo '<div class="topik">'.$row['topik'].'<form action="transition.php" method="post" style="display:inline;"><input type="hidden" name="topik" value="'.$row['topik'].'"><button type="submit" class="fabutton");"><i class="fas fa-edit"></i></form></button><form action="deletetopik.php" method="post" style="display:inline;"><input type="hidden" name="idtopik" value="'.$row['idtopik'].'"><button type="submit" class="fabutton" onclick="return confirm(\'Adakah anda pasti mahu memadam topik ini?\');"><i class="fas fa-trash-alt"></i></button></form><i class="fas fa-plus plus" id="'.$row['idtopik'].'" onclick="expand(this.id)"></i></div>';
                $idtopik=$row['idtopik'];
                $soalanquery=mysqli_query($conn, "SELECT*FROM soalan WHERE idtopik = '$idtopik' ORDER BY CAST(substr(idsoalan,2,6) AS int)");
                while ($row2 = mysqli_fetch_array($soalanquery)){
                    $field2name = $row2['soalan'];
                    echo '<div class="soalan '.$idtopik.'" style="display: none;">'.$field2name.'<form action="deletesoal.php" method="post" style="display:inline;"><input type="hidden" name="soalan" value="'.$field2name.'"><button type="submit" class="fabutton" onclick="return confirm(\'Adakah anda pasti mahu memadam soalan ini?\');"><i class="fas fa-trash-alt"></i></button></form></div>';
                }
                echo '<br>';
            }
            ?>
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
        </div>
</html>