<?php
include "./koneksi/config.php";
session_start();

if (!empty($_SESSION['login'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Srawung Roso</title>
    <link rel="stylesheet" href="./assets/css/auth.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">
</head>

<body>
    <div class="container">
        <main class="row-auth-login">
            <div class="left-col">
                <div class="title">
                    <h1>Login Akun</h1>
                    <p>Masukan dan password anda</p>
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
                    <button type="submit" class="btn-auth" name="login">Login</button>
                    <p class="link-auth">Belum punya akun? <a href="registrasi.php">Registrasi</a> Sekarang</p>
                </form>
            </div>
            <div class="right-col">
                <main class="content">
                    <h1>Srawung Roso</h1>
                </main>
            </div>
        </main>
    </div>
</body>

</html>

<?php

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $cek_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek_query) > 0) {
        $data = mysqli_fetch_array($cek_query);
        if (password_verify($password, $data['password'])) {
            $_SESSION['login'] = 1;
            $_SESSION['id_users'] = $data['id_users'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['gender'] = $data['gender'];
            $_SESSION['no_telp'] = $data['no_telp'];
            $_SESSION['alamat'] = $data['alamat'];
            $_SESSION['role'] = $data['role'];
            header("Location: ./");
        } else {
            echo "<script>alert('Password anda salah');
            window.location.href = 'login.php'</script>";
        }
    } else {
        echo "<script>alert('Username dan password anda salah');
            window.location.href = 'login.php'</script>";
    }
}


?>