<?php 

include "../connection/config.php";
$title_web = "Pembelian | SBD";
include "../components/header.php";
include "../components/navbar_inside.php"
?>

<div class="container">
    <a href="./insert_pembelian.php" class="btn btn-primary">Tambah Pembelian</a>
    <table class="table-main">
        <tr>
            <th>No</th>
            <th>Nota Beli</th>
            <th>Tanggal</th>
            <th>Karyawan</th>
            <th>Pemasok</th>
            <th>Total beli</th>
            <th>Action</th>
        </tr>
        <?php
        $increment = 1;
        $query = mysqli_query($connect, "SELECT tbpembelian.*, tbkaryawan.namakaryawan, tbpemasok.namapemasok FROM tbpembelian 
        INNER JOIN tbkaryawan ON tbkaryawan.idkaryawan = tbpembelian.idkaryawan
        INNER JOIN tbpemasok ON tbpembelian.idpemasok = tbpemasok.idpemasok");

        $check = mysqli_num_rows($query);
        if($check == 0) {
            echo "
            <tr>
                <td align='center' colspan='7'><h3>Data Pembelian Kosong!</h3></td>
            </tr>
            ";
        }
        while($data = mysqli_fetch_assoc($query)) :
        // setlocale(LC_ALL, 'id-ID', 'id_ID');
        // echo strftime("%d %B %Y");
        $date = $data['tglbeli'];
        ?>
        <tr>
            <td><?= $increment++ ?></td>
            <td><?= $data['notabeli'] ?></td>
            <td><?= date("d F Y", strtotime($date)) ?></td>
            <td><?= $data['namakaryawan'] ?></td>
            <td><?= $data['namapemasok'] ?></td>
            <td><?= $data['totalbeli'] ?></td>
            <td>
                <a class="btn-sm btn-primary" href="./show_detailbeli.php?notabeli=<?= $data['notabeli'] ?>">Detail</a>
                <a href="./update_pembelian.php?idpembelian=<?= $data['idpembelian'] ?>" class="btn-sm btn-warning">Ubah</a>
                <a href="" class="btn-sm btn-danger">Hapus</a>
            </td>
        </tr>
        <?php 
        endwhile;
        ?>
    </table>
</div>

<?php 
include "../components/footer.php";
?>