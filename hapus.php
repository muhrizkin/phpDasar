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

$data = query("SELECT * FROM datasiswa WHERE id=$id")[0];
$nama = $data['nama'];
$username = $data['username'];

if ($nama != "") {
    if (hapus($id) > 0) {
        echo " 
            <script>                
                alert('Data dari $nama telah terhapus');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo " 
            <script>
                alert('gagal');
                document.location.href = 'index.php';
            </script>
            ";
    }
} else {
    echo " 
            <script>
                alert('Data dari username $username kosong');
                document.location.href = 'index.php';
            </script>
            ";
}
