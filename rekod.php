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
            <h1 style="text-align:center;">Rekod Prestasi</h1>
            <br><br>
            <table>
                <tr>
                    <th>Topik</th>
                    <th>Tarikh</th>
                    <th>Markah</th>
                    <th>Gred</th>
                    <th>Tindakan</th>
                </tr>
            <?php
            $rekodquery = mysqli_query($conn, "SELECT * FROM perekodan WHERE idpeng='$idpeng'");
            while ($row = mysqli_fetch_array($rekodquery)){
                $idtopik = $row['idtopik'];
                $topik = mysqli_fetch_array(mysqli_query($conn, "SELECT topik FROM topik WHERE idtopik='$idtopik'"));

                echo '<tr>
                    <td width="25%">'.$topik['topik'].'</td>
                    <td width="25%">'.$row['tarikh'].'</td>
                    <td width="25%">'.$row['markah'].'%</td>
                    <td width="20%">'.$row['gred'].'</td>
                    <td width="5%"><form action="transition3.php" method="post" style="display:inline;"><input type="hidden" name="topik" value="'.$topik['topik'].'"><button type="submit" class="jawab");">Semak</button></form>
                    </tr>';
            }
            ?>
            </table>
            <br><br>
            <button class="btn" style="float:right;" onClick="javascript:window.print()">Cetak laporan</button>
</div>
</div></div>
</body>
</html>