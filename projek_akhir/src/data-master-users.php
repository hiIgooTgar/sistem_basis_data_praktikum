<?php
$title_web = "Data Pengguna - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-users">
        <div class="list-link-data">
            <a href="./data-master-users-add.php" class="btn-add">Tambah Pengguna</a>
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
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $query = mysqli_query($conn, "SELECT * FROM users");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $data['nama']  ?></td>
                            <td><?= $data['username']  ?></td>
                            <td><?php if ($data['gender'] == "L") {
                                    echo "Laki-laki";
                                } else if ($data['gender'] == "P") {
                                    echo "Perempuan";
                                }  ?></td>
                            <td><?= $data['no_telp']  ?></td>
                            <td>
                                <a class="btn-show" href="./data-master-users-show.php?id_users=<?= $data['id_users'] ?>"><img src="../assets/icon/bootstrap-icons/eye-fill.svg"></a>
                                <a class="btn-edit" href="./data-master-users-edit.php?id_users=<?= $data['id_users'] ?>"><img src="../assets/icon/bootstrap-icons/pencil-square.svg"></a>
                                <a onclick="return confirm('Data Pengguna ingin dihapus?');" class="btn-delete" href="./data-master-users-delete.php?id_users=<?= $data['id_users'] ?>"><img src="../assets/icon/bootstrap-icons/trash-fill.svg"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>