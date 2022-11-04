<?php
// join class proses
require_once('./config/proses.php');
$d = new Register;

if (isset($_GET['kode'])) {
   $idHapus = base64_decode($_GET['kode']);
   $methodHapus = $d->hapusData($idHapus);
}
?>

<?php require_once('./config/navbar.php') //navbar template
?>
<div class="container">
   <div class="row d-flex justify-content-center  mt-5">
      <div class="col">
         <div class="card shadow">
            <!-- alert -->
            <?php
            if (isset($hapusData)) {
            ?>
               <div class="alert alert-info" role="alert">
                  <?php echo $hapusData; ?>
               </div>
            <?php } ?>
            <!-- alert -->
            <div class="card-header bg-info">
               <h3 class="fw-bold">Data siswa Registerasi</h3>
            </div>
            <div class="card-body">
               <div class="col-4">
                  <a href="register.php" class="btn btn-success">Tambah Data</a>
               </div>
               <table class="table table-bordered mt-4">
                  <thead>
                     <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Photo</th>
                        <th>Alamat</th>
                        <th width='150'>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     foreach ($d->tampilData() as $data) :
                     ?>
                        <tr>
                           <td><?= $data['name']; ?></td>
                           <td><?= $data['email']; ?></td>
                           <td><?= $data['no']; ?></td>
                           <td><img src="img/<?= $data['foto']; ?>" width="60"></td>
                           <td><?= $data['alamat']; ?></td>
                           <td><a href="Euser.php?kode=<?= base64_encode($data['id_siswa']) ?>" class="btn btn-warning">Edit</a>&nbsp;<a href="?kode=<?= base64_encode($data['id_siswa']) ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data ini?');">Hapus</a></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?php require_once('config/footer.php') ?>