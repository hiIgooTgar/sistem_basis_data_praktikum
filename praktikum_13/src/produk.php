<?php 
include "../connection/config.php";
$title_web = "Produk | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";
?>

<div class="container">
    <a href="./insert_produk.php" class="btn btn-primary">Tambah Produk</a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
        <?php 
        $increment = 1;
        $query = mysqli_query($connect, "SELECT tbproduk.*, tbkategori.namakategori FROM tbproduk
        LEFT JOIN tbkategori ON tbproduk.idkategori = tbkategori.idkategori");
        $check = mysqli_num_rows($query);
        if($check == 0) {
            echo "<tr>
                <td colspan='6' align='center'><h3>Data Produk Kosong!</h3></td>
            </tr>";
        }
        while($data = mysqli_fetch_assoc($query)) :
        ?>
        <tr>
            <td><?= $increment++ ?></td>
            <td><?= $data['namaproduk'] ?></td>
            <td><?= $data['namakategori'] ?></td>
            <td><?= $data['stok'] ?></td>
            <td><?= $data['harga'] ?></td>
            <td>
                <a class="btn btn-warning btn-sm" href="./update_produk.php?idproduk=<?= $data['idproduk'] ?>">Ubah</a>
                <a onclick="return confirm('Yakin data ingin dihapus?')" class="btn btn-danger btn-sm" href="./delete_produk.php?idproduk=<?= $data['idproduk'] ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include "../components/footer.php"; ?>