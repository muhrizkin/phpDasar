<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if ($level != '1') {
    header("Location: index2.php");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM produk WHERE id=$id")[0];
$nama = $data['barang'];



if (hapusProduk($id) > 0) {
    echo " 
            <script>                
                alert('Produk $nama telah terhapus');
                document.location.href = 'produk.php';
            </script>
            ";
} else {
    echo " 
            <script>
                alert('gagal');
                document.location.href = 'produk.php';
            </script>
            ";
}
