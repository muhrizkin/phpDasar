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

$data = query("SELECT * FROM datasiswa");
$hidden = false;

if (isset($_POST['cari'])) {
    $data = cari($_POST['keyword']);
    $hidden = true;
}

$namaUser = $_SESSION['username'];

//get data
// $result = mysqli_query($conn,"SELECT * FROM datasiswa");
// var_dump($result);

//fetch :
//mysqli_fetch_row -> return array numeric
//mysqli_fetch_assoc -> return array associative (name table)
//mysqli_fetch_array -> return array numeric & associative (!recomended)
//mysqli_fetch_object -> ex: $data->namee | namee is name table

// $data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin</title>
</head>

<body>


    <h1>Daftar Siswa</h1>

    <form action="" method="post">
        <input type="search" name="keyword" id="keyword" placeholder="Masukkan Keyword.." <?php if ($hidden == false) : ?> required <?php endif; ?>>
        <button type="submit" name="cari">Cari</button>
        <?php if ($hidden == true) : ?>
            <button type="submit" name="back">Back</button>
        <?php endif; ?>
    </form>

    <h2>Selamat Datang, <?= $namaUser ?></h2>

    <br>
    <a href="logout.php">Log Out</a>
    <a href="tambahAdmin.php">Tambah Admin</a>
    <a href="toall.php" style="margin-right: 10px">Broadcasts Message</a>
    <a href="produk.php">Produk</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Username</th>
            <th>Pesan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="ubah.php?id=<?= $row['id'] ?>">Ubah</a> |
                    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('yakin?');">Hapus</a> <br>
                    <a href="banned.php?id=<?= $row['username'] ?>" onclick="return confirm('yakin?');" style="color:red;">Banned</a>
                </td>
                <td>
                    <img src="img/<?= $row['gambar'] ?>" alt="" width="50">
                </td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['username'] ?></td>
                <td>
                    <a href="pesan.php?id=<?= $row['username'] ?>">Lihat Semua Pesan</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>