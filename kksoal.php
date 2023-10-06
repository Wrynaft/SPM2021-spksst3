<?php
require 'connect.php';
require 'keselamatan.php';
$idpeng=$_SESSION['idpeng'];
$topik = $_SESSION['topik'];
$idtopikq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT idtopik FROM topik WHERE topik='$topik'"));
$idtopik = $idtopikq['idtopik'];
$soalanq = mysqli_query($conn, "SELECT soalan FROM soalan WHERE idtopik='$idtopik'");
$index = -1;
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
        <div class="header">Selamat Datang!</div>
        <div class="info">
            <h1 id="title" style="text-align:center;">Kemas Kini Kuiz</h1>
            <br><br>
            <div id="tambahkuiz">
            <form action="kemaskini.php" method='post' id='borang'>
            <button class="btn" type="submit">Kemas Kini Kuiz</button>
            <br><br>
                Nama Topik: 
                <input type="text" name="topik" id="newtopik" size="25" value="<?php print $topik;?>"/>
                <br><br>
                <hr>

            </div>
            </form>
            <br>
            <button class="tambah" onclick="tambahsoal()"><i class="fas fa-plus"></i></button>
<?php 
while ($soalan = mysqli_fetch_array($soalanq)){
    $index = $index + 1;
    ${"soalan$index"}=$soalan['soalan'];
    $question=$soalan['soalan'];
    $idsoalq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM soalan WHERE soalan='$question' ORDER BY CAST(substr(idsoalan,2,6) AS int)"));
    $idsoal = $idsoalq['idsoalan'];
    $pilihanq = mysqli_query($conn, "SELECT * FROM pilihan WHERE idsoalan='$idsoal'ORDER BY CAST(substr(idpilihan,2,6) AS int)");
    $indexp = 0;
    $ans1 = $ans2 = $ans3 = $ans4 = "";
    while ($pilihan = mysqli_fetch_array($pilihanq)){
        $indexp = $indexp + 1;
        if ($indexp == 1){
            ${"pilihanA$index"}=$pilihan['pilihan'];
            if ($pilihan['jwp'] == "1"){
                $ans1 = "checked";
            }
        } elseif ($indexp == 2){
            ${"pilihanB$index"}=$pilihan['pilihan'];
            if ($pilihan['jwp'] == "1"){
                $ans2 = "checked";
            }
        } elseif ($indexp == 3){
            ${"pilihanC$index"}=$pilihan['pilihan'];
            if ($pilihan['jwp'] == "1"){
                $ans3 = "checked";
            }
        } else {
            ${"pilihanD$index"}=$pilihan['pilihan'];
            if ($pilihan['jwp'] == "1"){
                $ans4 = "checked";
            }
        }
        }
    echo '<script>
    index = '.$index.'
                    var radio = \'jwp[\'+index+\']\';
                    var options = document.getElementById("borang");
                    var sasaran = options.lastElementChild;
                    var divElement = document.createElement("div");
                    divElement.id=\'soalan\'+index;
                    divElement.innerHTML =
                        "<br>Soalan:<form action=\'deletesoal.php\' method=\'post\' style=\'display:inline;\' id=\'delform\'><input type=\'hidden\' name=\'soalan\' value=\''.${"soalan$index"}.'\'><button type=\'submit\' class=\'fabutton\' onclick=\'return confirm(\"Adakah anda pasti mahu memadam soalan ini?\");\'><i class=\'fas fa-times\'></i></button></form>"+
                        "<input type=\'text\' name=\'soalan[]\' size=\'25\' value=\''.${"soalan$index"}.'\' required/>"+
                        "<br><br>"+
                    "<div class=\'options\'>"+
                "Pilihan: "+
                "<br><br>" +
                "<input type=\'radio\' name=\'"+radio+"\' id=\'pilihanA"+index+"\' value=\'A\''.$ans1.' required>"+
                "<label for=\'pilihanA"+index+"\'>" +
                    "<i class=\'fas fa-check-circle\'></i>"+
                "</label>"+
                "<input type=\'text\' name=\'pilihan1[]\' size=\'25\' value=\''.${"pilihanA$index"}.'\' />"+
                "<br>"+
                "<input type=\'radio\' name=\'"+radio+"\' id=\'pilihanB"+index+"\' value=\'B\''.$ans2.'>"+
                "<label for=\'pilihanB"+index+"\'>"+
                    "<i class=\'fas fa-check-circle\'></i>"+
                "</label>"+
                "<input type=\'text\' name=\'pilihan2[]\' size=\'25\' value=\''.${"pilihanB$index"}.'\'/>"+
                "<br>"+
                "<input type=\'radio\' name=\'"+radio+"\' id=\'pilihanC"+index+"\' value=\'C\''.$ans3.'>"+
                "<label for=\'pilihanC"+index+"\'>"+
                    "<i class=\'fas fa-check-circle\'></i>"+
                "</label>"+
                "<input type=\'text\' name=\'pilihan3[]\' size=\'25\' value=\''.${"pilihanC$index"}.'\'/>"+
                "<br>"+
                "<input type=\'radio\' name=\'"+radio+"\' id=\'pilihanD"+index+"\' value=\'D\''.$ans4.'>"+
                "<label for=\'pilihanD"+index+"\'>"+
                    "<i class=\'fas fa-check-circle\'></i>"+
                "</label>"+
                "<input type=\'text\' name=\'pilihan4[]\' size=\'25\' value=\''.${"pilihanD$index"}.'\'/>"+
                "<br><br>"+
                "<hr>"
                sasaran.parentNode.insertBefore(divElement, sasaran.nextSibling);
    </script>';
}
?>
            <script>
                index=<?php echo $index?>;
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