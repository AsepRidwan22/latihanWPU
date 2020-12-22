<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'function.php';

$jumlahDataPerHalaman = 3;
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kampus</title>
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-0">
                    <div class="page-header clearfix">
                        <a href="logout.php">Keluar</a>
                        <h2 class="pull-left">Daftar Mahasiswa</h2>
                        <a href="tambah.php" class="btn btn-success pull-right">Tambah</a>
                    </div>
                    <form action="" method="post">
                        <input type="text" name="keyword" size="30px" autofocus placeholder="Keyword Pencarian" autocomplete="off">
                        <button type="submit" name="cari">Cari</button>
                    </form>
                    <br>
                    <?php if($halamanAktif > 1) : ?>
                        <a href="?halaman=<?= $halamanAktif -1; ?>">&lt;</a>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if($i == $halamanAktif) : ?>
                            <a href="?halaman=<?= $i ?>" style="font-weight: bold; "><?= $i; ?></a>
                        <?php else : ?>
                            <a href="?halaman=<?= $i ?>"><?= $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($halamanAktif < $jumlahHalaman) : ?>
                        <a href="?halaman=<?= $halamanAktif +1; ?>">&gt;</a>
                    <?php endif; ?>
                    <br>
                    <table class='table table-bordered table-striped'>
                        <tr>
                            <th>NO</th>
                            <th>NPM</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $i = 1 ?>
                        <?php foreach($mahasiswa as $row) : ?>
                            <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["npm"]; ?></td>
                            <td><img src="img/<?= $row["gambar"]; ?>" width="50" alt=""></td>
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["email"]; ?></td>
                            <td><?= $row["jurusan"]; ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-info btn-sm btn-edit" class="fa fa-edit">ubah</a>
                                <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm btn-delete">hapus</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>