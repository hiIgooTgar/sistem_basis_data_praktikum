<?php
$title_web = "Daftar Menu - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0 || $_SESSION['role'] == 1) {  ?>
    <section class="menu" id="menu">
        <div class="title-header">
            <h1>Daftar Menu di <span>Srawung</span>Roso</h1>
        </div>
        <main class="content">
            <div class="list-makanan">
                <div class="sub-header-list">
                    <h2>Daftar Menu Makanan</h2>
                </div>
                <div class="row">
                    <?php $query = mysqli_query($conn, "SELECT * FROM makanan ORDER BY nama_makanan ASC");
                    while ($dataMakanan = mysqli_fetch_array($query)) { ?>
                        <div class="box">
                            <h4 style="display: flex; align-items: center; gap: 0.3rem"><img src="../assets/icon/bootstrap-icons/caret-down.svg"> <?= $dataMakanan['nama_makanan'] ?></h4>
                            <p>Rp. <?= $dataMakanan['harga'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="list-minuman">
                <div class="sub-header-list">
                    <h2>Daftar Menu Minuman</h2>
                </div>
                <div class="row">
                    <?php $query = mysqli_query($conn, "SELECT * FROM minuman ORDER BY nama_minuman ASC");
                    while ($dataMinuman = mysqli_fetch_array($query)) { ?>
                        <div class="box">
                            <h4 style="display: flex; align-items: center; gap: 0.3rem"><img src="../assets/icon/bootstrap-icons/caret-down.svg"> <?= $dataMinuman['nama_minuman'] ?></h4>
                            <p>Rp. <?= $dataMinuman['harga'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>