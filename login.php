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

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $id = $row['id'];
            $_SESSION['id'] = $id;

            $level = $row['level'];
            $_SESSION['level'] = $level;
            if ($level == '1') {
                header("Location: index.php");
                exit;
            } else {
                header("Location: index2.php");
                exit;
            }
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">Username / Password salah</p>
    <?php endif; ?>
    <form action="" method="post">
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
                <button type="submit" name="login">Login</button>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>
        </ul>
    </form>
</body>

</html>