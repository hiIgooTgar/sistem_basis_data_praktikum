<?php
$title_web = "Tambah Data Minuman - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-minuman-add">
        <div class="sub-title-header">
            <h2>Form Tambah Data Minuman</h2>
            <a class="btn-primary" href="./data-master-minuman.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama_minuman">Nama Minuman</label>
                        <input type="text" autocomplete="off" required name="nama_minuman" id="nama_minuman">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" autocomplete="off" required name="harga" id="harga">
                    </div>
                </div>

                <button type="submit" class="btn-primary" name="add-minuman">Kirim</button>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['add-minuman'])) {
    $nama_minuman = htmlspecialchars($_POST['nama_minuman']);
    $harga = htmlspecialchars($_POST['harga']);

    $cek_query = mysqli_query($conn, "SELECT * FROM minuman WHERE nama_minuman = '$nama_minuman'");
    if (mysqli_num_rows($cek_query) > 0) {
        echo "<script>alert('Nama Minuman sudah terdaftar');
        window.location.href = 'data-master-minuman-add.php'</script>";
    } else {
        $result = mysqli_query($conn, "INSERT INTO minuman(id_minuman, nama_minuman, harga) VALUES('', '$nama_minuman', '$harga')");
        if ($result) {
            echo "<script>alert('Data Minuman sukses ditambahkan');
            window.location.href = 'data-master-minuman.php'</script>";
        } else {
            echo "<script>alert('Data Minuman gagal ditambahkan');
            window.location.href = 'data-master-minuman-add.php'</script>";
        }
    }
}

?>