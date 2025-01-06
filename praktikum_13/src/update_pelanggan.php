<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pelanggan";
include "../components/header.php";
include "../components/navbar_inside.php";

$idpelanggan = $_GET['idpelanggan'];
if(!isset($idpelanggan)) {
    echo "<script>alert('Data tidak ditemukan!');</script>";
}

$query = "SELECT * FROM tbpelanggan WHERE idpelanggan = $idpelanggan";
$sql = mysqli_query($connect , $query);
$fetchData = mysqli_fetch_assoc($sql);

if(mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan");
}

?>

<div class="container">
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idpelanggan" value="<?= $fetchData['idpelanggan'] ?>">
        <div class="form-group">
            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="namapelanggan" value="<?= $fetchData['namapelanggan'] ?>" id="namapelanggan" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="teleponpelanggan" class="form-label">Telepon Pelanggan</label>
            <input type="text" name="teleponpelanggan" value="<?= $fetchData['teleponpelanggan'] ?>" id="teleponpelanggan" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="alamatpelanggan" class="form-label">Alamat Pelanggan</label>
            <input type="text" name="alamatpelanggan" value="<?= $fetchData['alamatpelanggan'] ?>"id="alamatpelanggan" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-warning" name="addPelanggan">Update</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['addPelanggan'])) {
    $idpelanggan = htmlspecialchars($_POST['idpelanggan']);
    $namapelanggan = htmlspecialchars($_POST['namapelanggan']);
    $teleponpelanggan = htmlspecialchars($_POST['teleponpelanggan']);
    $alamatpelanggan = htmlspecialchars($_POST['alamatpelanggan']);
    
    $query = "UPDATE tbpelanggan SET namapelanggan = '$namapelanggan', teleponpelanggan = '$teleponpelanggan', alamatpelanggan = '$alamatpelanggan' WHERE idpelanggan = '$idpelanggan'";
    $result = mysqli_query($connect, $query);
    if($result) {
        echo "
        <script>alert('Data pelanggan berhasil diubah!');
        window.location.href = './pelanggan.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pelanggan tidak berhasil diubah!');
        window.location.href = './pelanggan.php'</script>
        ";
    }
}
?>