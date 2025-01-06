<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Produk";
include "../components/header.php";
include "../components/navbar_inside.php";

$idproduk = $_GET['idproduk'];

if(!isset($idproduk)) {
     echo "
    <script>alert(Data tidak ditemukan!);</script>
    ";
}

$query = "SELECT * FROM tbproduk WHERE idproduk = $idproduk";
$sql = mysqli_query($connect, $query);
$fetchProduk = mysqli_fetch_assoc($sql);

if(mysqli_num_rows($sql) < 1) {
    die("Data tidak ditemukan!");
}

?>

<div class="container">
    <a href="./produk.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <input type="hidden" name="idproduk" value="<?= $fetchProduk['idproduk'] ?>">
        <div class="form-group">
            <label for="namaproduk" class="form-label">Nama Produk</label>
            <input type="text" value="<?= $fetchProduk['namaproduk'] ?>" name="namaproduk" id="namaproduk" autocomplete="off" class="form-control">
        </div>
        <div class="form-group">
            <label for="idkategori" class="form-label">Nama Kategori</label>
            <select name="idkategori" id="idkategori" class="form-control">
            <?php 
            $sql = mysqli_query($connect, "SELECT * FROM tbkategori");
            while($fetchKategori = mysqli_fetch_assoc($sql)) :
            $selected = ($fetchProduk['idkategori'] == $fetchKategori['idkategori'] ? "selected" : "");
            ?>
                <option value="<?= $fetchKategori['idkategori'] ?>" <?= $selected ?>><?= $fetchKategori['namakategori'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
         <div class="form-group">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" value="<?= $fetchProduk['stok'] ?>" name="stok" id="stok" autocomplete="off" class="form-control">
        </div>
         <div class="form-group">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" value="<?= $fetchProduk['harga'] ?>" id="harga" autocomplete="off" class="form-control">
        </div>
        <button type="submit" name="updateProduk" class="btn btn-warning">Submit</button>
    </form>
</div>

<?php 

include "../components/footer.php";

if(isset($_POST['updateProduk'])) {
    $idproduk = htmlspecialchars($_POST['idproduk']);
    $namaproduk = htmlspecialchars($_POST['namaproduk']);
    $idkategori = htmlspecialchars($_POST['idkategori']);
    $stok = htmlspecialchars($_POST['stok']);
    $harga = htmlspecialchars($_POST['harga']);

    $query = "UPDATE tbproduk SET namaproduk = '$namaproduk', idkategori = '$idkategori', stok = '$stok', harga = '$harga' WHERE idproduk = $idproduk";
    $result = mysqli_query($connect, $query);

    if($result) {
        echo "
        <script>alert('Data produk berhasil diubah!');
        window.location.href = './produk.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data produk tidak berhasil diubah!');
        window.location.href = './produk.php'</script>
        ";
    }
}

?>