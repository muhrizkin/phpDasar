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


$namaUser = $_SESSION['username'];
$query = "SELECT * FROM datasiswa WHERE username='$namaUser'";

if (query($query) == false) {
    // $row = [];
} else {
    $row = query($query)[0];
}


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
    <title>Profile</title>
</head>

<body>

    <h1>Profile</h1>

    <a href="index2.php">Back</a>

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
        </tr>

        <?php $i = 1; ?>

        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row['id'] ?>">Ubah</a>
            </td>
            <td>
                <img src="img/<?= $row['gambar'] ?>" alt="" width="50">
            </td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?= $row['username'] ?></td>
        </tr>
        <?php $i++; ?>

    </table>

</body>

</html>