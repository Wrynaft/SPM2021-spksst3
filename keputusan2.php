<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
$topik = $_SESSION['topik'];
$idtopikq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT idtopik FROM topik WHERE topik='$topik'"));
$idtopik = $idtopikq['idtopik'];
$soalanq = mysqli_query($conn, "SELECT * FROM soalan WHERE idtopik='$idtopik' ORDER BY CAST(substr(idsoalan,2,6) AS int)");
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
            <div><h1 style="text-align:center;"><?php print $topik;?></h1>
            <br><br>
            <?php
            $index=0;
            while ($soalan = mysqli_fetch_array($soalanq)){
                $question = $soalan['soalan'];
                $idsoalan = $soalan['idsoalan'];
                echo '<div class="jawabkuiz">'.$question.'<br><br>';
                $pilihanq = mysqli_query($conn, "SELECT * FROM pilihan WHERE idsoalan='$idsoalan' ORDER BY CAST(substr(idpilihan,2,6) AS int)");
                $indexp = 1;
                while ($pilihan = mysqli_fetch_array($pilihanq)){
                    $option = $pilihan['pilihan'];
                    $ans = '';
                    $keraguan = '';
                    if ($pilihan['jwp'] == "1"){
                        $ans = "checked";
                        $keraguan = "kebetulan";}
                    echo '<label class="container" id="'.$keraguan.'">'.$option.'<input type="checkbox" name="jawapan['.$index.']" value="'.$indexp.'"'.$ans.' disabled><span class="checkmark"></span></label>';
                    $indexp = $indexp + 1;
                }
                echo '</div><br><br>';
                $index=$index + 1;
            }
            ?>
            <button class="btn" style="float:right;" onClick="javascript:window.location='rekod.php'">Balik</button>
</div></div>
</div></div>
</body>
</html>