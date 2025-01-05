<?php
include "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$id_users = $_GET['id_users'];
if (!isset($id_users)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$query = mysqli_query($conn, "DELETE FROM users WHERE id_users = '$id_users'");
if ($query) {
    echo "<script>alert('Data Pengguna sukses dihapus');
            window.location.href = 'data-master-users.php'</script>";
} else {
    echo "<script>alert('Data Pengguna gagal dihapus');
            window.location.href = 'data-master-users.php'</script>";
}
