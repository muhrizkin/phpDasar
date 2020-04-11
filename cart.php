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

$username = $_SESSION['username'];

$data = query("SELECT * FROM cart WHERE username='$username'");
$hidden = false;

if (isset($_POST['cari'])) {
    $data = cariCart($_POST['keyword']);
    $hidden = true;
}
var_dump((array) $data);
foreach ($data as $row) {
    $harga = (int) $row['harga'];
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>

<body>

    <a href="beli.php">Back</a>
    <h1>Cart :</h1>

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
            <th>Qty</th>
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
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    <p>Total :</p>

    <p style="color: red; font-style: italic; font-weight: bold; font-size: 30px">Total e belum :(</p>

</body>

</html>