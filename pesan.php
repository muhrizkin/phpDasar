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
$id = $_GET['id'];

$query = "SELECT * FROM user WHERE username='$id'";
$data = query($query)[0];

$namaUser = $data['username'];
$query3 = "SELECT * FROM pesan WHERE kepada='$namaUser' OR kepada='toall'";
$data3 = query($query3);

$query4 = "SELECT * FROM pesan WHERE dari='$namaUser'";
$data4 = query($query4);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesan</title>
</head>

<body>

    <a href="index.php">Back</a>
    <h1>Username : <?= $id ?></h1>
    <br><br>
    <h2>Inbox</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>

            <th>Dari</th>
            <th>Isi Pesan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data3 as $row) : ?>
            <tr>
                <td><?= $i; ?></td>

                <td><?= $row['dari'] ?></td>
                <td><?= $row['pesan'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    <br>
    <h2>Terkirim</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Kepada</th>
            <th>Isi Pesan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data4 as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row['kepada'] ?></td>
                <td><?= $row['pesan'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>