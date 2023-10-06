<?php
    require 'connect.php';

    if (!empty($_POST['soalan'])){
        //Mendapatkan maklumat daripada borang
        $topik=$_POST['topik'];
        $newtopik=$_POST['newtopik'];
        $soalan=$_POST['soalan'];
        $pilihan1=$_POST['pilihan1'];
        $pilihan2=$_POST['pilihan2'];
        $pilihan3=$_POST['pilihan3'];
        $pilihan4=$_POST['pilihan4'];
        $jwp=$_POST['jwp'];
        //Semak sama ada topik lama atau topik baharu
        if (empty($newtopik)){
            //Jika topik lama, dapatkan idtopik
            $queryid=mysqli_query($conn,"SELECT idtopik FROM topik WHERE topik='$topik'");
            $idtopiklama=mysqli_fetch_assoc($queryid);
            $idtopik=$idtopiklama['idtopik'];
        } else{
            //Jika topik baharu
            //Menjanakan idtopik baharu
            $querytopik=mysqli_query($conn,"SELECT idtopik FROM topik ORDER BY 
            CAST(substr(idtopik,2,6) AS int) DESC LIMIT 1");
            $nexttopik=mysqli_fetch_assoc($querytopik);
            $prior=(int) substr($nexttopik['idtopik'],-2);
            $nextid=$prior + 1 ;
            if ($nextid<10){
                $idtopik="T0" .$nextid;
            }else{
                $idtopik="T" .$nextid;
            }
            //Memasukkan maklumat topik baharu ke dalam pangkalan data
            $daftartopik="INSERT INTO topik (idtopik,topik) VALUES ('$idtopik','$newtopik')";
            $hasiltopik=mysqli_query($conn,$daftartopik);
            if (!$hasiltopik){
                echo "<script>alert('Pendaftaran topik gagal');window.location='daftarsoalan.php'</script>";
            }
        }
        //Melaksanakan loop untuk menyemak setiap soalan daripada borang
        foreach( $soalan as $key => $n ){
            //Menjanakan idsoalan baharu
            $querysoal=mysqli_query($conn,"SELECT idsoalan FROM soalan ORDER BY 
            CAST(substr(idsoalan,2,6) AS int) DESC LIMIT 1");
            $nextsoal=mysqli_fetch_assoc($querysoal);
            $priorsoal=(int) substr($nextsoal['idsoalan'],1);
            $nosoal=$priorsoal + 1 ;
            $idsoalan="S" .$nosoal;
            //Memasukkan maklumat soalan baharu ke dalam pangkalan data
            $daftarsoal="INSERT INTO soalan (idsoalan,nosoal,soalan,idtopik) 
            VALUES ('$idsoalan','$nosoal','$n','$idtopik')";
            $hasilsoalan1=mysqli_query($conn,$daftarsoal);
            if (!$hasilsoalan1){
                echo "<script>alert('Pendaftaran soalan gagal');window.location='daftarsoalan.php'</script>";
            }
            //Menjanakan idpilihan baharu
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
            $pilihanA = $pilihan1[$key];
            $pilihanB = $pilihan2[$key];
            $pilihanC = $pilihan3[$key];
            $pilihanD = $pilihan4[$key];
            $nojwp = $key;
            while (!isset($jwp[$nojwp])){
                $nojwp=$nojwp + 1;
            }
            $jwp1 = $jwp2 = $jwp3 = $jwp4 = 0;
            if ($jwp[$nojwp]=="A"){
                $jwp1 = 1;
            } elseif ($jwp[$nojwp]=="B"){
                $jwp2 = 1;
            } elseif ($jwp[$nojwp]=="C"){
                $jwp3 = 1;
            } else{
                $jwp4 = 1;
            }
            //Memasukkan pilihan ke dalam pangkalan data
            $daftarpil1=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
            VALUES ('$idpilihan1','$jwp1','$pilihanA','$idsoalan')");
            $daftarpil2=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
            VALUES ('$idpilihan2','$jwp2','$pilihanB','$idsoalan')");
            if (!empty($pilihan3)){
                $daftarpil3=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
                VALUES ('$idpilihan3','$jwp3','$pilihanC','$idsoalan')");
            }
            if (!empty($pilihan4)){
                $daftarpil4=mysqli_query($conn,"INSERT INTO pilihan (idpilihan,jwp,pilihan,idsoalan) 
                VALUES ('$idpilihan4','$jwp4','$pilihanD','$idsoalan')");
            }
        }
        echo "<script>alert('Pendaftaran soalan berjaya');window.location='mainGuru.php'</script>";
    }
?>