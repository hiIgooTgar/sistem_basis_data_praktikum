<?php 

include "../connection/config.php";

$idpelanggan = $_GET['idpelanggan'];

if(!isset($idpelanggan)) {
    echo "<script>alert('Data tidak ditemukan!');</script>";
}

$query = "DELETE FROM tbpelanggan WHERE idpelanggan = $idpelanggan";
$sql = mysqli_query($connect, $query);

if($sql) {
    echo "<script>alert('Data pelanggan berhasil dihapus!');
    window.location.href = './pelanggan.php'</script>";
} else {
    echo "<script>alert('Data pelanggan tidak berhasil dihapus!');
    window.location.href = './pelanggan.php'</script>";
}


?>