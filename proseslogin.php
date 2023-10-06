<?php
    require 'connect.php';

    session_start();
    if (!empty($_POST['idpeng'])){
        //Dapatkan maklumat daripada borang
        $user=$_POST['idpeng'];
        $pass=$_POST['katalaluan'];
        $peranan=$_POST['peranan'];
        //Laksanakan kod SQL untuk menyemak penyepadanan maklumat daripada borang dengan 
        //maklumat daripada pangkalan data
        $query=mysqli_query($conn,"SELECT* FROM pengguna WHERE idpeng='$user'
        AND katalaluan='$pass' AND peranan='$peranan'");
        $row=mysqli_fetch_assoc($query);
        if (mysqli_num_rows($query)==0||$row['katalaluan']!=$pass){
            echo"<script>alert('ID Pengguna, kata laluan atau peranan yang salah');
            window.location='index.php'</script>";
        }
        else{
            $_SESSION['idpeng']=$row['idpeng'];
            $_SESSION['level']=$row['peranan'];
            if ($row['peranan']=="Pelajar"){
                header("Location: mainMurid.php");
            }
            else{
                header("Location: mainGuru.php");
            }
        }
    }else{
        echo"<script>alert('Sila isikan semua ruangan!');
        window.location='index.php'</script>";
    }
?>