<?php 

include "../connection/config.php";

$idpenjualan = $_GET['idpenjualan'];
if(!isset($idpenjualan)) {
    echo "<script>alert('Data tidak ditemukan!')</script>";
}

$query = "DELETE FROM tbpenjualan WHERE idpenjualan = $idpenjualan";
$sql = mysqli_query($connect, $query);

if($sql) {
    echo "
    <script>alert('Data penjual berhasil dihapus!');
    window.location.href = './penjualan.php'</script>
    ";
} else {
    echo "
    <script>alert('Data penjual tidak berhasil dihapus!');
    window.location.href = './penjualan.php'</script>
    ";
}
 
?>