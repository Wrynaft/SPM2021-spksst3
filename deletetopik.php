<?php
    require 'connect.php';

    if (isset($_POST['idtopik'])){
        //Dapatkan maklumat daripada borang
        $idtopik=$_POST['idtopik'];
        //Laksanakan kod SQL untuk menghapuskan maklumat daripada pangkalan data mengikut idtopik yang didapati
        $soalan=mysqli_query($conn,"SELECT * FROM soalan WHERE idtopik='$idtopik'");
        while ($row = mysqli_fetch_array($soalan)){
            $idsoalan=$row['idsoalan'];
            $delpilihan=mysqli_query($conn,"DELETE FROM pilihan WHERE idsoalan='$idsoalan'");
            if (!$delpilihan){
                echo "<script>alert('Pemadaman pilihan gagal');window.location='mainGuru.php'</script>";
            }
        }
        $delsoalan=mysqli_query($conn,"DELETE FROM soalan WHERE idtopik='$idtopik'");
        $deltopik=mysqli_query($conn,"DELETE FROM topik where idtopik='$idtopik'");
        if (!$delsoalan or !$deltopik){
            echo "<script>alert('Pemadaman topik atau soalan gagal');window.location='koleksisoalan.php'</script>";
        }else{
            echo"<script>alert('Pemadaman topik berjaya');window.location='koleksisoalan.php'</script>";
        }
    } 
?>