<?php
include "./koneksi/config.php";
session_start();

if (!isset($_SESSION['id_users'])) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = 'login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Srawung Roso</title>
    <link rel="stylesheet" href="./assets/css/fonts.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="./">Srawung Roso</a>
            </div>
            <div class="nav-list">
                <a href="./" class="nav-link">Home</a>
                <a href="" class="nav-link"></a>
            </div>
        </nav>
    </header>
    <h1><?= $_SESSION['nama'] ?></h1>
    <h1><?= $_SESSION['alamat'] ?></h1>
</body>

</html>