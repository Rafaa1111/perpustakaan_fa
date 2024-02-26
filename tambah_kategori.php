<?php
    include "header.html";
?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
        <div class="card">
  <div class="card-header">
   Tambah Data Kategori
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col">
            <form action="simpan_kategori.php" method="POST">
                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    
                    <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori">
                </div>
<p> </p>
                <input type="submit" class="btn btn-primary" value="simpan">
            </form>
        </div>
    </div>
    
        </div>
    </div>
  </div>
</div>
        </div>
    

