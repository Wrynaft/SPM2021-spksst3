<?php
    require 'connect.php';

    if (!empty($_POST['idpeng'])){
        //Dapatkan maklumat daripada borang
        $user=$_POST['idpeng'];
        $nama=$_POST['nama'];
        $pass=$_POST['katalaluan'];
        $confpass=$_POST['pengesahan'];
        $notel=$_POST['notel'];
        $peranan=$_POST['peranan'];
        //Semak pengesahan kata laluan
        if ($pass==$confpass){
            //Semak sama ada maklumat tersebut pernah didaftar atau tidak
            $query=mysqli_query($conn,"SELECT* FROM pengguna WHERE idpeng='$user'");
            if (mysqli_num_rows($query)==0){
                //Laksanakan kod SQL untuk memasukkan maklumat ke dalam pangkalan data
                $daftar=mysqli_query($conn,"INSERT INTO pengguna (idpeng,katalaluan,nama,peranan,notel) VALUES 
                ('$user','$pass','$nama','$peranan','$notel')");
                echo"<script>alert('Pendaftaran berjaya!');window.location='index.php'</script>";
            }else{
                echo"<script>alert('ID Pengguna telah pernah didaftar!')</script>";
            }
        }else{
            echo"<script>alert('Kedua-dua kata laluan yang dimasukkan tidak sepadan!')</script>";
        }
    }else{
        echo"<script>alert('Sila isikan semua ruangan!');
        window.location='index.php'</script>";
    }
?>