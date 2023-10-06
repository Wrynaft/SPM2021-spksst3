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
        <i class="fas fa-arrow-circle-left" onClick="javascript:window.location='index.php'"></i>
        <img class="daftarpic" src="Assets/quill2.jpg">
        <div class="center">
            <h1 style="text-align:center;">Sistem Penilaian Kuiz Subjek Sains Tingkatan 3</h1>
            <h2 style="text-align:center;">Daftar Pengguna</h2>
        </div>
        <div class="center">
        <form action="prosesregister.php" method="post">
            <p style="text-align:center;"> ID Pengguna:<br>
            <input type="text" name="idpeng" maxlength="4" size="25" pattern="[A-Z]{1}[0-9]{3}" title="ID terdiri daripada abjad diikuti dengan 3 digit (eg:A001)" required>
            <br><br>
            Nama: <br>
            <input type="text" name="nama" size="25"/>
            <br><br>
            Nombor Telefon: <br>
            <input type="tel" name="notel" placeholder="Tanpa -" pattern="[0-9]{11}|[0-9]{10}" title="Nombor terdiri daripada 10 atau 11 digit tanpa -" required>
            <br><br>
            Kata Laluan: <br>
            <input type="password" name="katalaluan" size="25" />
            <br><br>
            Pengesahan Kata Laluan: <br>
            <input type="password" name="pengesahan" size="25" />
            <br><br>
            Peranan: <br>
            <select name="peranan">
                <option value="Pelajar">Pelajar</option>
                <option value="Guru">Guru</option>
            </select>
            <br><br>
            <button type="submit" class="btn3">Daftar!</button>
            </p>
        </form>
        </div>
</div>
    </body>
</html>