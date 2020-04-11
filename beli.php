<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if ($level != '0') {
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
    <title>Beli Produk</title>
</head>

<body>

    <a href="index2.php">Back</a>
    <a href="cart.php" style="margin-left: 10px">Cart</a>
    <h1>Produk</h1>

    <form action="" method="post">
        <input type="search" name="keyword" id="keyword" placeholder="Cari Produk.." <?php if ($hidden == false) : ?> required <?php endif; ?>>
        <button type="submit" name="cari">Cari</button>
        <?php if ($hidden == true) : ?>
            <button type="submit" name="back">Back</button>
        <?php endif; ?>
    </form>
<br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>            
            <th>Gambar</th>
            <th>Barang</th>            
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?= $i; ?></td>                
                <td>
                    <img src="produk/<?= $row['gambar'] ?>" alt="" width="50">
                </td>
                <td><?= $row['barang'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stok'] ?></td>                
                <td>
                    <a href="beliProduk.php?id=<?= $row['id'] ?>">Beli</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>