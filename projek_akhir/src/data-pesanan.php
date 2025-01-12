<?php
$title_web = "Data Pesanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>


<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="pesanan" id="pesanan">
        <main class="content">
            <table id="myDataTables" class="display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Makanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Pesanan</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $query = mysqli_query($conn, "SELECT users.nama, pesanan.*, pembayaran.metode_pembayaran, detail_pesanan.total_pesanan FROM pesanan
                    LEFT JOIN detail_pesanan ON pesanan.id_pesanan = detail_pesanan.id_pesanan
                    LEFT JOIN pembayaran ON pembayaran.id_pesanan = pesanan.id_pesanan
                    LEFT JOIN users ON users.id_users = pesanan.id_users
                    ORDER BY tgl_pesanan DESC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $data['nama']  ?></td>
                            <td><?= date("F m Y g:i A", strtotime($data['tgl_pesanan']))  ?></td>
                            <td align="center"><span class="badge-primary"><?= ucfirst($data['metode_pembayaran'])  ?></span></td>
                            <td>Rp. <?= $data['total_pesanan']  ?></td>
                            <td align="center"><?php if ($data['status_pesanan'] == 'diterima') { ?>
                                    <p class="badge-success">Diterima</p>
                                <?php } else if ($data['status_pesanan'] == 'proses') { ?>
                                    <p class="badge-warning">Diproses</p>
                                <?php } else if ($data['status_pesanan'] == 'gagal') { ?>
                                    <p class="badge-danger">Gagal</p>
                                <?php } ?>
                            </td>
                            <td align="center">
                                <a href="./data-pesanan-show.php?id_pesanan=<?= $data['id_pesanan'] ?>" class="btn-show"><img src="../assets/icon/bootstrap-icons/eye-fill.svg" alt=""></a>
                                <a onclick="return confirm('Data pesanan ingin dihapus?')" href="./data-pesanan-delete.php?id_pesanan=<?= $data['id_pesanan'] ?>" class="btn-delete"><img src="../assets/icon/bootstrap-icons/trash-fill.svg" alt=""></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </main>
    </section>
<?php } ?>


<?php include "../components/footer.php" ?>