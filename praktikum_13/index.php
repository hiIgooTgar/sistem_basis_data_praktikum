<?php
include "./connection/config.php";
$title_web = "Main Website | SBD";
include "./components/header.php";

session_start();
if (!isset($_SESSION['idkaryawan'])) {
    echo "
        <script>alert('Anda harus login dahulu');
        document.location.href = './login.php'</script>
        ";
}
?>

<?php include "./components/navbar.php"; ?>

<img class="img-hero-section" src="./assets/img/hero.jpg">
<section class="hero">
    <div class="container-home">
        <main>
            <h2>Selamat datang, <?= $_SESSION['namakaryawan'] ?> - <?= $_SESSION['jabatan'] ?></h2>
            <h1><span>Ampu</span>Mart | Sistem Basis Data</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem laborum eius nesciunt quos accusantium aspernatur dolor dolores doloremque possimus excepturi.</p>
        </main>
    </div>
</section>
<section class="content-home">
    <div class="container-home">
        <div class="list-menu">
            <div class="box">
                <h4>Data Karyawan</h4>
                <p><?php $rows = mysqli_query($connect, "SELECT idkaryawan FROM tbkaryawan");
                    echo mysqli_num_rows($rows); ?></p>
            </div>
            <div class="box">
                <h4>Data Pelanggan</h4>
                <p><?php $rows = mysqli_query($connect, "SELECT idpelanggan FROM tbpelanggan");
                    echo mysqli_num_rows($rows); ?></p>
            </div>
            <div class="box">
                <h4>Data Pemasok</h4>
                <p><?php $rows = mysqli_query($connect, "SELECT idpemasok FROM tbpemasok");
                    echo mysqli_num_rows($rows); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container-home">
        <div class="row">
            <div class="left-col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d989.1458472902798!2d109.2306581!3d-7.4004886!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f9e9fe9a9ad%3A0x31ff43666a49235b!2sCAFE%20UNGU!5e0!3m2!1sid!2sid!4v1736183921563!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="right-col">
                <div class="social">
                    <h3>Sosial Media <span>Ampu</span>Mart</h3>
                    <p>Instagram : ampumart</p>
                    <p>Facebook : ampumart</p>
                    <p>Tiktok : ampumart</p>
                </div>
                <h4>Jl. Letjend Pol. Soemarto, Watumas, Purwanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53127</h4>
            </div>
        </div>
    </div>
</section>

<?php
include "./components/footer.php";
?>