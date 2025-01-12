<?php
$title_web = "History Pesanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>


<?php if ($_SESSION['role'] == 1) {  ?>
    <section class="history-pesanan" id="history-pesanan">
        <?php if ($_SESSION['role'] == 1) {  ?>
            <div class="d-pesan-menu">
                <h2>Pesanan Saya</h2>
                <a href="./pesanan.php" style="display: flex; align-items: center; gap: 0.5rem" class="btn-primary"><img style="filter: invert(100%);" src="../assets/icon/bootstrap-icons/fast-forward-circle.svg"> Pesan Menu</a>
            </div>
        <?php } ?>
        <main class="content">
            <div class="row">
                <?php
                $a = 1;
                $id_session = $_SESSION['id_users'];
                $query = mysqli_query($conn, "SELECT pesanan.*, detail_pesanan.*, pembayaran.*, users.* FROM pesanan
                LEFT JOIN detail_pesanan ON pesanan.id_pesanan = detail_pesanan.id_pesanan
                LEFT JOIN pembayaran ON pembayaran.id_pesanan = pesanan.id_pesanan
                LEFT JOIN users ON users.id_users = pesanan.id_users
                WHERE users.id_users = '$id_session'");
                if (mysqli_num_rows($query) == 0) {
                    echo "<h2 class='kt-kosong'>Pesanan anda kosong!</h2>";
                }
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="box-pesanan">
                        <div class="header">
                            <p><?= date("D, F m Y - g:i A", strtotime($data['tgl_pesanan'])) ?></p>
                            <?php if ($data['status_pesanan'] == "diterima") { ?>
                                <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-sm badge-success">Diterima</p>
                            <?php } else if ($data['status_pesanan'] == "proses") { ?>
                                <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-sm badge-warning">Diproses</p>
                            <?php } else if ($data['status_pesanan'] == "gagal") { ?>
                                <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-sm badge-danger">Gagal</p>
                            <?php } ?>
                        </div>
                        <div class="body-box">
                            <h3>Pesanan <?= $a++  ?> - <?= $_SESSION['nama'] ?></h3>
                        </div>
                        <div class="footer-box">
                            <p><span>Srawung</span>Roso</p>
                            <a class="btn-primary-pesanan" href="./history-pesanan-show.php?id_pesanan=<?= $data['id_pesanan'] ?>"><img src="../assets/icon/bootstrap-icons/eye-fill.svg"></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </section>
<?php } ?>


<?php include "../components/footer.php" ?>