<?php

session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';
    $conn = mysqli_connect("localhost", "root", "", "asepridwan");

    if(isset($_POST["submit"] )){
       if(tambah($_POST) > 0){
           echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>
           ";
       }else{
           echo "
                <script>
                    alert('data gagal ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="npm">npm</label>
            <input type="text" name="npm" id="npm">
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="email">email</label>
            <input type="text" name="email" id="email">
        </li>
        <li>
            <label for="jurusan">jurusan</label>
            <input type="text" name="jurusan" id="jurusan">
        </li>
        <li>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </li>
    </ul>
    </form>
</body>
</html>