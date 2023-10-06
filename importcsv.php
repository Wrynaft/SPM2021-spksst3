<?php
    require 'connect.php';
    if (isset($_POST['import'])){
        //Dapatkan nama file yang dimuat naik
        $filename = $_FILES['csvfile']['tmp_name'];
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 
        'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 
        'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 
        'text/plain');
        //Pastikan file bukan file kosong
        if ($_FILES['csvfile']['size']>0 && in_array($_FILES['csvfile']['type'],$csvMimes)){
            $file = fopen($filename,"r");
            fgetcsv($file, 10000,",");
            //Melaksanakan loop untuk menyemak setiap row
            while (($getData=fgetcsv($file, 10000,","))!== FALSE){
                //Memasukkan maklumat daripada row tersebut ke dalam pangkalan data
                $import = "INSERT INTO pengguna (idpeng,nama,katalaluan,peranan,notel) VALUES 
                ('".$getData[0]."','".$getData[1]."','".$getData[2]."','Pelajar','".$getData[3]."')";
                $queryimport = mysqli_query($conn,$import);
                if (!$queryimport){
                    echo "<script>alert('Import pelajar gagal');window.location='senaraimurid.php'</script>";
                } else{
                    echo "<script>alert('Import pelajar berjaya');window.location='senaraimurid.php'</script>";
                }
            }
            fclose($file);
        } else{
            echo "<script>alert('Format fail salah, sila gunakan fail CSV');
            window.location='senaraimurid.php'</script>";
        }
    } 
?>