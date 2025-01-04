<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Srawung Roso</title>
    <link rel="stylesheet" href="./assets/css/auth.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">
</head>

<body>
    <div class="container">
        <div class="row-auth-registrasi">
            <div class="left-col">
                <a href="./">
                    <div class="home-back">
                        <img src="./assets/icon/bootstrap-icons/house-fill.svg">
                    </div>
                </a>
                <div class="title">
                    <h1>Registrasi Akun</h1>
                    <p>Masukan data-data akun anda</p>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" autocomplete="off" required name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" autocomplete="off" required name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" autocomplete="off" required name="nama" id="nama">
                    </div>
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
                        <input type="text" autocomplete="off" required name="no_telp" id="no_telp">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn-auth" name="registrasi">Registrasi</button>
                    <p class="link-auth">Sudah punya akun? <a href="login.php">Login</a> Sekarang</p>
                </form>
            </div>
            <div class="right-col">
                <main class="content">
                    <h1>Srawung Roso</h1>
                </main>
            </div>
        </div>
    </div>
</body>

</html>

<?php

include "./koneksi/config.php";

if (isset($_POST['registrasi'])) {
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
        window.location.href = 'registrasi.php'</script>";
    } else {
        $result = mysqli_query($conn, "INSERT INTO users(id_users, username, password, nama, gender, no_telp, alamat, role) 
        VALUES('', '$username', '$password', '$nama', '$gender', '$no_telp', '$alamat', '$role')");
        if ($result) {
            echo "<script>alert('Registrasi sukses');
            window.location.href = 'login.php'</script>";
        } else {
            echo "<script>alert('Registrasi gagal');
            window.location.href = 'registrasi.php'</script>";
        }
    }
}


?>