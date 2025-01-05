<?php
include "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$id_minuman = $_GET['id_minuman'];
if (!isset($id_minuman)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$query = mysqli_query($conn, "DELETE FROM minuman WHERE id_minuman = '$id_minuman'");
if ($query) {
    echo "<script>alert('Data Minuman sukses dihapus');
            window.location.href = 'data-master-minuman.php'</script>";
} else {
    echo "<script>alert('Data Minuman gagal dihapus');
            window.location.href = 'data-master-minuman.php'</script>";
}
