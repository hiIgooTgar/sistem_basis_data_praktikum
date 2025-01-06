<?php 

include "../connection/config.php";
$title_web = "Tambah Kategori | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";

$idkategori = $_GET['idkategori'];

if(!isset($_GET['idkategori'])) {
    echo "
    <script>alert('Data kategori tidak ditemukan!');
    window.location.href = 'kategori.php'</script>
    ";
}

$query = mysqli_query($connect, "SELECT * FROM tbkategori WHERE idkategori = '$idkategori'");
$dataKategori = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan!");
} 


?>

<div class="container">
     <a href="./kategori.php" class="btn btn-sm">Kembali</a>
    <form method="post" action="" class="form-main">
        <input type="hidden" name="idkategori" value="<?= $dataKategori['idkategori'] ?>">
        <div class="form-group">
            <label for="namakategori" class="form-label">Nama Kategori</label>
            <input value="<?= $dataKategori['namakategori'] ?>" type="text" id="namakategori" autocomplete="off" class="form-control" name="namakategori">
        </div>
        <button name="updateKategori" class="btn btn-primary" type="submit">Update</button>
    </form>
</div>

<?php

if(isset($_POST['updateKategori'])) {
    $idkategori = htmlspecialchars($_POST['idkategori']);
    $namakategori = htmlspecialchars($_POST['namakategori']);

    $query = mysqli_query($connect, "UPDATE tbkategori SET namakategori = '$namakategori' WHERE idkategori = $idkategori");


    if($query) {
        echo "
        <script>alert('Tambah data kategori berhasil diubah!');
        window.location.href = 'kategori.php'</script>
        ";
    } else {
        echo "
        <script>alert('Tambah data kategori tidak berhasil diubah!');
        window.location.href = 'kategori.php'</script>
        ";
    }
    // if()
}

include "../components/footer.php" 

?>