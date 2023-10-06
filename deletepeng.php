<?php
    require 'connect.php';

    if (isset($_POST['idpeng'])){
        //Dapatkan maklumat daripada borang
        $idpeng=$_POST['idpeng'];
        //Laksanakan kod SQL untuk menghapuskan maklumat daripada pangkalan data mengikut idpengguna yang didapati
        $delpeng="DELETE FROM pengguna WHERE idpeng='$idpeng'";
        $delrekod="DELETE FROM perekodan WHERE idpeng='$idpeng'";
        $querypeng=mysqli_query($conn,$delpeng);
        $queryrekod=mysqli_query($conn,$delrekod);
        if (!$querypeng or !$queryrekod){
            echo "<script>alert('Pemadaman pengguna gagal');window.location='senaraimurid.php'</script>";
        }else{
            echo"<script>alert('Pemadaman pengguna berjaya');window.location='senaraimurid.php'</script>";
        }
    } 
?>