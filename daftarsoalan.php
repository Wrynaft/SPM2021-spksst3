<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
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
        <li><a href="mainGuru.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="senaraimurid.php"><i class="fas fa-users"></i>Senarai Murid</a></li>
            <li><a href="rekodmurid.php"><i class="fas fa-clipboard"></i>Prestasi Murid</a></li>
            <li><a href="koleksisoalan.php"><i class="fas fa-book-open"></i>Koleksi Soalan</a></li>
            <li><a href="daftarsoalan.php"><i class="fas fa-plus"></i>Tambah Kuiz</a></li>
            <li><a href="logkeluar.php"><i class="fas fa-sign-out-alt"></i>Log Keluar</a></li>
        </ul>
    </div>
    <div class="main_content">
        <div class="header">Sistem Penilaian Kuiz Subjek Sains Tingkatan 3</div>
        <div class="info">
            <h1 id="title" style="text-align:center;">Tambah Kuiz Baharu</h1>
            <br><br>
            <div id="tambahkuiz">
            <form action="prosesdaftarsoal.php" method='post' id='borang'>
            <button class="btn" type="submit">Tambah Kuiz</button>
            <br><br>
                Nama Topik: 
                <select name="topik" id="oldtopik">
                  <?php
                    $optionquery=mysqli_query($conn, "SELECT*FROM topik");
                    while ($row = mysqli_fetch_array($optionquery)){
                    $option=$row['topik'];
                    echo '<option value="'.$option.'">'.$option.'</option>';
                    }
                    ?>
                </select>
                <input type="text" name="newtopik" id="newtopik" size="25" style="display:none;" />
                <input type="checkbox" id="myCheck" onClick="topikBaharu()"/>
                Topik yang baharu?
                <script>
                function topikBaharu() {
                    var checkBox = document.getElementById("myCheck");
                    var old = document.getElementById("oldtopik");
                    var baharu = document.getElementById("newtopik");
                    if (checkBox.checked == true){
                        old.style.display = "none";
                        baharu.style.display = "inline";
                    } else {
                        old.style.display = "inline";
                        baharu.style.display = "none";
                        baharu.value="";
                    } 
                }
                </script>
                <br><br>
                <hr>
                <br>
                <div id="soalan">
                Soalan: 
                <i class="fas fa-times"></i>
                <input type="text" name="soalan[]" size="25" required/>
                <br><br>
                <div class="options" id="options">
                Pilihan: 
                <br><br>
                <input type="radio" name="jwp[0]" id="pilihanA" value="A" required>
                <label for="pilihanA">
                    <i class="fas fa-check-circle"></i>
                </label>
                <input type="text" name="pilihan1[]" size="25" />
                <br>
                <input type="radio" name="jwp[0]" id="pilihanB" value="B">
                <label for="pilihanB">
                    <i class="fas fa-check-circle"></i>
                </label>
                <input type="text" name="pilihan2[]" size="25" />
                <br>
                <input type="radio" name="jwp[0]" id="pilihanC" value="C">
                <label for="pilihanC">
                    <i class="fas fa-check-circle"></i>
                </label>
                <input type="text" name="pilihan3[]" size="25" />
                <br>
                <input type="radio" name="jwp[0]" id="pilihanD" value="D">
                <label for="pilihanD">
                    <i class="fas fa-check-circle"></i>
                </label>
                <input type="text" name="pilihan4[]" size="25" />
                <br><br>
                <hr>
            </div>
            </div>
            </div>
            </form>
            <br>
            <button class="tambah" onclick="tambahsoal()"><i class="fas fa-plus"></i></button>
            <script>
                index=0
                function tambahsoal() {
                    index = index + 1
                    var radio = "jwp["+index+"]";
                    var options = document.getElementById('borang');
                    var sasaran = options.lastElementChild;
                    var divElement = document.createElement('div');
                    divElement.id="soalan"+index;
                    divElement.innerHTML =
                        '<br>Soalan:<i class="fas fa-times" onclick="delentry(this)"></i>'+
                        '<input type="text" name="soalan[]" size="25" required/>'+
                        '<br><br>'+
                    '<div class="options">'+
                'Pilihan: '+
                '<br><br>' +
                '<input type="radio" name="'+radio+'" id="pilihanA'+index+'" value="A" required>'+
                '<label for="pilihanA'+index+'">' +
                    '<i class="fas fa-check-circle"></i>'+
                '</label>'+
                '<input type="text" name="pilihan1[]" size="25" />'+
                '<br>'+
                '<input type="radio" name="'+radio+'" id="pilihanB'+index+'" value="B">'+
                '<label for="pilihanB'+index+'">'+
                    '<i class="fas fa-check-circle"></i>'+
                '</label>'+
                '<input type="text" name="pilihan2[]" size="25" />'+
                '<br>'+
                '<input type="radio" name="'+radio+'" id="pilihanC'+index+'" value="C">'+
                '<label for="pilihanC'+index+'">'+
                    '<i class="fas fa-check-circle"></i>'+
                '</label>'+
                '<input type="text" name="pilihan3[]" size="25" />'+
                '<br>'+
                '<input type="radio" name="'+radio+'" id="pilihanD'+index+'" value="D">'+
                '<label for="pilihanD'+index+'">'+
                    '<i class="fas fa-check-circle"></i>'+
                '</label>'+
                '<input type="text" name="pilihan4[]" size="25" />'+
                '<br><br>'+
                '<hr>'
                sasaran.parentNode.insertBefore(divElement, sasaran.nextSibling);
                }
                function delentry(elem){
                    var target = document.getElementById(elem.parentNode.id);
                    target.remove();
                }
            </script>
    </div></div>
</div>
</body>
</html>