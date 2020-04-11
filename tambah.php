<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    if (tambah($_POST) > 0) {
        echo " 
                    <script>                        
                        document.location.href = 'index2.php';
                    </script>
                ";
    } else {
        echo "
            <script>
                alert('gagal');
                document.location.href = 'tambah.php';
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
    <title>Biodata Siswa</title>
</head>

<body>
    <h1>Biodata</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="username" id="username" value="<?= $username ?>">
        <ul>
            <li>
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis" placeholder="Masukkan NIS.." required>
            </li>
            <li>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama.." required>
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="Masukkan Email.." required>
            </li>
            <li>
                <label for="jurusan">Jurusan:</label>
                <input type="text" name="jurusan" id="jurusan" placeholder="Masukkan Jurusan.." required>
            </li>
            <li>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>

</html>