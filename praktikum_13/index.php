<?php
include "./connection/config.php";
$title_web = "Main Website | SBD";
include "./components/header.php";

session_start();
if (!isset($_SESSION['idkaryawan'])) {
    echo "
        <script>alert('Anda harus login dahulu');
        document.location.href = './login.php'</script>
        ";
}
?>

<?php include "./components/navbar.php"; ?>

<div class="container">
    <a href="./src/insert_karyawan.php" class="btn btn-primary">Tambah Karyawan</a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Telepone</th>
            <th>Jabatan</th>
            <th>Sandi</th>
            <th>Action</th>
        </tr>
        <?php
        $increment = 1;
        $sql = "SELECT * FROM tbkaryawan ORDER BY idkaryawan DESC";
        $query = mysqli_query($connect, $sql);
        $check = mysqli_num_rows($query);
        if ($check == 0) {
            echo "<tr>
                <td colspan='6' align='center'><h3>Data karyawan Kosong!</h3></td>
            </tr>";
        }
        while ($data = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $increment++ ?></td>
                <td><?= $data['namakaryawan'] ?></td>
                <td><?= $data['teleponkaryawan'] ?></td>
                <td><?= $data['jabatan'] ?></td>
                <td><?= $data['sandi'] ?></td>
                <td>
                    <a href="./src/update_karyawan.php?idkaryawan=<?= $data['idkaryawan'] ?>" class="btn-warning btn-sm">Ubah</a>
                    <a href="./src/delete_karyawan.php?idkaryawan=<?= $data['idkaryawan'] ?>" class="btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php
include "./components/footer.php";
?>