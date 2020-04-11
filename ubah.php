<?php
session_start();
require 'functions.php';


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM datasiswa WHERE id=$id")[0];

$level = $_SESSION['level'];


if (isset($_POST['submit'])) {
    if (ubah($_POST) > 0) {
        if ($level == '1') {
            echo " 
                <script>
                    alert('berhasil');
                    document.location.href = 'index.php';
                </script>
                ";
        } else {
            echo " 
            <script>
                alert('berhasil');
                document.location.href = 'profile.php';
            </script>
            ";
        }
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
    <title>Ubah Data Siswa</title>
</head>

<body>
    <?php if ($level != '1') : ?>
        <a href="profile.php">Back</a>
    <?php else : ?>
        <a href="index.php">Back</a>
    <?php endif; ?>
    <h1>Ubah Data</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $data['gambar'] ?>">
        <ul>
            <li>
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis" placeholder="Masukkan NIS.." required value="<?= $data['nis'] ?>">
            </li>
            <li>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama.." required value="<?= $data['nama'] ?>">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="Masukkan Email.." required value="<?= $data['email'] ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan:</label>
                <input type="text" name="jurusan" id="jurusan" placeholder="Masukkan Jurusan.." required value="<?= $data['jurusan'] ?>">
            </li>
            <li>
                <label for="gambarLama">Gambar:</label>
                <img src="img/<?= $data['gambar'] ?>" width="100">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= $data['username'] ?>" disabled="disabled">
            </li>
            <li>
                <button type="submit" name="submit">Ubah</button>
            </li>
        </ul>
    </form>
</body>

</html>