<?php
$title_web = "Daftar Menu - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>


<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-makanan">
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