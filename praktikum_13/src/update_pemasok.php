<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pemasok";
include "../components/header.php";
include "../components/navbar_inside.php";

$idpemasok = $_GET['idpemasok'];

if(!isset($idpemasok)) {
    echo "
    <script>alert('Data tidak ditemukan');</script>
    ";
}

$query = mysqli_query($connect, "SELECT * FROM tbpemasok WHERE idpemasok = $idpemasok");
$dataPemasok = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1) {
  die("Data tidak ditemukan!");
}

?>

<div class="container">
    <a href="./pemasok.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idpemasok" value="<?= $dataPemasok['idpemasok'] ?>">
        <div class="form-group">
            <label for="namapemasok" class="form-label">Nama Pemasok</label>
            <input value="<?= $dataPemasok['namapemasok'] ?>" type="text" name="namapemasok" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="kontak" class="form-label">Kontak</label>
            <input value="<?= $dataPemasok['kontak'] ?>"type="text" name="kontak" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="pic" class="form-label">PIC</label>
            <input value="<?= $dataPemasok['pic'] ?>"type="text" name="pic" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="updatePemasok">Update</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['updatePemasok'])) {
    $idpemasok = htmlspecialchars( $_POST['idpemasok']);
    $namapemasok = htmlspecialchars( $_POST['namapemasok']);
    $kontak = htmlspecialchars( $_POST['kontak']);
    $pic = htmlspecialchars( $_POST['pic']);

    $query = "UPDATE tbpemasok SET namapemasok = '$namapemasok', kontak = '$kontak', pic = '$pic' WHERE idpemasok = $idpemasok";

    $sql = mysqli_query($connect, $query);

    if($query) {
        echo "
        <script>alert('Data pemasok berhasil diubah!');
        window.location.href = './pemasok.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pemasok tidak berhasil diubah!');
        window.location.href = './pemasok.php'</script>
        ";
    }
}
?>