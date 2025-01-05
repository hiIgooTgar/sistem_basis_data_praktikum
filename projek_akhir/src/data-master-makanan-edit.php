<?php
$title_web = "Ubah Data Makanan - SrawungRoso";
include "../koneksi/config.php";

$id_makanan = $_GET['id_makanan'];
if (!isset($id_makanan)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$sql = mysqli_query($conn, "SELECT * FROM makanan WHERE id_makanan = '$id_makanan'");
$dataUsers = mysqli_fetch_array($sql);

if (mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
}

include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-makanan-edit">
        <div class="sub-title-header">
            <h2>Form Ubah Data Makanan</h2>
            <a class="btn-primary" href="./data-master-makanan.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <input value="<?= $dataUsers['id_makanan'] ?>" type="hidden" name="id_makanan" id="id_makanan">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama_makanan">Nama Makanan</label>
                        <input autocomplete="off" required value="<?= $dataUsers['nama_makanan'] ?>" type="text" name="nama_makanan" id="nama_makanan">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input autocomplete="off" required value="<?= $dataUsers['harga'] ?>" type="number" name="harga" id="harga">
                    </div>
                </div>
                <button type="submit" class="btn-primary" name="edit-makanan">Ubah</button>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['edit-makanan'])) {
    $id_makanan = htmlspecialchars($_POST['id_makanan']);
    $nama_makanan = htmlspecialchars($_POST['nama_makanan']);
    $harga = htmlspecialchars($_POST['harga']);

    $result = mysqli_query($conn, "UPDATE makanan SET nama_makanan = '$nama_makanan', harga = '$harga' WHERE id_makanan = '$id_makanan'");
    if ($result) {
        echo "<script>alert('Data Makanan sukses diubah');
            window.location.href = 'data-master-makanan.php'</script>";
    } else {
        echo "<script>alert('Data Makanan gagal diubah');
            window.location.href = 'data-master-makanan-add.php'</script>";
    }
}

?>