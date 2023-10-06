<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
$carian=$_POST['carian']
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
            <h1 id="title" style="text-align:center;">Senarai Murid</h1>
            <br><br>
            <form action="search.php" method='post'>
                <input type="text" name="carian" class="search" placeholder="Cari murid..." value='<?php echo $carian ?>' required>
                <button type="submit" class="fabutton" style="position:absolute;right:40px; top:170px;"><i class="fas fa-search"></i></button>
                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
            </form>
            <i class="fas fa-times" style="font-size:25px;position:absolute; right:60px; top:177px;" onClick="javascript:window.location='senaraimurid.php'"></i>
            <?php
            echo '<br><br><h2>Hasil carian untuk "'.$carian.'":</h2><br><br>';
            $pengquery = mysqli_query($conn, "SELECT * FROM pengguna WHERE peranan='Pelajar' 
            AND nama LIKE '%$carian%'");
            if (mysqli_num_rows($pengquery)==0){
                echo '<div style="text-align:center"><i class="fas fa-tired"></i>
                <br><br><br><p style="font-size:25px">Tiada carian ditemui...</p></div>';
            }else{
                echo '<table>
                <tr>
                    <th width = "30%">ID Pengguna</th>
                    <th width = "30%">Nama</th>
                    <th width = "30%">No. Telefon</th>
                    <th width = "10%">Tindakan</th>
                </tr>';
                while ($row = mysqli_fetch_array($pengquery)){
                    echo '<tr>
                        <td>'.$row['idpeng'].'</td>
                        <td>'.$row['nama'].'</td>
                        <td>'.$row['notel'].'</td>
                        <td><form action="deletepeng.php" method="post" style="display:inline;">
                        <input type="hidden" name="idpeng" value="'.$row['idpeng'].'">
                        <button type="submit" class="fabutton" onclick=
                        "return confirm(\'Adakah anda pasti mahu memadam pengguna ini?\');">
                        <i class="fas fa-trash-alt"></i></button>
                        </form></td>
                        </tr>';
                }
                echo '</table>';
           }
            ?>
            <br><br><br><br>
            <h1 id="title" style="text-align:center;">Import Senarai</h1>
            <br>
            <p style="text-align:center;">Sila cipta fail dalam Microsoft Excel dan "Save As: .csv" mengikut aturan lajur seperti di bawah:</p>
            <br>
            <img style="display:block; margin-left:auto; margin-right:auto;" src="Assets/csvcontoh.png">
            <br>
        <form action="importcsv.php" method='post' enctype="multipart/form-data">
            <input type="file" name="csvfile" id="csvfile" style="display:block;margin:auto;" required>
            <br>
            <button class="btn" type="submit" name="import" style="display:block;margin:auto;">Import!</button>
        </form>
</div></div>
</div>
</body>
</html>