<?php
include "koneksi.php";
$nama_kategori=$_POST['nama_kategori'];
$query=mysqli_query($koneksi,"insert into kategori values (null,'$nama_kategori')");
