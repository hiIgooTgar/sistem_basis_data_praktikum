<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Penjualan";
include "../components/header.php";
include "../components/navbar_inside.php";

getRandomCharcter();

?>

<div class="container">
    <a href="./penjualan.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="notajual" class="form-label">Nota Jual</label>
            <input type="text" name="notajual" readonly id="notajual" value="<?= getRandomCharcter() ?>" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tgljual" class="form-label">Tanggal</label>
            <input type="date" name="tgljual" id="tgljual" class="form-control" autocomplete="off">
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
            <label for="idpelanggan" class="form-label">Nama Pelanggan</label>
            <select name="idpelanggan" id="idpelanggan" class="form-control">
                <?php 
                $query = "SELECT * FROM tbpelanggan";
                $sql = mysqli_query($connect, $query);
                while($fetchPelanggan = mysqli_fetch_assoc($sql)) :
                ?>
                <option value="<?= $fetchPelanggan['idpelanggan'] ?>"><?= $fetchPelanggan['namapelanggan'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <label for="totaljual" class="form-label">Total Jual</label>
            <input type="number" name="totaljual" id="totaljual" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="addPenjualan">Submit</button>
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

if(isset($_POST['addPenjualan'])) {
    $notajual = htmlspecialchars($_POST['notajual']);
    $tgljual = date($_POST['tgljual']);
    $idkaryawan = htmlspecialchars($_POST['idkaryawan']);
    $idpelanggan = htmlspecialchars($_POST['idpelanggan']);
    $totaljual = htmlspecialchars($_POST['totaljual']);

    $query = "INSERT INTO tbpenjualan(idpenjualan, notajual, tgljual, idkaryawan, idpelanggan, totaljual) 
    VALUES('', '$notajual', '$tgljual', '$idkaryawan', '$idpelanggan', '$totaljual')";

    $sql = mysqli_query($connect, $query);

    if($sql) {
        echo "
        <script>alert('Data penjualan berhasil ditambahkan!');
        window.location.href = './penjualan.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data penjualan tidak berhasil ditambahkan!');
        window.location.href = './penjualan.php'</script>
        ";
    }
}

?>