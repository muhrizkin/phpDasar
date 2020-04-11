<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if ($level != '1') {
    header("Location: index2.php");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM produk WHERE id=$id")[0];



if (isset($_POST['submit'])) {
    if (ubahProduk($_POST) > 0) {

        echo " 
                <script>
                    alert('berhasil');
                    document.location.href = 'produk.php';
                </script>
                ";
    } else {
        echo "
            <script>
                alert('gagal');
                document.location.href = 'ubah.php';
            </script>
            ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Produk</title>
</head>

<body>



    <a href="produk.php">Back</a>

    <h1>Ubah Data</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $data['gambar'] ?>">
        <ul>
            <li>
                <label for="gambarLama">Gambar : </label>
                <img src="produk/<?= $data['gambar'] ?>" width="100">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="barang">Nama Barang :</label>
                <input type="text" name="barang" id="barang" placeholder="Masukkan Nama Barang.." required value="<?= $data['barang'] ?>">
            </li>
            <li>
                <label for="harga">Harga :</label>
                <input type="number" name="harga" id="harga" placeholder="Masukkan Harga.." required value="<?= $data['harga'] ?>">
            </li>
            <li>
                <label for="stok">Stok : </label>
                <input type="text" name="stok" id="stok" placeholder="Masukkan Stok.." required value="<?= $data['stok'] ?>">
            </li>

            <li>
                <button type="submit" name="submit">Ubah</button>
            </li>
        </ul>
    </form>
</body>

</html>