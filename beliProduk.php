<?php
session_start();
require 'functions.php';

$level = $_SESSION['level'];
if ($level != '0') {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$namaUser = $_SESSION['username'];

$data = query("SELECT * FROM produk WHERE id=$id")[0];
$nama = $data['barang'];



if (beliProduk($id, $namaUser) > 0) {
    echo " 
            <script>                
                alert('Produk $nama berhasil masuk cart');
                document.location.href = 'cart.php';
            </script>
            ";
} else {
    echo " 
            <script>
                alert('gagal');
                document.location.href = 'beli.php';
            </script>
            ";
}
