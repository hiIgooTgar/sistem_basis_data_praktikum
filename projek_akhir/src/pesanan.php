<?php
$title_web = "Pesanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php";

if ($_SESSION['role'] == 0 || $_SESSION['role'] == 1) { ?>
    <section class="pesanan" id="pesanan">
        <main class="content">
            <form action="" method="post">
                <div class="left-col">
                    <div class="list-makanan">
                        <h2>Pesan Makanan</h2>
                        <div class="form-group">
                            <select name="id_makanan" required>
                                <option value="" disabled selected>Pilih Makanan</option>
                                <?php
                                $queryMakanan = mysqli_query($conn, "SELECT * FROM makanan ORDER BY nama_makanan ASC");
                                while ($rowMakanan = mysqli_fetch_array($queryMakanan)) { ?>
                                    <option value="<?php $rowMakanan['id_makanan'] ?>"><?= $rowMakanan['nama_makanan'] ?> - Rp. <?= $rowMakanan['harga'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="jumlah_makanan" placeholder="Jumlah Makanan" required>
                        </div>
                        <button class="btn-primary" type="button" onclick="addItemRowMakanan()">Tambah Item</button>
                    </div>
                    <div class="list-minuman">
                        <h2>Pesan Minuman</h2>
                        <div class="form-group">
                            <select name="id_minuman" required>
                                <option value="" disabled selected>Pilih Minuman</option>
                                <?php
                                $queryMinuman = mysqli_query($conn, "SELECT * FROM minuman ORDER BY nama_minuman ASC");
                                while ($rowMinuman = mysqli_fetch_array($queryMinuman)) { ?>
                                    <option value="<?php $rowMinuman['id_minuman'] ?>"><?= $rowMinuman['nama_minuman'] ?> - Rp. <?= $rowMinuman['harga'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="jumlah_minuman" placeholder="Jumlah Minuman" required>
                        </div>
                        <button class="btn-primary" type="button" onclick="addItemRowMinuman()">Tambah Item</button>
                    </div>
                </div>
                <div class="right-col">
                    <div class="list-bayar">
                        <div class="detail-total-pesanan">
                            <h2>Detail Pesanan Saya</h2>
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <th style="width: 30%;">Makanan</th>
                                    <td style="width: 70%;">
                                        <ol>
                                            <li>Order : Ayam</li>
                                            <li>qty : 1</li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%;">Minuman</th>
                                    <td style="width: 70%;">
                                        <ol>
                                            <li>Ayam Order : </li>
                                            <li>qty : 1</li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%;">Total Pesanan</th>
                                    <td style="width: 70%;">Rp. </td>
                                </tr>
                            </table>
                        </div>
                        <h2>Pembayaran</h2>
                        <div class=" form-group">
                            <select name="id_pembayaran" required>
                                <option value="" disabled selected>Pilih Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="debit">Debit</option>
                                <option value="qris">Qris</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="jumlah_bayar" placeholder="Jumlah Bayar" required>
                        </div>
                    </div>
                    <button type="submit" name="pesan-menu" class="btn-primary" onclick="return confirm('Pesanan sudah siap?')">Pesan</button>
                </div>
            </form>
        </main>
    </section>

    <script>
        function addItemRowMakanan() {
            var container = document.getElementById('list-makanan');
            var newRow = document.createElement('div');
            newRow.className = 'form-group-item';
            newRow.innerHTML = `
            <div class="form-group">
                <select name="id_makanan" required>
                    <option value="" disabled selected>Pilih Makanan</option>
                    <?php
                    $queryMakanan = mysqli_query($conn, "SELECT * FROM makanan ORDER BY nama_makanan ASC");
                    while ($rowMakanan = mysqli_fetch_array($queryMakanan)) { ?>
                        <option value="<?php $rowMakanan['id_makanan'] ?>"><?= $rowMakanan['nama_makanan'] ?> - Rp. <?= $rowMakanan['harga'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="jumlah_makanan" placeholder="Jumlah Makanan" required>
            </div>`;
            container.appendChild(newRow);
        }

        function addItemRowMinuman() {
            var container = document.getElementById('list-minuman');
            var newRow = document.createElement('div');
            newRow.className = 'form-group-item';
            newRow.innerHTML = `
             <div class="form-group">
                <select name="id_minuman" required>
                    <option value="" disabled selected>Pilih Minuman</option>
                    <?php
                    $queryMinuman = mysqli_query($conn, "SELECT * FROM minuman ORDER BY nama_minuman ASC");
                    while ($rowMinuman = mysqli_fetch_array($queryMinuman)) { ?>
                        <option value="<?php $rowMinuman['id_minuman'] ?>"><?= $rowMinuman['nama_minuman'] ?> - Rp. <?= $rowMinuman['harga'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="jumlah_minuman" placeholder="Jumlah Minuman" required>
            </div>`;
            container.appendChild(newRow);
        }
    </script>
<?php } ?>

<?php include "../components/footer.php"; ?>

<?php
if (isset($_POST['pesan-menu'])) {
    $tgl_pesanan = date('Y-m-d H:i:s');
    $status_pesanan = 'proses'; // Status awal
    $id_users = $_SESSION['id_users']; // Sesuai dengan session user yang login

    // Insert ke tabel pesanan
    $queryPesanan = "INSERT INTO pesanan (tgl_pesanan, status_pesanan, id_users) VALUES ('$tgl_pesanan', '$status_pesanan', '$id_users')";
    if (mysqli_query($conn, $queryPesanan)) {
        $id_pesanan = mysqli_insert_id($conn);

        // Proses detail pesanan
        $id_makanan = $_POST['id_makanan'];
        $jumlah_makanan = $_POST['jumlah_makanan'];
        $id_minuman = $_POST['id_minuman'];
        $jumlah_minuman = $_POST['jumlah_minuman'];

        // Ambil harga makanan dan minuman
        $queryHargaMakanan = mysqli_query($conn, "SELECT harga FROM makanan WHERE id_makanan = '$id_makanan'");
        $dataHargaMakanan = mysqli_fetch_array($queryHargaMakanan);
        $hargaMakanan = $dataHargaMakanan['harga'];

        $queryHargaMinuman = mysqli_query($conn, "SELECT harga FROM minuman WHERE id_minuman = '$id_minuman'");
        $dataHargaMinuman = mysqli_fetch_array($queryHargaMinuman);
        $hargaMinuman = $dataHargaMinuman['harga'];

        // Hitung total pesanan
        $totalPesanan = (int)($jumlah_makanan * $hargaMakanan) +  (int)($jumlah_minuman * $hargaMinuman);

        // Insert ke tabel detail_pesanan
        $queryDetailPesanan = "INSERT INTO detail_pesanan (id_makanan, jumlah_makanan, id_minuman, jumlah_minuman, total_pesanan, id_pesanan)
                               VALUES ('$id_makanan', '$jumlah_makanan', '$id_minuman', '$jumlah_minuman', '$totalPesanan', '$id_pesanan')";
        if (mysqli_query($conn, $queryDetailPesanan)) {
            echo "<script>alert('Pesanan berhasil ditambahkan!'); window.location.href='pesanan.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>