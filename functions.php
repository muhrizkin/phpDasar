<?php
//koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "phpdasar";

$conn = mysqli_connect($host, $username, $password, $database);

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nis = htmlspecialchars($data['nis']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $username = $data['username'];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO datasiswa VALUES
                    (
                        '',
                        '$nis',
                        '$nama',
                        '$email',
                        '$jurusan',
                        '$gambar',
                        '$username'
                    )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        echo " 
            <script>
                alert('pilih gambar');
            </script>
            ";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo " 
            <script>
                alert('bukan gambar');                
            </script>
            ";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo " 
            <script>
                alert('terlalu besar');                
            </script>
            ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;

    // $query = "DELETE FROM datasiswa WHERE id=$id";
    $query = "UPDATE datasiswa SET                                        
                        nis = '',
                        nama = '',
                        email = '',
                        jurusan = '',
                        gambar = ''
                WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function banned($id)
{
    global $conn;

    $query = "DELETE FROM datasiswa WHERE username='$id'";
    $query2 = "DELETE FROM user WHERE username='$id'";
    mysqli_query($conn, $query);
    mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data['id'];
    $nis = htmlspecialchars($data['nis']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE datasiswa SET                                        
                        nis = '$nis',
                        nama = '$nama',
                        email = '$email',
                        jurusan = '$jurusan',
                        gambar = '$gambar'
                WHERE id = $id";
    return mysqli_query($conn, $query);

    //return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM datasiswa WHERE
                    nama LIKE '%$keyword%' OR
                    nis LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%' ";
    return query($query);
}

function register($data)
{
    global $conn;

    $username = strtolower(stripcslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $level = $data['level'];

    $q = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");
    if (mysqli_fetch_assoc($q)) {
        echo " 
            <script>
                alert('username $username sudah ada');                
            </script>
            ";
        return false;
    }

    if ($password != $password2) {
        echo " 
            <script>
                alert('password tidak sesuai');                
            </script>
            ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user VALUES
                    (
                        '',
                        '$username',
                        '$password',
                        '$level'
                    )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function pesan($data)
{
    global $conn;
    $dari = $data['dari'];
    $kepada = $data['kpd'];
    $pesan = htmlspecialchars($data['msg']);

    $query = "INSERT INTO pesan VALUES
                    (
                        '',
                        '$dari',
                        '$kepada',
                        '$pesan'
                    )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function produk($data)
{
    global $conn;
    $barang = htmlspecialchars($data['barang']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);

    $gambar = uploadProduk();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO produk VALUES
                    (
                        '',
                        '$gambar',
                        '$barang',
                        '$harga',
                        '$stok'
                    )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadProduk()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        echo " 
            <script>
                alert('pilih gambar');
            </script>
            ";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo " 
            <script>
                alert('bukan gambar');                
            </script>
            ";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo " 
            <script>
                alert('terlalu besar');                
            </script>
            ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'produk/' . $namaFileBaru);

    return $namaFileBaru;
}

function ubahProduk($data)
{
    global $conn;
    $id = $data['id'];
    $barang = htmlspecialchars($data['barang']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);
    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadProduk();
    }

    $query = "UPDATE produk SET                                        
                        barang = '$barang',
                        harga = '$harga',
                        stok = '$stok',
                        gambar = '$gambar'
                WHERE id = $id";
    return mysqli_query($conn, $query);

    //return mysqli_affected_rows($conn);
}

function hapusProduk($id)
{
    global $conn;

    $query = "DELETE FROM produk WHERE id=$id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cariProduk($keyword)
{
    $query = "SELECT * FROM produk WHERE
                    barang LIKE '%$keyword%' OR
                    harga LIKE '%$keyword%' OR
                    stok LIKE '%$keyword%'  ";
    return query($query);
}

function beliProduk($id, $username)
{
    global $conn;

    $data = query("SELECT * FROM produk WHERE id=$id")[0];
    $gambar = $data['gambar'];
    $barang = $data['barang'];
    $harga = $data['harga'];
    $stok = $data['stok'];

    $query = "INSERT INTO cart VALUES
                    (
                        '',
                        '$gambar',
                        '$barang',
                        '$harga',
                        '$stok',
                        '$username'
                    )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cariCart($keyword)
{
    $query = "SELECT * FROM cart WHERE
                    barang LIKE '%$keyword%' OR
                    harga LIKE '%$keyword%' OR
                    stok LIKE '%$keyword%'  ";
    return query($query);
}