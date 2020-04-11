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

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo " 
            <script>
                alert('berhasil');     
                document.location.href = 'index.php';           
            </script>
            ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Admin</title>
</head>

<body>

    <a href="index.php">Back</a>
    <h1>Tambah Admin</h1>

    <form action="" method="post">
        <input type="hidden" name="level" id="level" value="1">
        <ul>
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan Username..">
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password..">
            </li>
            <li>
                <label for="password2">Konfirmasi Password:</label>
                <input type="password" name="password2" id="password2" placeholder="Masukkan Konfirmasi Password..">
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>

</html>