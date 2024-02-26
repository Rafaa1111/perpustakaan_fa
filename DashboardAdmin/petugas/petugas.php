<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/admin/sign_in.php");
  exit;
}
require "../../config/config.php";

$member = queryReadData("SELECT * FROM admin ORDER BY id ");

if(isset($_POST["search"]) ) {
  $member = searchMember($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/member.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Petugas Terdaftar</title>
     <link rel="icon" href="../../assets/book.png" type="image/png">
  </head>
  <body>
    <nav class="navbar fixed-top  shadow-sm">
      <div class="container-fluid p-1">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logo2.png" alt="logo" width="150px">
        </a>
        <div class="menu">
        <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
        <a class="btn btn-tertiary" href="tambahpetugas.php">Tambah Petugas</a>
        </div>
      </div>
    </nav>
    
    <div class="p-4 mt-5">
      <!--search engine --->
     <form action="" method="post" class="mt-5">
       
      </form>
      
      <h3>List Of Petugas / Admin</h3>
      <div class="table-responsive mt-3" >
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th class="list">Id</th>
            <th class="list">nama admin & petugas</th>
            <th class="list">Password</th>
            <th class="list">Kode admin & petugas</th>
            <th class="list">Telepon</th>
            <th class="list">Role</th>
            <th class="list">Delete</th>
          </tr>
        </thead>
      <?php foreach($member as $item) : ?>
      <tr>
        <td><?=$item["id"];?></td>
        <td><?=$item["nama_admin"];?></td>
        <td><?=$item["password"];?></td>
        <td><?=$item["kode_admin"];?></td>
        <td><?=$item["no_tlp"];?></td>
        <td><?=$item["role"];?></td>
        <td>
          <div class="action">
          <a href="editpetugas.php?id=<?= $item["id"]; ?>" class="btn btn-success" onclick="return confirm('Yakin ingin edit data  ?');">Edit<i class="fa-solid fa-pen-to-square"></i></a>
             <a href="deletepetugas.php?id=<?= $item["id"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ?');">Delete<i class="fa-solid fa-trash"></i></a>
           </div>
        </td>
       </tr>
      <?php endforeach;?>
    </table>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>