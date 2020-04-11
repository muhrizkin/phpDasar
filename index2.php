<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if($level != '0'){
    header("Location: index2.php");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (pesan($_POST) > 0) {
        echo " 
                    <script>
                        alert('terkirim');
                        document.location.href = 'index2.php';
                    </script>
                ";
    } else {
        echo " 
                    <script>
                        alert('gagal');
                        document.location.href = 'index2.php';
                    </script>
                ";
    }
}

$namaUser = $_SESSION['username'];
$query = "SELECT * FROM datasiswa WHERE username='$namaUser'";


$data = query($query)[0];
$nama = $data['nama'];

if ($nama == '') {
    $name = $namaUser;
} else {
    $name = $nama;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman User</title>
</head>

<body>

    <h1>Hai, <?= $name ?></h1>
    <br>
    <a href="profile.php">Profile</a>

    <a href="logout.php" style="margin-right: 10px">Log Out</a>
    <a href="pesanUser.php" style="margin-right: 10px">Kirim Pesan</a>
    <a href="beli.php">Beli Produk</a>    

</body>

</html>