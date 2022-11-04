<?php

class dbconfig
{

   // method tampung koneksi db ke variabel
   public function __construct()
   {
      $this->db_connetion();
   }

   // method koneknis ke db
   public function db_connetion()
   {
      $this->conn = mysqli_connect('localhost', 'root', '', 'oop_php');
      if (!$this->conn) {
         die('Koneksi Gagal');
      }
   }

   // method insert data ke db
   public function insert($query)
   {
      $result = mysqli_query($this->conn, $query) or die($this->conn->error . __LINE__);

      if ($result > 0) {
         return $result;
      } else {
         return false;
      }
   }

   // method tampil data
   public function select($query)
   {
      $result = mysqli_query($this->conn, $query) or die($this->conn->error . __LINE__);
      if (mysqli_num_rows($result) > 0) {
         return $result;
      } else {
         return false;
      }
   }
   // method hapus data
   public function delete($query)
   {
      $result = mysqli_query($this->conn, $query) or die($this->conn->error . __LINE__);
      if ($result > 0) {
         return $result;
      } else {
         return false;
      }
   }
}

$t = new dbconfig;
echo $t->db_connetion();
