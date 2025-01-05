<?php
$title_web = "Data Makanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-makanan">
        <div class="list-link-data">
            <a href="./data-master-makanan-add.php" class="btn-add">Tambah Makanan</a>
            <div class="box">
                <a href="./data-master-users.php">Data Pengguna</a>
                <a href="./data-master-makanan.php">Data Makanan</a>
                <a href="./data-master-minuman.php">Data Minuman</a>
            </div>
        </div>
        <main class="content">
            <table id="myDataTables" class="display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Makanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $query = mysqli_query($conn, "SELECT * FROM makanan");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $data['nama_makanan']  ?></td>
                            <td>Rp. <?= $data['harga']  ?></td>
                            <td>
                                <a class="btn-edit" href="./data-master-makanan-edit.php?id_makanan=<?= $data['id_makanan'] ?>"><img src="../assets/icon/bootstrap-icons/pencil-square.svg"></a>
                                <a onclick="return confirm('Data Makanan ingin dihapus?');" class="btn-delete" href="./data-master-makanan-delete.php?id_makanan=<?= $data['id_makanan'] ?>"><img src="../assets/icon/bootstrap-icons/trash-fill.svg"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>