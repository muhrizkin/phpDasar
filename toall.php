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
$namaUser = $_SESSION['username'];

if (isset($_POST['submit'])) {
    if (pesan($_POST) > 0) {
        echo " 
                    <script>
                        alert('terkirim');
                        document.location.href = 'toall.php';
                    </script>
                ";
    } else {
        echo " 
                    <script>
                        alert('gagal');
                        document.location.href = 'toall.php';
                    </script>
                ";
    }
}

$query2 = "SELECT * FROM user WHERE level='0'";
$data2 = query($query2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Broadcasts Message</title>
</head>

<body>
    <a href="index.php">Back</a>
    <h1>Send :</h1>
    <form action="" method="post">
        <input type="hidden" name="dari" id="dari" value="<?= $namaUser ?>">
        <ul>
            <li>
                <label for="kpd">Kepada :</label>
                <select name="kpd" id="kpd">
                    <option value="toall">To All</option>

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
</body>

</html>