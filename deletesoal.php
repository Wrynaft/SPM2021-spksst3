<?php
    require 'connect.php';

    if (isset($_POST['soalan'])){
        //Dapatkan maklumat daripada borang
        $soalan=$_POST['soalan'];
        //Laksanakan kod SQL untuk menghapuskan maklumat daripada pangkalan data mengikut soalan yang didapati
        $idquery=mysqli_query($conn,"SELECT idsoalan FROM soalan WHERE soalan='$soalan'");
        $idsoalan=mysqli_fetch_array($idquery)[0];
        $delsoalan="DELETE FROM soalan WHERE soalan='$soalan'";
        $delpilihan="DELETE FROM pilihan WHERE idsoalan='$idsoalan'";
        $querysoal=mysqli_query($conn,$delsoalan);
        $querypilihan=mysqli_query($conn,$delpilihan);
        if (!$querysoal or !$querypilihan){
            echo "<script>alert('Pemadaman soalan gagal');window.location='mainGuru.php'</script>";
        }else{
            echo"<script>alert('Pemadaman soalan berjaya');window.location='mainGuru.php'</script>";
        }
    } 
?>