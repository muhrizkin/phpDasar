<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if($level != '1'){
    header("Location: index2.php");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (produk($_POST) > 0) {
        echo " 
            <script>
                alert('berhasil');     
                document.location.href = 'produk.php';           
            </script>
            ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Produk</title>
</head>

<body>

    <a href="produk.php">Back</a>
    <h1>Tambah Produk</h1>

    <form action="" method="POST" enctype="multipart/form-data">        
        <ul>
        <li>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="barang">Nama Barang :</label>
                <input type="text" name="barang" id="barang" placeholder="Masukkan Nama Barang.." required>
            </li>
            <li>
                <label for="harga">Harga :</label>
                <input type="number" name="harga" id="harga" placeholder="Masukkan Harga.." required>
            </li>
            <li>
                <label for="stok">Stok :</label>
                <input type="number" name="stok" id="stok" placeholder="Masukkan Stok.." required>
            </li>            
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>

</html>