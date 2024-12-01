<?php 

include '../connection/config.php';
include '../components/header.php'

?>

<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">ID Penyewaan</th>
      <th scope="col">No KTP</th>
      <th scope="col">Anggota Penyewa</th>
      <th scope="col">No Gedung</th>
      <th scope="col">Nama Gedung</th>
      <th scope="col">Tanggal Penyewaan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
    $a = 1;
    $sql = "SELECT penyewaan.*, anggota.no_ktp, anggota.nama AS nama_anggota, gedung.no_gedung, gedung.nama_gedung FROM penyewaan
    INNER JOIN anggota ON penyewaan.no_ktp = anggota.no_ktp
    INNER JOIN gedung ON penyewaan.no_gedung = gedung.no_gedung";
    $query = mysqli_query($connect, $sql);
    while($data = mysqli_fetch_assoc($query)) :
    $date = $data['tanggal_penyewaan']
    ?>
    <tr>
      <th scope="row"><?= $a++ ?></th>
      <td><?= $data['id_penyewaan'] ?></td>
      <td><?= $data['no_ktp'] ?></td>
      <td><?= $data['nama_anggota'] ?></td>
      <td><?= $data['no_gedung'] ?></td>
      <td><?= $data['nama_gedung'] ?></td>
      <td><?= date('d F Y', strtotime($date)) ?></td>
      <td>
        <a href="" class="badge bg-warning text-dark">Ubah</a>
        <a href="" class="badge bg-danger">Hapus</a>
      </td>
    </tr>
    <?php 
    endwhile;
    ?>
   
  </tbody>
</table>
    </div>
</div>

<?php 

include '../components/footer.php'
?>