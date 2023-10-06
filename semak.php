<?php
require 'connect.php';
require 'keselamatan.php';
//Dapatkan maklumat daripada borang
$idpeng=$_SESSION['idpeng'];
$topik = $_SESSION['topik'];
$jawapan = $_POST['jawapan'];
$_SESSION['jawapan'] = $jawapan;
//Dapatkan idtopik
$idtopikq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT idtopik FROM topik WHERE topik='$topik'"));
$idtopik = $idtopikq['idtopik'];
//Dapatkan semua soalan daripada topik tersebut
$soalanq = mysqli_query($conn, "SELECT * FROM soalan WHERE idtopik='$idtopik' ORDER BY CAST(substr(idsoalan,2,6) AS int)");
$jumsoalan = mysqli_num_rows($soalanq);
$skor = 0;
$index = 0;
//Melaksanakan loop untuk menyemak setiap soalan
while ($soalan = mysqli_fetch_array($soalanq)){
    $idsoalan = $soalan['idsoalan'];
    $indexp = 1;
    //Dapatkan pilihan bagi soalan tersebut
    $pilihanq = mysqli_query($conn, "SELECT * FROM pilihan WHERE idsoalan='$idsoalan' ORDER BY CAST(substr(idpilihan,2,6) AS int)");
    //Menyemak sama ada jawapan pengguna dengan jawapan daripada pangkalan data sepadan atau tidak
    while ($pilihan = mysqli_fetch_array($pilihanq)){
        if ($pilihan['jwp'] == "1" and $jawapan[$index] == $indexp) {
            $skor = $skor + 1;
        }
        $indexp = $indexp + 1;
    }
    $index = $index + 1;
}
//Hitung markah
$markah = round(($skor/$jumsoalan)*100);
if ($markah >= 80){
    $gred = "A";
} elseif ($markah >= 65){
    $gred = "B";
} elseif ($markah >= 50){
    $gred = "C";
} elseif ($markah >= 40){
    $gred = "D";
} else{
    $gred = "E";
}
$tarikh = date("d/m/Y");
//Menjana idrekod baharu
$queryrekod=mysqli_query($conn,"SELECT idrekod FROM perekodan ORDER BY CAST(substr(idrekod,2,6) AS int) DESC LIMIT 1");
$nextrekod=mysqli_fetch_assoc($queryrekod);
$prior=(int) substr($nextrekod['idrekod'],-1);
$nextid=$prior + 1 ;
if ($nextid<10){
    $idrekod="R000" .$nextid;
}else{
    $idrekod="R00" .$nextid;
}
//Memasukkan maklumat perekodan ke dalam pangkalan data
$daftarrekod=mysqli_query($conn, "INSERT INTO perekodan (idrekod,idpeng,idtopik,tarikh,markah,gred) VALUES ('$idrekod','$idpeng','$idtopik','$tarikh','$markah','$gred')");
echo "<script>window.location='keputusan.php'</script>";
?>