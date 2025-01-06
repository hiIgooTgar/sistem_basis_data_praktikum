<?php 

include "../connection/config.php";
$title_web = "SBD | Tambah Pemasok";
include "../components/header.php";
include "../components/navbar_inside.php";

?>

<div class="container">
    <a href="./pemasok.php" class="btn btn-sm">Kembali</a>
    <form action="" method="post" class="form-main">
        <div class="form-group">
            <label for="namapemasok" class="form-label">Nama Pemasok</label>
            <input type="text" name="namapemasok" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="pic" class="form-label">PIC</label>
            <input type="text" name="pic" class="form-control" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="addPemasok">Submit</button>
    </form>
</div>

<?php 
include "../components/footer.php";

if(isset($_POST['addPemasok'])) {
     $namapemasok = htmlspecialchars( $_POST['namapemasok']);
    $kontak = htmlspecialchars( $_POST['kontak']);
    $pic = htmlspecialchars( $_POST['pic']);

    $query = "INSERT INTO tbpemasok(idpemasok, namapemasok, kontak, pic) VALUES('', '$namapemasok', '$kontak', '$pic')";
    $sql = mysqli_query($connect, $query);

    if($query) {
        echo "
        <script>alert('Data pemasok berhasil ditambahkan!');
        window.location.href = './pemasok.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data pemasok tidak berhasil ditambahkan!');
        window.location.href = './pemasok.php'</script>
        ";
    }
}
?>