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

if (banned($id) > 0) {
    echo " 
            <script>                
                alert('Username $id telah terbanned');
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
