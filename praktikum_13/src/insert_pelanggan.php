<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pelanggan";
include "../components/header.php";
include "../components/navbar_inside.php"

?>

<div class="container">
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="teleponpelanggan" class="form-label">Telepon Pelanggan</label>
            <input type="text" name="teleponpelanggan" id="teleponpelanggan" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="alamatpelanggan" class="form-label">Alamat Pelanggan</label>
            <input type="text" name="alamatpelanggan" id="alamatpelanggan" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="addPelanggan">Submit</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['addPelanggan'])) {
    $namapelanggan = htmlspecialchars($_POST['namapelanggan']);
    $teleponpelanggan = htmlspecialchars($_POST['teleponpelanggan']);
    $alamatpelanggan = htmlspecialchars($_POST['alamatpelanggan']);

    $query = "INSERT INTO tbpelanggan(idpelanggan, namapelanggan, teleponpelanggan, alamatpelanggan) VALUES('', '$namapelanggan', '$teleponpelanggan', '$alamatpelanggan')";
    $result = mysqli_query($connect, $query);
    if($result) {
        echo "
        <script>alert('Data pelanggan berhasil ditambahkan!');
        window.location.href = './pelanggan.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pelanggan tidak berhasil ditambahkan!');
        window.location.href = './pelanggan.php'</script>
        ";
    }
}
?>