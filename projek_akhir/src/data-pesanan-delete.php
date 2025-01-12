<?php
include "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$id_pesanan = $_GET['id_pesanan'];
if (!isset($id_pesanan)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$query = mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'");
if ($query) {
    echo "<script>alert('Data Pesanan sukses dihapus');
            window.location.href = 'data-pesanan.php'</script>";
} else {
    echo "<script>alert('Data Pesanan gagal dihapus');
            window.location.href = 'data-pesanan.php'</script>";
}
