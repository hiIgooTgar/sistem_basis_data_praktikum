<?php require "./koneksi/config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/auth.css">
</head>

<body>
    <main class="col-left">
        <form action="" method="post">
            <h1>Login</h1>
            <p>Masukan username dan password anda</p>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="namakaryawan" id="namakaryawan">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="sandi" id="sandi">
            </div>
            <button name="login" type="submit">LOGIN </button>
        </form>
    </main>
    <main class="col-right">
        <div class="content">
            <h2>Ampu Mart</h1>
                <h1>AMIKOM PURWOKERTO</h1>
        </div>
    </main>
</body>

</html>


<?php

if (isset($_POST['login'])) {
    $username  = $_POST['namakaryawan'];
    $password  = $_POST['sandi'];

    $query = mysqli_query($conn, "SELECT * FROM tbkaryawan WHERE namakaryawan = '$username' AND sandi = '$password'");

    $result = mysqli_fetch_array($query);

    if ($result) {
        echo "
        <script>alert('Login berhasil');
        document.location.href = 'home.php'</script>
        ";
    } else {
        echo "
        <script>alert('username dan password anda salah!');
        document.location.href = 'login.php'</script>
        ";
    }
}


?>