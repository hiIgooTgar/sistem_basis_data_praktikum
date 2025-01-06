<?php 

include "../connection/config.php";
$title_web = "Tambah Kategori | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";

if(isset($_POST['addKategori'])) {
    $namakategori = htmlspecialchars($_POST['namakategori']);

    $query = mysqli_query($connect, "INSERT INTO tbkategori(idkategori, namakategori) VALUES('', '$namakategori')");

    if($query) {
        echo "
        <script>alert('Tambah data kategori berhasil!');
        window.location.href = 'kategori.php'</script>
        ";
    } else {
        echo "
        <script>alert('Tambah data kategori tidak berhasil!');
        window.location.href = 'kategori.php'</script>
        ";
    }
    // if()
}

?>

<div class="container">
    <a href="./kategori.php" class="btn btn-sm">Kembali</a>
    <form method="post" action="" class="form-main">
        <div class="form-group">
            <label for="namakategori" class="form-label">Nama Kategori</label>
            <input type="text" id="namakategori" autocomplete="off" class="form-control" name="namakategori">
        </div>
        <button name="addKategori" class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

<?php include "../components/footer.php" ?>