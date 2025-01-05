<?php
include "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$id_makanan = $_GET['id_makanan'];
if (!isset($id_makanan)) {
    echo "<script>alert('Anda harus login dahulu');
    window.location.href = '../login.php'</script>";
}

$query = mysqli_query($conn, "DELETE FROM makanan WHERE id_makanan = '$id_makanan'");
if ($query) {
    echo "<script>alert('Data Makanan sukses dihapus');
            window.location.href = 'data-master-makanan.php'</script>";
} else {
    echo "<script>alert('Data Makanan gagal dihapus');
            window.location.href = 'data-master-makanan.php'</script>";
}
