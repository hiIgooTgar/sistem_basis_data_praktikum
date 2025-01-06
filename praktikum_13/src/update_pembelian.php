<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pembelian";
include "../components/header.php";
include "../components/navbar_inside.php";

$idpembelian = $_GET['idpembelian'];

$query = "SELECT * FROM tbpembelian WHERE idpembelian = $idpembelian";
$sql = mysqli_query($connect, $query);
$fetchData = mysqli_fetch_assoc($sql);

if(mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
} 

?>

<div class="container">
    <a href="./pembelian.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idpembelian" value="<?= $fetchData['idpembelian'] ?>">
        <div class="form-group">
            <label for="notabeli" class="form-label">Nota Beli</label>
            <input type="text" name="notabeli" readonly id="notabeli" value="<?= $fetchData['notabeli'] ?>" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tglbeli" class="form-label">Tanggal</label>
            <input type="date" value="<?= $fetchData['tglbeli'] ?>" name="tglbeli" id="tglbeli" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="idkaryawan" class="form-label">Nama Karyawan</label>
            <select name="idkaryawan" id="idkaryawan" class="form-control">
            <?php 
            $query = "SELECT * FROM tbkaryawan";
            $sql = mysqli_query($connect, $query);
            while($fetchKaryawan = mysqli_fetch_assoc($sql)) :
            $selected = ($fetchData['idkaryawan'] == $fetchKaryawan['idpembelian'] ? "selected" : "");
            ?>                
                <option value="<?= $fetchKaryawan['idkaryawan'] ?>" <?= $selected ?>><?= $fetchKaryawan['namakaryawan'] ?></option>
            <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idpemasok" class="form-label">Nama Pemasok</label>
            <select name="idpemasok" id="idpemasok" class="form-control">
                <?php 
                $query = "SELECT * FROM tbpemasok";
                $sql = mysqli_query($connect, $query);
                while($fetchPemasok = mysqli_fetch_assoc($sql)) :
                $selected = ($fetchData['idpemasok'] == $fetchPemasok['idpemasok'] ? "selected" : "");
                ?>
                <option value="<?= $fetchPemasok['idpemasok'] ?>" <?= $selected ?>><?= $fetchPemasok['namapemasok'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">                                      
            <label for="totalbeli" class="form-label">Total Beli</label>
            <input type="number" name="totalbeli" value="<?= $fetchData['totalbeli'] ?>" id="totalbeli" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-warning" name="addPembelian">Update</button>
    </form>
</div>

<?php 

include "../components/footer.php";

if(isset($_POST['addPembelian'])) {
    $idpembelian = htmlspecialchars($_POST['idpembelian']);
    $tglbeli = date($_POST['tglbeli']);
    $idkaryawan = htmlspecialchars($_POST['idkaryawan']);
    $idpemasok = htmlspecialchars($_POST['idpemasok']);
    $totalbeli = htmlspecialchars($_POST['totalbeli']);

    $query = "UPDATE tbpembelian SET tglbeli = '$tglbeli'
    , idkaryawan = '$idkaryawan', idpemasok = '$idpemasok', totalbeli = '$totalbeli' WHERE idpembelian = '$idpembelian'";

    $sql = mysqli_query($connect, $query);

    if($sql) {
        echo "
        <script>alert('Data pembelian berhasil diubah!');
        window.location.href = './pembelian.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pembelian tidak berhasil diubah!');
        window.location.href = './pembelian.php'</script>
        ";
    }
}

?>