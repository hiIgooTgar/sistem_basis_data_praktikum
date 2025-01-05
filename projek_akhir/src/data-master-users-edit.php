<?php
$title_web = "Ubah Data Pengguna - SrawungRoso";
include "../koneksi/config.php";

$id_users = $_GET['id_users'];
if (!isset($id_users)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$sql = mysqli_query($conn, "SELECT * FROM users WHERE id_users = '$id_users'");
$dataUsers = mysqli_fetch_array($sql);

if (mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
}

include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-users-show">
        <div class="sub-title-header">
            <h2>Form Ubah Data Pengguna</h2>
            <a class="btn-primary" href="./data-master-users.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <div class="row-form">
                    <input value="<?= $dataUsers['id_users'] ?>" type="hidden" name="id_users" id="id_users">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input autocomplete="off" required value="<?= $dataUsers['nama'] ?>" type="text" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <?php $role = $dataUsers['role'] ?>
                        <select required name="role" id="role">
                            <option value="0">-- Pilih Jenis Role --</option>
                            <option <?= ($role == "0") ? "selected" : "" ?> value="0">Administrator</option>
                            <option <?= ($role == "1") ? "selected" : "" ?> value="1">Kostumer</option>
                        </select>
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input autocomplete="off" required value="<?= $dataUsers['username'] ?>" type="text" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input autocomplete="off" required value="<?= $dataUsers['password'] ?>" type="text" name="password" id="password">
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <?php $gender = $dataUsers['gender'] ?>
                        <select required name="gender" id="gender">
                            <option value="0">-- Pilih Jenis Kelamin --</option>
                            <option <?= ($gender == "L") ? "selected" : "" ?> value="L">Laki-laki</option>
                            <option <?= ($gender == "P") ? "selected" : "" ?> value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input autocomplete="off" required value="<?= $dataUsers['no_telp'] ?>" type="number" name="no_telp" id="no_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea required name="alamat" id="alamat" cols="30" rows="10"><?= $dataUsers['alamat'] ?></textarea>
                </div>
                <button type="submit" class="btn-primary" name="edit-users">Ubah</button>
            </form>
        </main>
    </section>
<?php } ?>

<?php include "../components/footer.php" ?>

<?php

if (isset($_POST['edit-users'])) {
    $id_users = htmlspecialchars($_POST['id_users']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $nama = htmlspecialchars($_POST['nama']);
    $gender = htmlspecialchars($_POST['gender']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $role = htmlspecialchars($_POST['role']);

    $result = mysqli_query($conn, "UPDATE users SET username = '$username', password = '$password', nama = '$nama', gender = '$gender'
    , no_telp = '$no_telp', alamat = '$alamat', role = '$role' WHERE id_users = '$id_users'");
    if ($result) {
        echo "<script>alert('Data Pengguna sukses diubah');
            window.location.href = 'data-master-users.php'</script>";
    } else {
        echo "<script>alert('Data Pengguna gagal diubah');
            window.location.href = 'data-master-users-add.php'</script>";
    }
}

?>