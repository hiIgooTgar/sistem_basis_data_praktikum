<?php 

include "../connection/config.php";
$title_web = "Tambah Karyawan | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";


?>

<div class="container">
    <a href="../" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="namakaryawan" class="form-label">Nama Karyawan</label>
            <input autocomplete="off" class="form-control" type="text" name="namakaryawan" id="namakaryawan">
        </div>
        <div class="form-group">
            <label for="teleponkaryawan" class="form-label">Telepon Karyawan</label>
            <input autocomplete="off" class="form-control" type="number" name="teleponkaryawan" id="teleponkaryawan">
        </div>
        <div class="form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input autocomplete="off" class="form-control" type="text" name="jabatan" id="jabatan">
        </div>
        <div class="form-group">
            <label for="sandi" class="form-label">Sandi</label>
            <input autocomplete="off" class="form-control" type="text" name="sandi" id="sandi">
        </div>
        <button type="submit" name="addKaryawan" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['addKaryawan'])) {
    $namakaryawan = htmlspecialchars($_POST['namakaryawan']);
    $teleponkaryawan = htmlspecialchars($_POST['teleponkaryawan']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $sandi = htmlspecialchars($_POST['sandi']);

    $sql = "INSERT INTO tbkaryawan(idkaryawan, namakaryawan, teleponkaryawan, jabatan, sandi) VALUES('', '$namakaryawan', '$teleponkaryawan', '$jabatan', '$sandi')";
    $query = mysqli_query($connect, $sql);

    if($query > 0) {
        echo "<script>
        alert('Data karyawan berhasil ditambahkan!');
        window.location.href = '../'
        </script>";
    } else {
         echo "<script>
        alert('Data karyawan tidak berhasil ditambahkan!');
        window.location.href = '../'
        </script>";
    }
}
?>