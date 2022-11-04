<?php
// join class proses
require_once('./config/proses.php');
$d = new Register; //panggil class Register
// ambil id dari edit siswa
if (isset($_GET['kode'])) {
   $id_siswa = base64_decode($_GET['kode']);
}
// kondisi ketika btn_update di pencet
if (isset($_POST['btn_update'])) {
   $update = $d->updateSiswa($_POST, $_FILES, $id_siswa);
}
?>

<?php require_once('./config/navbar.php') //navbar template
?>
<div class="container mt-4">
   <div class="row d-flex justify-content-center">
      <div class="col-md-7">
         <div class="card-shadow">
            <!-- alert -->
            <?php
            if (isset($update)) {
            ?>
               <div class="alert alert-info" role="alert">
                  <?php echo $update; ?>
               </div>
            <?php } ?>
            <!-- alert -->
            <div class="card-header">
               <h1 class="text-center">Form Edit Register Siswa</h1>
            </div>
            <div class="card-body">
               <?php
               $result = $d->edit_data($id_siswa);
               $data = mysqli_fetch_assoc($result);
               ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?= $data['name']; ?>">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="<?= $data['email']; ?>">
                  <label>No Hp</label>
                  <input type="number" name="no" class="form-control" value="<?= $data['no']; ?>">
                  <img src="img/<?= $data['foto']; ?>" width="60" class="mt-2">
                  <label>Foto</label>
                  <input type="file" name="foto" class="form-control" accept="image/*">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control"><?= $data['alamat'] ?></textarea>
                  <a href="index.php" class="mt-2 btn btn-info">Back</a>
                  <input type="submit" name="btn_update" class="mt-2 btn btn-success" value="Update">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php require_once('config/footer.php') ?>