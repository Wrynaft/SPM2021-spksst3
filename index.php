<?php 
require 'connect.php';
?>

<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/1529aa3718.js"></script>
</head>
<body>
<h1 id="tajuk">Sistem Penilaian Kuiz Subjek Sains Tingkatan 3</h1>
<br>
<hr id="garisan" style="width:30%; height:4px; border-width:0; background-color: #b3ccff;">
<p class="motto" id="motto">ilmu di cengkaman anda</p>
<img class="imgcenter" src="Assets/book2.png">
<div class="center">
<button class="btn" onclick="document.getElementById('modal-wrapper').style.display='block'">MULA</button>
<br><br>
<a class="daftar" href="daftarpeng.php">Daftar</a>
</div>
<div id="modal-wrapper" class="modal">
    <form class="modal-content animate" id="loginform" action="proseslogin.php" method="post">
    <div class="imgcontainer">
        <span onclick="tutup()" class="close" title="Close PopUp">&times;</span>
        <script>
            function tutup(){
                document.getElementById('modal-wrapper').style.display='none';
                document.getElementById('loginform').reset();
            }
        </script>
        <br>
        <h1>SPKSST3</h1>
    </div>
    <div class="container">
        <span class="logintext"><i class="fas fa-user"></i> ID Pengguna</span>
        <input type="text" placeholder="Enter Username" name="idpeng" pattern="[A-Z]{1}[0-9]{3}" title="ID terdiri daripada abjad diikuti dengan 3 digit (eg: A001)" required>
        <span class="logintext"><i class="fas fa-lock"></i> Kata Laluan</span>
        <input type="password" placeholder="Enter Password" name="katalaluan" required>
        <br><br>
        <input type="radio" name='peranan' id="murid" value="Pelajar" required>
        <label for="murid">
            <img class="peranan" src="Assets/murid.png">
        </label>
        <input type="radio" name='peranan' id="guru" value="Guru">
        <label for="guru">
            <img class="peranan" src="Assets/guru.png">
        </label>
        <br><br>
        <button type="submit" class="btn2">Log Masuk</button>
        <a class="daftar2" href="daftarpeng.php" style="margin:auto;display:block;">Pengguna Baharu?</a>
    </div>
    </form>
</div>

<script>
var modal = document.getElementById(‘modal-wrapper’);
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = “none”;
}
}
</script>
</body>
</html>