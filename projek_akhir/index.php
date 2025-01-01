<?php
include "./koneksi/config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Srawung Roso</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">
</head>

<body>

    <?php
    if (!isset($_SESSION['id_users']) && !isset($_SESSION['role']) == 0 || !isset($_SESSION['role']) == 1) {
    ?>
        <header>
            <nav class="navbar">
                <div class="logo">
                    <a href="./"><span>Srawung</span>Roso</a>
                </div>
                <div class="nav-list">
                    <a href="./" class="nav-link">Home</a>
                    <a href="login.php" class="nav-link">Masuk</a>
                    <a href="registrasi.php" class="nav-link">Daftar</a>
                </div>
            </nav>
        </header>
    <?php } else { ?>
        <?php if ($_SESSION['role'] == 0) { ?>
            <header>
                <nav class="navbar">
                    <div class="logo">
                        <a href="./"><span>Srawung</span>Roso</a>
                    </div>
                    <div class="nav-list">
                        <a href="./" class="nav-link">Home</a>
                        <a href="src/data-master.php" class="nav-link">Data Master</a>
                        <p class="nav-link">Hi, <?= $_SESSION['nama'] ?></p>
                        <a href="logout.php" class="nav-link">Log Out</a>
                    </div>
                </nav>
            </header>
        <?php } ?>


        <?php if ($_SESSION['role'] == 1) { ?>
            <header>
                <nav class="navbar">
                    <div class="logo">
                        <a href="./"><span>Srawung</span>Roso</a>
                    </div>
                    <div class="nav-list">
                        <a href="./" class="nav-link">Home</a>
                        <a href="src/menu.php" class="nav-link">Menu</a>
                        <p class="nav-link">Hi, <?= $_SESSION['nama'] ?></p>
                        <a href="logout.php" class="nav-link btn-logout">Log Out</a>
                    </div>
                </nav>
            </header>
        <?php } ?>
    <?php } ?>

    <section class="hero" id="home">
        <main class="content">
            <h1>Selamat Datang di <span>Srawung</span> Roso</h1>
            <h2>Merasakan Harmoni Rasa dan Suasana Jawa</h2>
            <p>Di Srawung Roso, kami menghadirkan cita rasa autentik Jawa yang memanjakan lidah, dipadukan dengan suasana yang hangat dan penuh kenangan. Temukan kelezatan di setiap sajian kami.</p>
        </main>
    </section>


    <script src="./assets/js/main.js"></script>
</body>

</html>