<?php
require_once('./config/proses.php'); //join ke halaman proses.php
// panggil class proses
$cregister = new Register;

// kondisi atau request data dari form
if (isset($_POST['btn_save'])) {
   // link ke method class register
   $register = $cregister->addRegister($_POST, $_FILES);
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
            if (isset($register)) {
            ?>
               <div class="alert alert-info" role="alert">
                  <?php echo $register; ?>
               </div>
            <?php } ?>
            <!-- alert -->
            <div class="card-header">
               <h1 class="text-center">Form Register Siswa</h1>
            </div>
            <div class="card-body">
               <form action="" method="post" enctype="multipart/form-data">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" required>
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required>
                  <label>No Hp</label>
                  <input type="number" name="no" class="form-control" required>
                  <label>Foto</label>
                  <input type="file" name="foto" class="form-control" accept="image/*">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control"></textarea>
                  <input type="submit" name="btn_save" class="form-control mt-2 btn btn-success" value="Registerasi">
                  <a href="index.php" class="btn btn-danger mt-2">Back</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php require_once('config/footer.php') ?>