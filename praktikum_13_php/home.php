<?php include "./koneksi/config.php";
session_start();

if (!isset($_SESSION['idkaryawan'])) {
    echo "<script>
                alert('Harap login dahulu');
                window.location.href = './';
            </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <main class="home">
        <div class="head">
            <h1 class="welcome">Selamat datang, <span><?= $_SESSION['namakaryawan'] ?></span></h1>
            <h2><?= $_SESSION['jabatan'] ?></h2>
        </div>
        <h2>Praktikum 13, Sistem Basis Data</h2>
        <div class="list-menu">
            <div class="col">
                <a href="./src/karyawan.php">Home</a>
                <a href="./src/karyawan.php">Karyawan</a>
                <a href="./src/karyawan.php">Produk</a>
                <a href="./src/karyawan.php">Pemasok</a>
                <a href="./src/karyawan.php">Kategori</a>
                <a href="./src/karyawan.php">Pembelian</a>
                <a href="./src/karyawan.php">Penjualan</a>
            </div>
            <a class="log" href="./logout.php">Logout</a>
        </div>
    </main>

    <section class="hero">
        <div class="content">
            <h1>Ampu Mart</h1>
        </div>
    </section>
</body>

</html>