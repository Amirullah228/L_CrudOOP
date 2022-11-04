<?php
require_once('./config/dbconfig.php'); //join ke halaman dbconfig.php


class Register
{
   // definisi property
   public $cdb;
   // method tampung koneksi db ke variabel
   public function __construct()
   {
      $this->cdb = new dbconfig;
   }

   //  method addRegister()
   public function addRegister($data, $file)
   {
      $nama = $data['name'];
      $email = $data['email'];
      $no = $data['no'];
      $alamat = $data['alamat'];

      // set image kondisi
      $rand = mt_rand(); //property random nilai
      $name = $file['foto']['name'];
      $size = $file['foto']['size'];
      $tmp = $file['foto']['tmp_name'];

      if ($size > 1024) {
         $img = $rand . '_' . $name; //random name image
         move_uploaded_file($tmp, 'img/' . $rand . '_' . $name);
         // proses save data
         $query = "INSERT INTO user(name,email,no,alamat,foto)VALUES('$nama','$email','$no','$alamat','$img')";
         // proses kedb
         $result = $this->cdb->insert($query);

         // kondisi
         if ($result > 0) {
            $msg = "Registerasi Suksess!";
            return $msg;
         } else {
            $msg = "Registerasi Gagal!";
            return $msg;
         }
      } else {
         $msg = "Ukuran File Gambar Terlalu Besar!";
         return $msg;
      }
   }

   // method tampil data
   public function tampilData()
   {
      $query = 'SELECT * FROM user ORDER BY id_siswa ASC';
      $result = $this->cdb->select($query);
      return $result;
   }

   // method tampil data edit data
   public function edit_data($id_siswa)
   {
      $query = "SELECT * FROM user WHERE id_siswa = '$id_siswa'";
      $result = $this->cdb->select($query);
      return $result;
   }

   public function updateSiswa($data, $file, $id_siswa)
   {
      $nama = $data['nama'];
      $email = $data['email'];
      $no = $data['no'];
      $alamat = $data['alamat'];

      // set image kondisi
      $rand = mt_rand(); //property random nilai
      $name = $file['foto']['name'];
      $size = $file['foto']['size'];
      $tmp = $file['foto']['tmp_name'];

      if ($name && $tmp == true) { //jika ada foto
         // cek size
         if ($size > 1024) {
            // hapus foto lama
            $img_query = "SELECT * FROM user WHERE id_siswa = '$id_siswa'";
            $result_img = $this->cdb->select($img_query);
            if ($result_img) {
               while ($row = mysqli_fetch_assoc($result_img)) {
                  $photo = 'img/' . $row['foto'];
                  unlink($photo);
               }
            }
            //batas
            $img = $rand . '_' . $name; //random name image
            move_uploaded_file($tmp, 'img/' . $rand . '_' . $name);
            // proses save data 
            $query = "UPDATE user SET
            name = '$nama',
            email = '$email',
            no = '$no',
            alamat = '$alamat',
            foto = '$img'
            WHERE id_siswa = '$id_siswa'";
            $result = $this->cdb->insert($query);
            // kondisi
            if (
               $result > 0
            ) {
               $msg = "Update Suksess!";
               return $msg;
            } else {
               $msg = "Update Gagal!";
               return $msg;
            }
         } else {
            $msg = "Ukuran File Gambar Terlalu Besar!";
            return $msg;
         }
      } else {
         // proses save data 
         $query = "UPDATE user SET
            name = '$nama',
            email = '$email',
            no = '$no',
            alamat = '$alamat'
            WHERE id_siswa = '$id_siswa'";
         $result = $this->cdb->insert($query);
         // kondisi
         if (
            $result > 0
         ) {
            $msg = "Update Suksess!";
            return $msg;
         } else {
            $msg = "Update Gagal!";
            return $msg;
         }
      }
   }

   // method hapus data
   public function hapusData($idHapus)
   {
      // hapus foto lama
      $img_query = "SELECT * FROM user WHERE id_siswa = '$idHapus'";
      $result_img = $this->cdb->select($img_query);
      if ($result_img) {
         while ($row = mysqli_fetch_assoc($result_img)) {
            $photo = 'img/' . $row['foto'];
            unlink($photo);
         }
      }

      $query = "DELETE FROM user WHERE id_siswa = '$idHapus'";
      $result = $this->cdb->delete($query);

      // kondisi
      if ($result > 0) {
         $msg = "Berhasil Data Di Hapus!";
         return $msg;
      } else {
         $msg = "Gagal Data Di Hapus!";
         return $msg;
      }
   }
}
