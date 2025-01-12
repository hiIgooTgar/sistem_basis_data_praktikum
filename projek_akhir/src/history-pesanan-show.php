<?php
$title_web = "Detail Data History Pesanan - SrawungRoso";
include "../koneksi/config.php";
$id_pesanan = $_GET['id_pesanan'];
$query = mysqli_query($conn, "SELECT pesanan.*, detail_pesanan.*, makanan.id_makanan, makanan.nama_makanan, makanan.harga AS harga_makanan, minuman.id_minuman, minuman.nama_minuman, minuman.harga AS harga_minuman, pembayaran.*, users.* FROM pesanan
    LEFT JOIN detail_pesanan ON pesanan.id_pesanan = detail_pesanan.id_pesanan
    LEFT JOIN makanan ON makanan.id_makanan = detail_pesanan.id_makanan
    LEFT JOIN minuman ON minuman.id_minuman = detail_pesanan.id_minuman
    LEFT JOIN pembayaran ON pembayaran.id_pesanan = pesanan.id_pesanan
    LEFT JOIN users ON users.id_users = pesanan.id_users
    WHERE pesanan.id_pesanan = '$id_pesanan'");
$dataPesanan = mysqli_fetch_array($query);

if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan!");
}

include "../components/header.php" ?>


<?php if ($_SESSION['role'] == 1) {  ?>
    <section class="history-pesanan" id="history-pesanan">
        <main class="content">
            <div class="d-pesanan">
                <div class="sub-title-header">
                    <h2 style="display: flex; align-items: center;">Detail Data Pesanan <?php if ($dataPesanan['status_pesanan'] == "diterima") { ?>
                            <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-success">Diterima</p>
                        <?php } else if ($dataPesanan['status_pesanan'] == "proses") { ?>
                            <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-warning">Diproses</p>
                        <?php } else if ($dataPesanan['status_pesanan'] == "gagal") { ?>
                            <p style="margin-left: 0.5rem; padding: 0.4rem;" class="badge-danger">Gagal</p>
                        <?php } ?>
                    </h2>
                    <a class="btn-primary" href="./history-pesanan.php">Kembali</a>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="tgl_pesanan">Tanggal Pesanan</label>
                        <input disabled value="<?= date("D, F d Y g:i A", strtotime($dataPesanan['tgl_pesanan'])) ?>" type="text" name="tgl_pesanan" id="tgl_pesanan">
                    </div>
                    <div class="form-group">
                        <form action="" method="post">
                            <input type="hidden" name="id_pesanan" value="<?= $dataPesanan['id_pesanan'] ?>">
                            <?php $status_pesanan = $dataPesanan['status_pesanan'] ?>
                            <label for="status_pesanan">Status pesanan</label>
                            <div class="d-ubah-pesanan">
                                <select disabled class="select" name="status_pesanan" id="status_pesanan">
                                    <option <?= ($status_pesanan == "proses") ? "selected" : "" ?> value="proses">Proses</option>
                                    <option <?= ($status_pesanan == "diterima") ? "selected" : "" ?> value="diterima">Diterima</option>
                                    <option <?= ($status_pesanan == "gagal") ? "selected" : "" ?> value="gagal">Gagal</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table-pesanan-a">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $dataPesanan['nama_makanan'] ?> <br> <?= $dataPesanan['nama_minuman'] ?></td>
                            <td><?= $dataPesanan['jumlah_makanan'] ?> <br> <?= $dataPesanan['jumlah_makanan'] ?></td>
                            <td>Rp. <?= $dataPesanan['harga_makanan'] ?> <br> Rp. <?= $dataPesanan['harga_minuman'] ?></td>
                            <td>Rp. <?= $dataPesanan['harga_makanan'] * $dataPesanan['jumlah_makanan'] ?> <br> Rp. <?= $dataPesanan['harga_minuman'] * $dataPesanan['jumlah_minuman']  ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total harga pesanan</th>
                            <th id="totalHarga">Rp. <?= ($dataPesanan['harga_makanan'] * $dataPesanan['jumlah_makanan']) + ($dataPesanan['harga_minuman'] * $dataPesanan['jumlah_minuman']) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-pembayaran">
                <div class="sub-title-header">
                    <h2>Detail Data Pembayaran</h2>
                </div>

                <div class="row-form">
                    <div class="form-group">
                        <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                        <input disabled value="<?= date("D, F d Y g:i A", strtotime($dataPesanan['tgl_pembayaran'])) ?>" type="text" name="tgl_pembayaran" id="tgl_pembayaran">
                    </div>
                    <div class="form-group">
                        <label for="gender">Metode pembayaran</label>
                        <?php $metode_pembayaran = $dataPesanan['metode_pembayaran'] ?>
                        <select disabled name="metode_pembayaran" id="metode_pembayaran">
                            <option <?= ($metode_pembayaran == "cash") ? "selected" : "" ?> value="cash">Cash</option>
                            <option <?= ($metode_pembayaran == "debit") ? "selected" : "" ?> value="debit">Debit</option>
                            <option <?= ($metode_pembayaran == "qris") ? "selected" : "" ?> value="qris">Qris</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Total Bayar</label>
                    <input disabled value="Rp. <?= $dataPesanan['jumlah_bayar'] ?>" type="text" name="jumlah_bayar" id="jumlah_bayar">
                </div>
            </div>
        </main>
    </section>
<?php } ?>


<?php include "../components/footer.php" ?>