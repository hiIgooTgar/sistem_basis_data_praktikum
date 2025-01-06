<?php 

include "../connection/config.php";

$idproduk = $_GET['idproduk'];

if(!isset($idproduk)) {
    echo "
    <script>alert(Data tidak ditemukan!);</script>
    ";
}

$query = "DELETE FROM tbproduk WHERE idproduk = $idproduk";
$result = mysqli_query($connect, $query);

if($result) {
    echo "
    <script>alert('Data produk berhasil dihapus!');
    window.location.href = './produk.php'</script>
    ";
} else {
     echo "
    <script>alert('Data produk tidak berhasil dihapus!');
    window.location.href = './produk.php'</script>
    ";
}


?>