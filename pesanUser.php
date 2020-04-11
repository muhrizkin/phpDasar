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

$namaUser = $_SESSION['username'];
$query = "SELECT * FROM datasiswa WHERE username='$namaUser'";


$data = query($query)[0];
$nama = $data['nama'];

if ($nama == '') {
    $name = $namaUser;
} else {
    $name = $nama;
}

$query2 = "SELECT * FROM user WHERE level='0' EXCEPT SELECT * FROM user WHERE username='$namaUser'";
$data2 = query($query2);

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
    <a href="index2.php">Back</a>
    <h1>Kirim Pesan</h1>    


    <form action="" method="post">
        <input type="hidden" name="dari" id="dari" value="<?= $namaUser ?>">
        <ul>
            <li>
                <label for="kpd">Kepada :</label>
                <select name="kpd" id="kpd">
                    <?php
                    foreach ($data2 as $row) {
                        $a = $row['username'];
                        echo "<option value='$a'>$a</option>";
                    }

                    ?>



                </select>
            </li>
            <li>
                <label for="msg">Pesan :</label>
                <input type="text" name="msg" id="msg">
            </li>
            <li>
                <button type="submit" name="submit">Kirim</button>
            </li>
        </ul>
    </form>
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