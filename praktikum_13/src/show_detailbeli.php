<?php 

include "../connection/config.php";
$title_web = "SBD | Detail Pembelian";
include "../components/header.php";
include "../components/navbar_inside.php";

$notabeli = $_GET['notabeli'];

if(!isset($notabeli)) {
    echo"<script>alert('Data tidak ditemukan!');</script>";
}

$query = "SELECT tbdetailbeli.*, tbpembelian.notabeli FROM tbdetailbeli
INNER JOIN tbpembelian ON tbdetailbeli.notabeli = tbpembelian.notabeli WHERE tbdetailbeli.notabeli = '$notabeli'";
$sql = mysqli_query($connect, $query);
$fetchDetail = mysqli_fetch_assoc($sql);

if(mysqli_num_rows($sql) > 1) {
    die("Data tidak ditemukan!");
} 

?>

<div class="container">
    <div class="form-group">
        <label for="notabeli" class="form-label">Nota Beli</label>
        <input type="text" name="notabeli" value="<?= $fetchDetail['notabeli'] ?>" readonly id="notabeli" class="form-control">
    </div>
    <div class="form-group">
        <label for="idproduk" class="form-label">Nama Produk</label>
        <input type="text" value="<?= $fetchDetail['idproduk'] ?>" name="idproduk" readonly id="idproduk" class="form-control">
    </div>
    <div class="form-group">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="text" name="jumlah" readonly id="jumlah" class="form-control">
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" name="harga" readonly id="harga" class="form-control">
    </div>
    <div class="form-group">
        <label for="subtotal" class="form-label">Subtotal</label>
        <input type="text" name="subtotal" readonly id="subtotal" class="form-control">
    </div>
</div>

<?php 

include "../components/footer.php";

?>