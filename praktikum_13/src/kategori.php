<?php 
include "../connection/config.php";
$title_web = "Produk | SBD";
include "../components/header.php";
include "../components/navbar_inside.php";
?>

<div class="container">
    <a href="./insert_kategori.php" class="btn btn-primary">
        Tambah Kategori
    </a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Action</th>
        </tr>
        <?php 
        $increment = 1;
        $query = mysqli_query($connect, "SELECT * FROM tbkategori");
        $check = mysqli_num_rows($query);
        if($check == 0) {
            echo "<tr>
                <td colspan='5' align='center'><h3>Data Kategori Kosong!</h3></td>
            </tr>";
        }
        while($data = mysqli_fetch_assoc($query)) :
        ?>
        <tr>
            <td><?= $increment++ ?></td>
            <td><?= $data['namakategori'] ?></td>
            <td>
                <a class="btn-warning btn-sm" href="./update_kategori.php?idkategori=<?= $data['idkategori'] ?>">Ubah</a>
                <a class="btn-danger btn-sm" href="./delete_kategori.php?idkategori=<?= $data['idkategori'] ?>" onclick="return confirm('Yakin data dihapus?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include "../components/footer.php"; ?>