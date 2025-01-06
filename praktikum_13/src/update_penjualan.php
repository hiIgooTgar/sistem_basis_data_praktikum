<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Penjualan";
include "../components/header.php";
include "../components/navbar_inside.php";

$idpenjualan = $_GET['idpenjualan'];
if(!isset($idpenjualan)) {
    echo "<script>alert('Data tidak ditemukan!')</script>";
}

$query = "SELECT * FROM tbpenjualan WHERE idpenjualan = $idpenjualan";
$sql = mysqli_query($connect, $query);
$fetchPenjualan = mysqli_fetch_assoc($sql);

if(mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
}

?>

<div class="container">
    <a href="./penjualan.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idpenjualan" value="<?= $fetchPenjualan['idpenjualan'] ?>">
        <div class="form-group">
            <label for="notajual" class="form-label">Nota Jual</label>
            <input type="text" name="notajual" readonly id="notajual" value="<?= $fetchPenjualan['notajual'] ?>" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tgljual" class="form-label">Tanggal</label>
            <input type="date" name="tgljual" value="<?= $fetchPenjualan['tgljual'] ?>" id="tgljual" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="idkaryawan" class="form-label">Nama Karyawan</label>
            <select name="idkaryawan" id="idkaryawan" class="form-control">
            <?php 
            $query = "SELECT * FROM tbkaryawan";
            $sql = mysqli_query($connect, $query);
            while($fetchKaryawan = mysqli_fetch_assoc($sql)) :
                $selected = ($fetchPenjualan['idkaryawan'] == $fetchKaryawan['idkaryawan'] ? "selected" : "");
            ?>                
                <option value="<?= $fetchKaryawan['idkaryawan'] ?>" <?= $selected ?> ><?= $fetchKaryawan['namakaryawan'] ?></option>
            <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idpelanggan" class="form-label">Nama Pelanggan</label>
            <select name="idpelanggan" id="idpelanggan" class="form-control">
                <?php 
                $query = "SELECT * FROM tbpelanggan";
                $sql = mysqli_query($connect, $query);
                while($fetchPelanggan = mysqli_fetch_assoc($sql)) :
                    $selected = ($fetchPenjualan['idpelanggan'] == $fetchPelanggan['idpelanggan'] ? "selected" : ""); 
                ?>
                <option value="<?= $fetchPelanggan['idpelanggan'] ?>"><?= $fetchPelanggan['namapelanggan'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <label for="totaljual" class="form-label">Total Jual</label>
            <input type="number" name="totaljual" value="<?= $fetchPenjualan['totaljual'] ?>" id="totaljual" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-warning" name="updatePenjualan">Update</button>
    </form>
</div>

<?php 

include "../components/footer.php";

if(isset($_POST['updatePenjualan'])) {
    $idpenjualan = htmlspecialchars($_POST['idpenjualan']);
    $tgljual = date($_POST['tgljual']);
    $idkaryawan = htmlspecialchars($_POST['idkaryawan']);
    $idpelanggan = htmlspecialchars($_POST['idpelanggan']);
    $totaljual = htmlspecialchars($_POST['totaljual']);

    $query = "UPDATE tbpenjualan SET tgljual = '$tgljual', idkaryawan = '$idkaryawan', idpelanggan = '$idpelanggan',
    totaljual = '$totaljual' WHERE idpenjualan = $idpenjualan";

    $sql = mysqli_query($connect, $query);

    if($sql) {
        echo "
        <script>alert('Data penjualan berhasil diubah!');
        window.location.href = './penjualan.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data penjualan tidak berhasil diubah!');
        window.location.href = './penjualan.php'</script>
        ";
    }
}

?>