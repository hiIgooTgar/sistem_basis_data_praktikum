<?php
$title_web = "Pesanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php";

if ($_SESSION['role'] == 1) { ?>
    <section class="pesanan" id="pesanan">
        <main class="content">
            <form action="" method="post">
                <div class="left-col">
                    <div class="list-makanan">
                        <h2>Pesan Makanan</h2>
                        <div class="form-group">
                            <select name="id_makanan" id="makanan" required>
                                <option value="" disabled selected>Pilih Makanan</option>
                                <?php
                                $queryMakanan = mysqli_query($conn, "SELECT * FROM makanan ORDER BY nama_makanan ASC");
                                while ($rowMakanan = mysqli_fetch_array($queryMakanan)) { ?>
                                    <option value="<?= $rowMakanan['id_makanan'] ?>" data-harga="<?= $rowMakanan['harga'] ?>">
                                        <?= $rowMakanan['nama_makanan'] ?> - Rp. <?= $rowMakanan['harga'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="jumlah_makanan" placeholder="Jumlah Makanan" name="jumlah_makanan">
                        </div>
                        <button class="btn-primary" type="button" onclick="addMakanan()">Tambah Makanan</button>
                    </div>

                    <div class="list-minuman">
                        <h2>Pesan Minuman</h2>
                        <div class="form-group">
                            <select name="id_minuman" id="minuman" required>
                                <option value="" disabled selected>Pilih Minuman</option>
                                <?php
                                $queryMinuman = mysqli_query($conn, "SELECT * FROM minuman ORDER BY nama_minuman ASC");
                                while ($rowMinuman = mysqli_fetch_array($queryMinuman)) { ?>
                                    <option value="<?= $rowMinuman['id_minuman'] ?>" data-harga="<?= $rowMinuman['harga'] ?>">
                                        <?= $rowMinuman['nama_minuman'] ?> - Rp. <?= $rowMinuman['harga'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="jumlah_minuman" placeholder="Jumlah Minuman" name="jumlah_minuman">
                        </div>
                        <button class="btn-primary" type="button" onclick="addMinuman()">Tambah Minuman</button>
                    </div>
                </div>
                <div class="right-col">
                    <div class="list-bayar">
                        <div class="detail-total-pesanan">
                            <h2>Detail Pesanan Saya</h2>
                            <table border="1" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="detailPesanan"></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th id="totalHarga">Rp. 0</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h2>Pembayaran</h2>
                        <div class="form-group">
                            <select name="metode_pembayaran" id="metode_pembayaran" required>
                                <option value="0" disabled selected>Pilih Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="debit">Debit</option>
                                <option value="qris">Qris</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="total_pesanan" name="total_pesanan" value="">
                            <input type="number" readonly name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar" required>
                        </div>
                    </div>
                    <button type="submit" name="pesan-menu" class="btn-primary" onclick="return confirm('Pesanan sudah siap?')">Pesan</button>
                </div>
            </form>
        </main>
    </section>

    <script>
        let totalHarga = 0;

        function addMakanan() {
            const makananSelect = document.getElementById('makanan');
            const jumlahMakanan = parseInt(document.getElementById('jumlah_makanan').value);

            if (!makananSelect.value || isNaN(jumlahMakanan) || jumlahMakanan <= 0) {
                alert('Pilih makanan dan masukkan jumlah yang valid!');
                return;
            }

            const selectedOption = makananSelect.options[makananSelect.selectedIndex];
            const namaMakanan = selectedOption.text.split(' - ')[0];
            const hargaMakanan = parseInt(selectedOption.getAttribute('data-harga'));
            const subtotal = hargaMakanan * jumlahMakanan;

            addToTable('Makanan', namaMakanan, jumlahMakanan, hargaMakanan, subtotal);
        }

        function addMinuman() {
            const minumanSelect = document.getElementById('minuman');
            const jumlahMinuman = parseInt(document.getElementById('jumlah_minuman').value);

            if (!minumanSelect.value || isNaN(jumlahMinuman) || jumlahMinuman <= 0) {
                alert('Pilih minuman dan masukkan jumlah yang valid!');
                return;
            }

            const selectedOption = minumanSelect.options[minumanSelect.selectedIndex];
            const namaMinuman = selectedOption.text.split(' - ')[0];
            const hargaMinuman = parseInt(selectedOption.getAttribute('data-harga'));
            const subtotal = hargaMinuman * jumlahMinuman;

            addToTable('Minuman', namaMinuman, jumlahMinuman, hargaMinuman, subtotal);
        }

        function addToTable(type, name, qty, price, subtotal) {
            const tableBody = document.getElementById('detailPesanan');
            const row = document.createElement('tr');

            row.innerHTML = `
        <td>${type}: ${name}</td>
        <td>${qty}</td>
        <td>Rp. ${price.toLocaleString()}</td>
        <td>Rp. ${subtotal.toLocaleString()}</td>
        <td><button type="button" onclick="removeRow(this, ${subtotal})">Hapus</button></td>
    `;

            tableBody.appendChild(row);
            updateTotal(subtotal);
        }

        function removeRow(button, subtotal) {
            const row = button.parentElement.parentElement;
            row.remove();
            updateTotal(-subtotal);
        }

        function updateTotal(amount) {
            totalHarga += amount;
            document.getElementById('totalHarga').innerText = `Rp. ${totalHarga.toLocaleString()}`;

            const jumlahBayarInput = document.getElementById('jumlah_bayar');
            jumlahBayarInput.value = totalHarga > 0 ? totalHarga : '';

            const jumlahTotalPesanan = document.getElementById('total_pesanan');
            jumlahTotalPesanan.value = totalHarga > 0 ? totalHarga : '';
        }
    </script>

<?php } ?>

<?php include "../components/footer.php"; ?>

<?php
if (isset($_POST['pesan-menu'])) {
    $tgl_pesanan = date('Y-m-d H:i:s');
    $status_pesanan = 'proses';
    $id_users = $_SESSION['id_users'];

    $queryPesanan = "INSERT INTO pesanan (tgl_pesanan, status_pesanan, id_users) VALUES ('$tgl_pesanan', '$status_pesanan', '$id_users')";
    if (mysqli_query($conn, $queryPesanan)) {
        $id_pesanan = mysqli_insert_id($conn);

        $id_makanan = htmlspecialchars($_POST['id_makanan']);
        $jumlah_makanan = htmlspecialchars($_POST['jumlah_makanan']);
        $id_minuman = htmlspecialchars($_POST['id_minuman']);
        $jumlah_minuman = htmlspecialchars($_POST['jumlah_minuman']);
        $total_pesanan = htmlspecialchars($_POST['total_pesanan']);
        $queryPembayaran = "INSERT INTO detail_pesanan (id_detail_pesanan, id_makanan, jumlah_makanan, id_minuman, jumlah_minuman, total_pesanan, id_pesanan)
                            VALUES ('', '$id_makanan', '$jumlah_makanan', '$id_minuman', '$jumlah_minuman', '$total_pesanan', '$id_pesanan')";
        mysqli_query($conn, $queryPembayaran);

        $jumlah_bayar = htmlspecialchars($_POST['jumlah_bayar']);
        $metode_pembayaran = htmlspecialchars($_POST['metode_pembayaran']);
        $queryPembayaran = "INSERT INTO pembayaran (id_pembayaran, jumlah_bayar, metode_pembayaran, tgl_pembayaran, id_pesanan)
                            VALUES ('', '$jumlah_bayar', '$metode_pembayaran', '$tgl_pesanan', '$id_pesanan')";
        mysqli_query($conn, $queryPembayaran);

        echo "<script>alert('Pesanan berhasil ditambahkan!'); window.location.href='pesanan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>