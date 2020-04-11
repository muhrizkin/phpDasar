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

$data = query("SELECT * FROM produk");
$hidden = false;

if (isset($_POST['cari'])) {
    $data = cariProduk($_POST['keyword']);
    $hidden = true;
}

$namaUser = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin Produk</title>
</head>

<body>
<a href="index.php">Back</a>

    <h1>Produk</h1>

    <form action="" method="post">
        <input type="search" name="keyword" id="keyword" placeholder="Cari Produk.." <?php if ($hidden == false) : ?> required <?php endif; ?>>
        <button type="submit" name="cari">Cari</button>
        <?php if ($hidden == true) : ?>
            <button type="submit" name="back">Back</button>
        <?php endif; ?>
    </form>

    <br>    
    <a href="tambahProduk.php">Tambah Produk</a>    

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Barang</th>            
            <th>Harga</th>
            <th>Stok</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="ubahProduk.php?id=<?= $row['id'] ?>">Ubah</a> |
                    <a href="hapusProduk.php?id=<?= $row['id'] ?>" onclick="return confirm('yakin?');">Hapus</a>                    
                </td>
                <td>
                    <img src="produk/<?= $row['gambar'] ?>" alt="" width="50">
                </td>
                <td><?= $row['barang'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stok'] ?></td>                
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>