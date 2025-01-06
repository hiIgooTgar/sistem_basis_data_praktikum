<?php 

include "../connection/config.php";
$title_web = "Tambah Karyawan | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";

$idkaryawan = $_GET['idkaryawan'];

if(!isset($_GET['idkaryawan'])) {
    echo "
    <script>alert('Data kategori tidak ditemukan!');
    window.location.href = '../'</script>
    ";
}

$query = mysqli_query($connect, "SELECT * FROM tbkaryawan WHERE idkaryawan = $idkaryawan");
$dataKaryawan = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan!");
}


?>

<div class="container">
    <a href="../" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idkaryawan" value="<?= $dataKaryawan['idkaryawan'] ?>">
        <div class="form-group">
            <label for="namakaryawan" class="form-label">Nama Karyawan</label>
            <input autocomplete="off" class="form-control" type="text" name="namakaryawan" value="<?= $dataKaryawan['namakaryawan'] ?>" id="namakaryawan">
        </div>
        <div class="form-group">
            <label for="teleponkaryawan" class="form-label">Telepon Karyawan</label>
            <input autocomplete="off" class="form-control" type="number" value="<?= $dataKaryawan['teleponkaryawan'] ?>" name="teleponkaryawan" id="teleponkaryawan">
        </div>
        <div class="form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input autocomplete="off" class="form-control" value="<?= $dataKaryawan['jabatan'] ?>" type="text" name="jabatan" id="jabatan">
        </div>
        <div class="form-group">
            <label for="sandi" class="form-label">Sandi</label>
            <input autocomplete="off" class="form-control" value="<?= $dataKaryawan['sandi'] ?>" type="text" name="sandi" id="sandi">
        </div>
        <button type="submit" name="updateKaryawan" class="btn btn-primary">Update</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['updateKaryawan'])) {
    $idkaryawan = htmlspecialchars($_POST['idkaryawan']);
    $namakaryawan = htmlspecialchars($_POST['namakaryawan']);
    $teleponkaryawan = htmlspecialchars($_POST['teleponkaryawan']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $sandi = htmlspecialchars($_POST['sandi']);

    $sql = "UPDATE tbkaryawan SET namakaryawan = '$namakaryawan', teleponkaryawan = '$teleponkaryawan', jabatan = '$jabatan', sandi = '$sandi' WHERE idkaryawan = $idkaryawan";
    $query = mysqli_query($connect, $sql);

    if($query > 0) {
        echo "<script>
        alert('Data karyawan berhasil diubah!');
        window.location.href = '../'
        </script>";
    } else {
         echo "<script>
        alert('Data karyawan tidak berhasil diubah!');
        window.location.href = '../'
        </script>";
    }
}
?>