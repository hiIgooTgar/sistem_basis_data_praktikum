<?php
$title_web = "Tambah Data Pengguna - SrawungRoso";
include "../koneksi/config.php";
$id_users = $_GET['id_users'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE id_users = '$id_users'");
$dataUsers = mysqli_fetch_array($sql);

// Encode dan Decode
$encPass = base64_encode($dataUsers['password']);
$decPass = base64_decode($encPass);

include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-users-show">
        <div class="sub-title-header">
            <h2>Detail Data Pengguna</h2>
            <a class="btn-primary" href="./data-master-users.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input disabled value="<?= $dataUsers['nama'] ?>" type="text" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <?php $role = $dataUsers['role'] ?>
                        <select disabled name="role" id="role">
                            <option value="0">-- Pilih Jenis Role --</option>
                            <option <?= ($role == "0") ? "selected" : "" ?> value="0">Administrator</option>
                            <option <?= ($role == "1") ? "selected" : "" ?> value="1">Kostumer</option>
                        </select>
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input disabled value="<?= $dataUsers['username'] ?>" type="text" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input disabled value="password bersifat private" type="text" name="password" id="password">
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <?php $gender = $dataUsers['gender'] ?>
                        <select disabled name="gender" id="gender">
                            <option value="0">-- Pilih Jenis Kelamin --</option>
                            <option <?= ($gender == "L") ? "selected" : "" ?> value="L">Laki-laki</option>
                            <option <?= ($gender == "P") ? "selected" : "" ?> value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input disabled value="<?= $dataUsers['no_telp'] ?>" type="number" name="no_telp" id="no_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea disabled name="alamat" id="alamat" cols="30" rows="10"><?= $dataUsers['alamat'] ?></textarea>
                </div>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['add-users'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $nama = htmlspecialchars($_POST['nama']);
    $gender = htmlspecialchars($_POST['gender']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $role = 1;

    $cek_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek_query) > 0) {
        echo "<script>alert('Username sudah terdaftar');
        window.location.href = 'data-master-users.php'</script>";
    } else {
        $result = mysqli_query($conn, "INSERT INTO users(id_users, username, password, nama, gender, no_telp, alamat, role) 
        VALUES('', '$username', '$password', '$nama', '$gender', '$no_telp', '$alamat', '$role')");
        if ($result) {
            echo "<script>alert('Data Pengguna sukses ditambahkan');
            window.location.href = 'data-master-users.php'</script>";
        } else {
            echo "<script>alert('Data Pengguna gagal ditambahkan');
            window.location.href = 'data-master-users-add.php'</script>";
        }
    }
}

?>