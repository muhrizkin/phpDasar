<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
    if ($_SESSION['level'] == '1') {
        header("Location: index.php");
        exit;
    } else {
        header("Location: index2.php");
        exit;
    }
}

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo " 
            <script>                     
                document.location.href = 'tambah.php';           
            </script>
            ";
        $username = $_POST['username'];
        $_SESSION['login'] = true;
        $_SESSION['level'] = '0';
        $_SESSION['username'] = $username;
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
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    <form action="" method="post">
        <input type="hidden" name="level" id="level" value="0">
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
            <li>
                <a href="login.php">Login</a>
            </li>
        </ul>
    </form>
</body>

</html>