<?php 

include "../connection/config.php";

$idpemasok  = $_GET['idpemasok'];

if(!isset($idpemasok)) {
    echo "
    <script>alert('Data tidak ditemukan!');</script>
    ";
}

$sql = mysqli_query($connect, "DELETE FROM tbpemasok WHERE idpemasok = $idpemasok");
if($sql) {
    echo "
    <script>alert('Data pemasok berhasil dihapus!');
    window.location.href = './pemasok.php'</script>
    ";
} else {
    echo "
    <script>alert('Data pemasok tidak berhasil dihapus!');
    window.location.href = './pemasok.php'</script>
    ";
}

?>