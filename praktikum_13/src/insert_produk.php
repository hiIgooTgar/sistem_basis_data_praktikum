<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Produk";
include "../components/header.php";
include "../components/navbar_inside.php"

?>

<div class="container">
    <a href="./produk.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="namaproduk" class="form-label">Nama Produk</label>
            <input type="text" name="namaproduk" id="namaproduk" autocomplete="off" class="form-control">
        </div>
        <div class="form-group">
            <label for="idkategori" class="form-label">Nama Kategori</label>
            <select name="idkategori" id="idkategori" class="form-control">
            <?php 
            $sql = mysqli_query($connect, "SELECT * FROM tbkategori");
            while($fetchKategori = mysqli_fetch_assoc($sql)) :
            ?>
                <option value="<?= $fetchKategori['idkategori'] ?>"><?= $fetchKategori['namakategori'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
         <div class="form-group">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" autocomplete="off" class="form-control">
        </div>
         <div class="form-group">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" autocomplete="off" class="form-control">
        </div>
        <button type="submit" name="addProduk" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php 

include "../components/footer.php";

if(isset($_POST['addProduk'])) {
    $namaproduk = htmlspecialchars($_POST['namaproduk']);
    $idkategori = htmlspecialchars($_POST['idkategori']);
    $stok = htmlspecialchars($_POST['stok']);
    $harga = htmlspecialchars($_POST['harga']);

    $query = "INSERT INTO tbproduk(idproduk, namaproduk, idkategori, stok, harga) VALUES('', '$namaproduk', '$idkategori', '$stok', '$harga')";
    $result = mysqli_query($connect, $query);

    if($result) {
        echo "
        <script>alert('Data produk berhasil ditambahkan!');
        window.location.href = './produk.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data produk tidak berhasil ditambahkan!');
        window.location.href = './produk.php'</script>
        ";
    }
}

?>