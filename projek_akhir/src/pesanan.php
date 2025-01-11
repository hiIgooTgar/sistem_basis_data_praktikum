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
                            <select id="makanan" required>
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
                            <input type="number" id="jumlah_makanan" placeholder="Jumlah Makanan" min="1">
                        </div>
                        <button class="btn-primary" type="button" onclick="addMakanan()">Tambah Makanan</button>
                    </div>

                    <div class="list-minuman">
                        <h2>Pesan Minuman</h2>
                        <div class="form-group">
                            <select id="minuman" required>
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
                            <input type="number" id="jumlah_minuman" placeholder="Jumlah Minuman" min="1">
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
        let totalHarga = 0;

        function addMakanan() {
            const makananSelect = document.getElementById('makanan');
            const jumlahMakanan = document.getElementById('jumlah_makanan').value;

            if (!makananSelect.value || !jumlahMakanan || jumlahMakanan <= 0) {
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
            const jumlahMinuman = document.getElementById('jumlah_minuman').value;

            if (!minumanSelect.value || !jumlahMinuman || jumlahMinuman <= 0) {
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
            totalHarga += subtotal;
            document.getElementById('totalHarga').innerText = `Rp. ${totalHarga.toLocaleString()}`;
        }

        function removeRow(button, subtotal) {
            const row = button.parentElement.parentElement;
            row.remove();
            totalHarga -= subtotal;
            document.getElementById('totalHarga').innerText = `Rp. ${totalHarga.toLocaleString()}`;
        }
    </script>

<?php } ?>

<?php include "../components/footer.php"; ?>