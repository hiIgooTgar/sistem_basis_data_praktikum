<?php
$title_web = "Data Minuman - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-minuman">
        <div class="list-link-data">
            <a href="./data-master-minuman-add.php" class="btn-add">Tambah Minuman</a>
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
                        <th>Nama Minuman</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $query = mysqli_query($conn, "SELECT * FROM minuman");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $data['nama_minuman']  ?></td>
                            <td>Rp. <?= $data['harga']  ?></td>
                            <td>
                                <a class="btn-edit" href="./data-master-minuman-edit.php?id_minuman=<?= $data['id_minuman'] ?>"><img src="../assets/icon/bootstrap-icons/pencil-square.svg"></a>
                                <a onclick="return confirm('Data Minuman ingin dihapus?');" class="btn-delete" href="./data-master-minuman-delete.php?id_minuman=<?= $data['id_minuman'] ?>"><img src="../assets/icon/bootstrap-icons/trash-fill.svg"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>