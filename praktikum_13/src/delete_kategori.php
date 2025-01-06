<?php 

require '../connection/config.php';

$idkategori = $_GET['idkategori'];

if(!isset($idkategori)) {
    echo"<script>alert('Data tidak ditemukan!');</script>";
}

$sql = "DELETE FROM tbkategori WHERE idkategori = $idkategori";
$result = mysqli_query($connect, $sql);

if($result) {
    echo "
    <script>
    alert('Data kategori berhasil dihapus!');
    document.location.href = './kategori.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data kategori berhasil dihapus!');
    document.location.href = './kategori.php';
    </script>
    ";
}


?>