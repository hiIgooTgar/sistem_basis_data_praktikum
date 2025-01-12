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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
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
                    <a href="login.php" class="nav-link badge-sign">Masuk</a>
                    <a href="registrasi.php" class="nav-link badge-sign">Daftar</a>
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
                        <a href="src/menu.php" class="nav-link">Menu</a>
                        <a href="src/data-master-users.php" class="nav-link">Data Master</a>
                        <a href="src/data-pesanan.php" class="nav-link">Pesanan & Pembayaran</a>
                        <p class="badge-primary">Hi, <?= $_SESSION['nama'] ?></p>
                        <a href="logout.php" class="btn-logout">Log Out</a>
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
                        <a href="src/history-pesanan.php" class="nav-link">Pesanan Saya</a>
                        <p class="badge-primary">Hi, <?= $_SESSION['nama'] ?></p>
                        <a href="logout.php" class="btn-logout">Log Out</a>
                    </div>
                </nav>
            </header>
        <?php } ?>
    <?php } ?>

    <img class="hero-image" src="assets/images/hero.jpg">
    <section class="hero" id="home">
        <main class="content">
            <h1>Selamat Datang di <span>Srawung</span>Roso</h1>
            <h2>Merasakan Harmoni Rasa dan Suasana <span>Jawa</span></h2>
            <p>Di Srawung Roso, kami menghadirkan cita rasa autentik Jawa yang memanjakan lidah, dipadukan dengan suasana yang hangat dan penuh kenangan. Temukan kelezatan di setiap sajian kami.</p>
            <button class="btn-menu" type="button">Daftar Menu</button>
        </main>
    </section>


    <section class="about">
        <div class="row">
            <div class="left-col">
                <img src="assets/images/about.jpg" alt="tentang SrawungRoso">
            </div>
            <div class="right-col">
                <h2>Tentang <span>Srawung</span>Roso</h2>
                <p><span>Srawung</span>Roso didirikan pada tahun 1970 oleh Pak Harjo dan Bu Sri, pasangan suami istri yang terinspirasi oleh kekayaan kuliner Jawa. Berawal dari sebuah warung kecil di kampung halaman, mereka menghadirkan hidangan khas dengan cita rasa autentik dan suasana akrab yang mencerminkan budaya Jawa. Nama <span>Srawung</span>Roso diambil dari filosofi Jawa yang berarti “berinteraksi dengan rasa,” mencerminkan semangat mereka untuk menghubungkan hati melalui makanan. Kini, setelah lebih dari lima dekade, <span>Srawung</span>Roso tetap setia pada tradisi, menggabungkan kelezatan masa lalu dengan inovasi modern untuk menciptakan pengalaman kuliner yang hangat, menggugah selera, dan penuh nostalgia.</p>
            </div>
        </div>
    </section>

    <section class="contact">
        <main class="row">
            <div class="left-col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31652.902175067717!2d109.3465901703353!3d-7.397211968265269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559d75fd2e9bb%3A0x4027a76e352e5e0!2sPurbalingga%2C%20Kec.%20Purbalingga%2C%20Kabupaten%20Purbalingga%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1735900536171!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="right-col">
                <h2>Media Sosial <span>Srawung</span>Roso</h2>
                <div class="content">
                    <div class="box">
                        <img src="assets/icon/bootstrap-icons/instagram.svg">
                        <a href="">dapoer_SrawungRoso</a>
                    </div>
                    <div class="box">
                        <img src="assets/icon/bootstrap-icons/facebook.svg">
                        <a href="">dapoer_SrawungRoso</a>
                    </div>
                    <div class="box">
                        <img src="assets/icon/bootstrap-icons/tiktok.svg">
                        <a href="">dapoer_SrawungRoso</a>
                    </div>
                    <div class="box">
                        <img src="assets/icon/bootstrap-icons/youtube.svg">
                        <a href="">dapoer_SrawungRoso</a>
                    </div>
                </div>
                <div class="addres">
                    <i class='bx bx-current-location'></i>
                    <p>Jl. Letkol Isdiman, Bancar, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53316</p>
                </div>
            </div>
        </main>
    </section>

    <footer class="footer-main">
        <p>Created by Igo Tegar Prambudhy | SBD <span>
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </span></p>
    </footer>


    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/boxicons.js"></script>
</body>

</html>