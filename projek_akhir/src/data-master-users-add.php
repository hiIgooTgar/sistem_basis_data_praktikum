<?php
$title_web = "Tambah Data Pengguna - SrawungRoso";
include "../koneksi/config.php";
include "../components/header.php" ?>

<?php if ($_SESSION['role'] == 0) {  ?>
    <section class="data-master" id="data-users-add">
        <div class="sub-title-header">
            <h2>Form Tambah Data Pengguna</h2>
            <a class="btn-primary" href="./data-master-users.php">Kembali</a>
        </div>
        <main class="content">
            <form action="" method="post">
                <div class="row-form">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <option value="0">-- Pilih Jenis Role --</option>
                            <option value="0">Administrator</option>
                            <option value="1">Kostumer</option>
                        </select>
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" autocomplete="off" required name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" autocomplete="off" required name="password" id="password">
                    </div>
                </div>
                <div class="row-form">
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender">
                            <option value="0">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="number" autocomplete="off" required name="no_telp" id="no_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn-primary" name="add-users">Kirim</button>
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
    $role = htmlspecialchars($_POST['role']);

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