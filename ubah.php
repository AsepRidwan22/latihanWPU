<?php

session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if(isset($_POST["submit"] )){
   if(ubah($_POST) > 0){
       echo "
            <script>
                alert('data berhasil ubah');
                document.location.href = 'index.php';
            </script>
       ";
   }else{
       echo "
            <script>
                alert('data berhasil ubah');
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
    <title>ubah Data Mahasiswa</title>
</head>
<body>
    <h1>ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <ul>
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <li>
            <label for="npm">npm</label>
            <input type="text" name="npm" id="npm" required value="<?=$mhs["npm"]; ?>">
        </li>
        <li>
            <label for="gambar">gambar</label><br>
            <img src="img/<?= $mhs['gambar'] ?>" width="40"><br>
            <input type="file" name="gambar" id="gambar" require>
        </li>
        <li>
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama" required value="<?=$mhs["nama"]; ?>">
        </li>
        <li>
            <label for="email">email</label>
            <input type="text" name="email" id="email" required value="<?=$mhs["email"]; ?>">
        </li>
        <li>
            <label for="jurusan">jurusan</label>
            <input type="text" name="jurusan" id="jurusan" required value="<?=$mhs["jurusan"]; ?>">
        </li>
        <li>
            <button type="submit" name="submit">ubah data</button>
        </li>
    </ul>
    </form>
</body>
</html> 