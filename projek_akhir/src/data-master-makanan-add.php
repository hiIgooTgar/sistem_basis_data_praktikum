<?php
$title_web = "Tambah Data Makanan - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-makanan-add">
        <div class="sub-title-header">
            <h2>Form Tambah Data Makanan</h2>
            <a class="btn-primary" href="./data-master-makanan.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama_makanan">Nama Makanan</label>
                        <input type="text" autocomplete="off" required name="nama_makanan" id="nama_makanan">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" autocomplete="off" required name="harga" id="harga">
                    </div>
                </div>

                <button type="submit" class="btn-primary" name="add-makanan">Kirim</button>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['add-makanan'])) {
    $nama_makanan = htmlspecialchars($_POST['nama_makanan']);
    $harga = htmlspecialchars($_POST['harga']);

    $cek_query = mysqli_query($conn, "SELECT * FROM makanan WHERE nama_makanan = '$nama_makanan'");
    if (mysqli_num_rows($cek_query) > 0) {
        echo "<script>alert('Nama Makanan sudah terdaftar');
        window.location.href = 'data-master-makanan-add.php'</script>";
    } else {
        $result = mysqli_query($conn, "INSERT INTO makanan(id_makanan, nama_makanan, harga) VALUES('', '$nama_makanan', '$harga')");
        if ($result) {
            echo "<script>alert('Data Makanan sukses ditambahkan');
            window.location.href = 'data-master-makanan.php'</script>";
        } else {
            echo "<script>alert('Data Makanan gagal ditambahkan');
            window.location.href = 'data-master-makanan-add.php'</script>";
        }
    }
}

?>