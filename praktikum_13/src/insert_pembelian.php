<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pembelian";
include "../components/header.php";
include "../components/navbar_inside.php";

getRandomCharcter();

?>

<div class="container">
    <a href="./pembelian.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="notabeli" class="form-label">Nota Beli</label>
            <input type="text" name="notabeli" readonly id="notabeli" value="<?= getRandomCharcter() ?>" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tglbeli" class="form-label">Tanggal</label>
            <input type="date" name="tglbeli" id="tglbeli" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="idkaryawan" class="form-label">Nama Karyawan</label>
            <select name="idkaryawan" id="idkaryawan" class="form-control">
            <?php 
            $query = "SELECT * FROM tbkaryawan";
            $sql = mysqli_query($connect, $query);
            while($fetchKaryawan = mysqli_fetch_assoc($sql)) :
            ?>                
                <option value="<?= $fetchKaryawan['idkaryawan'] ?>"><?= $fetchKaryawan['namakaryawan'] ?></option>
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
                ?>
                <option value="<?= $fetchPemasok['idpemasok'] ?>"><?= $fetchPemasok['namapemasok'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <label for="totalbeli" class="form-label">Total Beli</label>
            <input type="number" name="totalbeli" id="totalbeli" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="addPembelian">Submit</button>
    </form>
</div>

<?php 

function getRandomCharcter() {
    $charcter = strtoupper("0123456789abcdefghijklmnopqrstuvwxyz");
    $random = "";

    for($i = 0; $i < 8; $i++) {
        $index = random_int(0, strlen($charcter) - 1);
        $random .= $charcter[$index];
    }

    return $random;
}

include "../components/footer.php";

if(isset($_POST['addPembelian'])) {
    $notabeli = htmlspecialchars($_POST['notabeli']);
    $tglbeli = date($_POST['tglbeli']);
    $idkaryawan = htmlspecialchars($_POST['idkaryawan']);
    $idpemasok = htmlspecialchars($_POST['idpemasok']);
    $totalbeli = htmlspecialchars($_POST['totalbeli']);

    $query = "INSERT INTO tbpembelian(idpembelian, notabeli, tglbeli, idkaryawan, idpemasok, totalbeli) 
    VALUES('', '$notabeli', '$tglbeli', '$idkaryawan', '$idpemasok', '$totalbeli')";

    $sql = mysqli_query($connect, $query);

    if($sql) {
        echo "
        <script>alert('Data pembelian berhasil ditambahkan!');
        window.location.href = './pembelian.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pembelian tidak berhasil ditambahkan!');
        window.location.href = './pembelian.php'</script>
        ";
    }
}

?>