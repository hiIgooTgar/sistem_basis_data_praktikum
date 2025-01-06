<?php 
include "../connection/config.php";
$title_web = "Pemasok | SBD"; 
include "../components/header.php";
include "../components/navbar_inside.php"; 
?>

<div class="container">
    <a href="./insert_pemasok.php" class="btn btn-primary">Tambah Pemasok</a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nama Pemasok</th>
            <th>Kontak</th>
            <th>PIC</th>
            <th>Action</th>
        </tr>
        <?php 
        $increment = 1;
        $sql = "SELECT * FROM tbpemasok ORDER BY idpemasok DESC";
        $query = mysqli_query($connect, $sql);
        $check = mysqli_num_rows($query);
        if($check == 0 ) {
            echo "<tr>
                <td align='center' colspan='5'><h3>Data Pemasok Kosong!</h3></td>
            </tr>";
        } 
        while($data = mysqli_fetch_assoc($query)) :
        ?>
        <tr>
            <td><?= $increment++ ?></td>
            <td><?= $data['namapemasok'] ?></td>
            <td><?= $data['kontak'] ?></td>
            <td><?= $data['pic'] ?></td>
            <td>
                <a href="./update_pemasok.php?idpemasok=<?= $data['idpemasok'] ?>" class="btn-sm btn-warning">Ubah</a>
                <a href="./delete_pemasok.php?idpemasok=<?= $data['idpemasok'] ?>" onclick="return confirm('Yakin anda ingin hapus?');" class="btn-sm btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php 
include "../components/footer.php";
?>