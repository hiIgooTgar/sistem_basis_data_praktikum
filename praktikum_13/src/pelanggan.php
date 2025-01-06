<?php 

include "../connection/config.php";
$title_web = "SBD | Pelanggan";
include "../components/header.php";
include "../components/navbar_inside.php"

?>
<div class="container">
    <a href="./insert_pelanggan.php" class="btn btn-primary">Tambah Pelanggan</a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
        <?php 
        $increment = 1;
        $query = "SELECT * FROM tbpelanggan";
        $sql = mysqli_query($connect, $query);
        $check = mysqli_num_rows($sql);
        if( $check == 0) {
            echo "<tr>
                <td align='center' colspan='5'><h3>Data Pelanggan Kosong!</h3></td>
            </tr>";
        } 
        while($data = mysqli_fetch_assoc($sql)) :
        ?>
        <tr>
            <td><?= $increment++ ?></td>
            <td><?= $data['namapelanggan'] ?></td>
            <td><?= $data['teleponpelanggan'] ?></td>
            <td><?= $data['alamatpelanggan'] ?></td>
            <td>
                <a class="btn-sm btn-warning" href="./update_pelanggan.php?idpelanggan=<?= $data['idpelanggan'] ?>">Ubah</a>
                <a class="btn-sm btn-danger" href="./delete_pelanggan.php?idpelanggan=<?= $data['idpelanggan'] ?>" onclick="return confirm('Yakin data ingin dihapus?');" >Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php 
include "../components/footer.php";
?>