<?php 

include "../connection/config.php";

$idkaryawan = $_GET['idkaryawan'];

if(!isset($_GET['idkaryawan'])) {
    echo"<script>alert('Data tidak ditemukan!');</script>";
}


$query = mysqli_query($connect, "DELETE FROM tbkaryawan WHERE idkaryawan = $idkaryawan"); 
if($query) {
    echo"<script>alert('Data karyawan berhasil dihapus!');
    window.location.href = '../'</script>";
} else {
    echo"<script>alert('Data karyawan tidak berhasil dihapus!');
    window.location.href = '../'</script>";
}

?>