<?php
    require 'connect.php';
    require 'keselamatan.php';
    //Dapatkan maklumat daripada borang
    $topik = $_SESSION['topik'];
    $idtopikq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idtopik FROM topik WHERE topik='$topik'"));
    $idtopik = $idtopikq['idtopik'];
    $topikbaru = $_POST['topik'];
    $soalanbaru=$_POST['soalan'];
    $pilihan1=$_POST['pilihan1'];
    $pilihan2=$_POST['pilihan2'];
    $pilihan3=$_POST['pilihan3'];
    $pilihan4=$_POST['pilihan4'];
    $jwp=$_POST['jwp'];
    //Mengemas kini topik dalam pangkalan data
    $kktopik = mysqli_query($conn, "UPDATE topik SET topik='$topikbaru' WHERE idtopik='$idtopik'");
    //Dapatkan soalan bagi topik tersebut daripada pangkalan data
    $soalanq = mysqli_query($conn, "SELECT * FROM soalan WHERE idtopik='$idtopik' ORDER BY
     CAST(substr(idsoalan,2,6) AS int)");
    $index = -1;
    //Melaksanakan loop untuk mengemas kini setiap soalan
    while ($soalan = mysqli_fetch_array($soalanq)){
        $index = $index + 1;
        $idsoalan = $soalan['idsoalan'];
        $question = $soalanbaru[$index];
        //Mengemas kini soalan dalam pangkalan data
        $kksoal = mysqli_query($conn, "UPDATE soalan SET soalan='$question' WHERE idsoalan='$idsoalan'");
        $indexp = 0;
        //Dapatkan pilihan bagi soalan tersebut dalam pangkalan data
        $pilihanq = mysqli_query($conn, "SELECT idpilihan FROM pilihan WHERE idsoalan='$idsoalan' ORDER BY 
        CAST(substr(idpilihan,2,6) AS int)");
        //Melaksanakan loop untuk mengemas kini setiap pilihan
        while ($pilihan = mysqli_fetch_array($pilihanq)){
            $indexp = $indexp + 1;
            $idpilihan = $pilihan['idpilihan'];
            //Mengemas kini pilihan dalam pangkalan data
            if ($indexp == 1){
                $pilihanbaru = $pilihan1[$index];
                $kkpilihan=mysqli_query($conn, "UPDATE pilihan SET pilihan='$pilihanbaru' 
                WHERE idpilihan='$idpilihan'");
                if ($jwp[$index]=="A"){
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='1' WHERE idpilihan='$idpilihan'");
                } else{
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='0' WHERE idpilihan='$idpilihan'");
                }
            } elseif ($indexp == 2){
                $pilihanbaru = $pilihan2[$index];
                $kkpilihan=mysqli_query($conn, "UPDATE pilihan SET pilihan='$pilihanbaru' 
                WHERE idpilihan='$idpilihan'");
                if ($jwp[$index]=="B"){
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='1' WHERE idpilihan='$idpilihan'");
                } else{
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='0' WHERE idpilihan='$idpilihan'");
                }
            } elseif ($indexp == 3){
                $pilihanbaru = $pilihan3[$index];
                $kkpilihan=mysqli_query($conn, "UPDATE pilihan SET pilihan='$pilihanbaru' 
                WHERE idpilihan='$idpilihan'");
                if ($jwp[$index]=="C"){
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='1' WHERE idpilihan='$idpilihan'");
                } else{
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='0' WHERE idpilihan='$idpilihan'");
                }
            } else{
                $pilihanbaru = $pilihan4[$index];
                $kkpilihan=mysqli_query($conn, "UPDATE pilihan SET pilihan='$pilihanbaru' 
                WHERE idpilihan='$idpilihan'");
                if ($jwp[$index]=="D"){
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='1' WHERE idpilihan='$idpilihan'");
                } else{
                    $kkjwp=mysqli_query($conn, "UPDATE pilihan SET jwp='0' WHERE idpilihan='$idpilihan'");
                }
            }
        }
    }
    $index = $index + 1;
    while (isset($soalanbaru[$index])){
        $querysoal=mysqli_query($conn,"SELECT idsoalan FROM soalan ORDER BY 
        CAST(substr(idsoalan,2,6) AS int) DESC LIMIT 1");
        $nextsoal=mysqli_fetch_assoc($querysoal);
        $priorsoal=(int) substr($nextsoal['idsoalan'],1);
        $nosoal=$priorsoal + 1 ;
        $idsoalan2="S" .$nosoal;
        $soalanbaharu = $soalanbaru[$index];
        $daftarsoal="INSERT INTO soalan (idsoalan,nosoal,soalan,idtopik) 
        VALUES ('$idsoalan2','$nosoal','$soalanbaharu','$idtopik')";
        $hasilsoalan1=mysqli_query($conn,$daftarsoal);
        if (!$hasilsoalan1){
            echo "<script>alert('Pendaftaran soalan gagal');window.location='daftarsoalan.php'</script>";
        }
        $querypil=mysqli_query($conn,"SELECT idpilihan FROM pilihan ORDER BY 
        CAST(substr(idpilihan,2,6) AS int) DESC LIMIT 1");
        $nextpil=mysqli_fetch_array($querypil);
        $priorpil=(int) substr($nextpil['idpilihan'],1);
        $nopil1=$priorpil + 1 ;
        $nopil2=$nopil1 + 1 ;
        $nopil3=$nopil2 + 1 ;
        $nopil4=$nopil3 + 1 ;
        $idpilihan1="P" .$nopil1;
        $idpilihan2="P" .$nopil2;
        $idpilihan3="P" .$nopil3;
        $idpilihan4="P" .$nopil4;
        $pilihanA = $pilihan1[$index];
        $pilihanB = $pilihan2[$index];
        $pilihanC = $pilihan3[$index];
        $pilihanD = $pilihan4[$index];
        $jwp1 = $jwp2 = $jwp3 = $jwp4 = 0;
        if ($jwp[$index]=="A"){
            $jwp1 = 1;
        } elseif ($jwp[$index]=="B"){
            $jwp2 = 1;
        } elseif ($jwp[$index]=="C"){
            $jwp3 = 1;
        } else{
            $jwp4 = 1;
        }
        $daftarpil1=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan)
         VALUES ('$idpilihan1','$jwp1','$pilihanA','$idsoalan2')");
        $daftarpil2=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
        VALUES ('$idpilihan2','$jwp2','$pilihanB','$idsoalan2')");
        if (!empty($pilihan3)){
            $daftarpil3=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
            VALUES ('$idpilihan3','$jwp3','$pilihanC','$idsoalan2')");
        }
        if (!empty($pilihan4)){
            $daftarpil4=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
            VALUES ('$idpilihan4','$jwp4','$pilihanD','$idsoalan2')");
        }
        $index = $index + 1;
    }
    echo "<script>alert('Kuiz telah dikemas kini');window.location='mainGuru.php'</script>";
?>