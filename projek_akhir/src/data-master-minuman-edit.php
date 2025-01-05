<?php
$title_web = "Ubah Data Minuman - SrawungRoso";
include "../koneksi/config.php";

$id_minuman = $_GET['id_minuman'];
if (!isset($id_minuman)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$sql = mysqli_query($conn, "SELECT * FROM minuman WHERE id_minuman = '$id_minuman'");
$dataUsers = mysqli_fetch_array($sql);

if (mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
}

include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-minuman-edit">
        <div class="sub-title-header">
            <h2>Form Ubah Data Minuman</h2>
            <a class="btn-primary" href="./data-master-minuman.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <input value="<?= $dataUsers['id_minuman'] ?>" type="hidden" name="id_minuman" id="id_minuman">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama_minuman">Nama Minuman</label>
                        <input autocomplete="off" required value="<?= $dataUsers['nama_minuman'] ?>" type="text" name="nama_minuman" id="nama_minuman">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input autocomplete="off" required value="<?= $dataUsers['harga'] ?>" type="number" name="harga" id="harga">
                    </div>
                </div>
                <button type="submit" class="btn-primary" name="edit-minuman">Ubah</button>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['edit-minuman'])) {
    $id_minuman = htmlspecialchars($_POST['id_minuman']);
    $nama_minuman = htmlspecialchars($_POST['nama_minuman']);
    $harga = htmlspecialchars($_POST['harga']);

    $result = mysqli_query($conn, "UPDATE minuman SET nama_minuman = '$nama_minuman', harga = '$harga' WHERE id_minuman = '$id_minuman'");
    if ($result) {
        echo "<script>alert('Data Minuman sukses diubah');
            window.location.href = 'data-master-minuman.php'</script>";
    } else {
        echo "<script>alert('Data Minuman gagal diubah');
            window.location.href = 'data-master-minuman-add.php'</script>";
    }
}

?>