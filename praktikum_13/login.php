<?php
require "./connection/config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AmpuMart</title>
    <link rel="stylesheet" href="./assets/css/auth.css">
</head>

<body>
    <main class="col-left">
        <form action="" method="post">
            <h1>Login</h1>
            <p>Masukan <span>username</span> dan <span>password</span> anda</p>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="namakaryawan" required autocomplete="off" id="namakaryawan">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="sandi" required autocomplete="off" id="sandi">
            </div>
            <button name="login" type="submit">Login</button>
        </form>
    </main>
    <main class="col-right">
        <div class="content">
            <h2>Ampu Mart</h1>
        </div>
    </main>
</body>

</html>


<?php

if (isset($_POST['login'])) {
    $username  = $_POST['namakaryawan'];
    $password  = $_POST['sandi'];

    $query = mysqli_query($connect, "SELECT * FROM tbkaryawan WHERE namakaryawan = '$username' AND sandi = '$password'");
    $data = mysqli_fetch_array($query);
    $cek = mysqli_num_rows($query);
    if ($cek > 0) {
        $_SESSION['login'] = 1;
        $_SESSION['namakaryawan'] = $data['namakaryawan'];
        $_SESSION['sandi'] = $data['sandi'];
        $_SESSION['idkaryawan'] = $data['idkaryawan'];
        $_SESSION['teleponkaryawan'] = $data['teleponkaryawan'];
        $_SESSION['jabatan'] = $data['jabatan'];
        echo "
        <script>alert('Login berhasil');
        document.location.href = './'</script>
        ";
    } else {
        echo "
        <script>alert('Username dan password anda salah!');
        document.location.href = './login.php'</script>
        ";
    }
}


?>