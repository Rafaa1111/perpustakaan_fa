<?php 
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}
require "../../config/config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION["member"]["nisn"];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM admin");

// Peminjaman 
if(isset($_POST["pinjam"]) ) {
  
  if(pinjamBuku($_POST) > 0) {
    echo "<script>
    alert('Buku berhasil dipinjam');
    window.location='../dashboardMember.php';
    </script>";
  }else {
    echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
  }
  
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/daftarbuku.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Form pinjam Buku || Member</title>
     <link rel="icon" href="../../assets/book.png" type="image/png">
  </head>
  <style>
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }
  </style>
  <body style="background-color: #CD853F ;">
    <nav class="navbar fixed-top shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../../assets/rasya.png" alt="logo" width="130px">
        </a>
        
        <a class="btn nav-link" href="../dashboardMember.php">Dashboard</a>
      </div>
    </nav>
    
  <div class="p-4 mt-5">
    <h2 class="mt-5">Form peminjaman Buku</h2>
    <div class="card">
      <h5 style="justify-content: center; align-items: center; display: flex ;" class="card-header">Data Lengkap buku</h5>
      <div class="card-body d-flex flex-wrap gap-5 justify-content-center">
          <?php foreach ($query as $item) : ?>
        <p class="card-text"><img src="../../imgDB/<?= $item["cover"]; ?>" width="180px" height="185px" style="border-radius: 5px;"></p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Id Buku</span>
            <input type="text" class="form-control" placeholder="id buku" aria-label="Username" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kategori</span>
            <input type="text" class="form-control" placeholder="kategori" aria-label="kategori" aria-describedby="basic-addon1" value="<?= $item["kategori"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Judul</span>
            <input type="text" class="form-control" placeholder="judul" aria-label="judul" aria-describedby="basic-addon1" value="<?= $item["judul"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Pengarang</span>
            <input type="text" class="form-control" placeholder="pengarang" aria-label="pengarang" aria-describedby="basic-addon1" value="<?= $item["pengarang"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Penerbit</span>
            <input type="text" class="form-control" placeholder="penerbit" aria-label="penerbit" aria-describedby="basic-addon1" value="<?= $item["penerbit"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
            <input type="date" class="form-control" placeholder="tahun_terbit" aria-label="tahun_terbit" aria-describedby="basic-addon1" value="<?= $item["tahun_terbit"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
            <input type="number" class="form-control" placeholder="jumlah halaman" aria-label="jumlah halaman" aria-describedby="basic-addon1" value="<?= $item["jumlah_halaman"]; ?>" readonly>
            </div>
          <div class="form-floating">
            <textarea class="form-control" placeholder="deskripsi singkat buku" id="floatingTextarea2" style="height: 100px" readonly><?= $item["buku_deskripsi"]; ?></textarea>
            <label for="floatingTextarea2">Deskripsi Buku</label>
            </div>
        <?php endforeach; ?>
        </form>
       </div>
      </div>
      
    <div class="card mt-4">
      <h5 style="justify-content: center; align-items: center; display: flex ;" class="card-header">Data lengkap Siswa</h5>
      <div class="card-body d-flex flex-wrap gap-4 justify-content-center">
        <p><img src="../../assets/user.png" width="150px"></p>
        <form action="" method="post">
          <?php foreach ($dataSiswa as $item) : ?>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nisn</span>
            <input type="number" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?= $item["nisn"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kode Member</span>
            <input type="text" class="form-control" placeholder="kode member" aria-label="kode member" aria-describedby="basic-addon1" value="<?= $item["kode_member"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nama</span>
            <input type="text" class="form-control" placeholder="nama" aria-label="nama" aria-describedby="basic-addon1" value="<?= $item["nama"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
            <input type="text" class="form-control" placeholder="jenis kelamin" aria-label="jenis kelamin" aria-describedby="basic-addon1" value="<?= $item["jenis_kelamin"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kelas</span>
            <input type="text" class="form-control" placeholder="kelas" aria-label="kelas" aria-describedby="basic-addon1" value="<?= $item["kelas"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jurusan</span>
            <input type="text" class="form-control" placeholder="jurusan" aria-label="jurusan" aria-describedby="basic-addon1" value="<?= $item["jurusan"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">No Tlp</span>
            <input type="no_tlp" class="form-control" placeholder="no tlp" aria-label="no tlp" aria-describedby="basic-addon1" value="<?= $item["no_tlp"]; ?>" readonly>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tanggal Daftar</span>
            <input type="date" class="form-control" placeholder="tgl_pendaftaran" aria-label="tgl_pendaftaran" aria-describedby="basic-addon1" value="<?= $item["tgl_pendaftaran"]; ?>" readonly>
            </div>
        <?php endforeach; ?>
        </form>
       </div>
      </div>
    
    <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar sebelum meminjam buku!. jika ada kesalahan data harap hubungi admin</div>
    
    <div class="card mt-4">
      <h5 style="justify-content: center; align-items: center; display: flex ;" class="card-header">Form Pinjam Buku</h5>
      <div class="card-body">
        <form action="" method="post">
          <!--Ambil data id buku-->
          <?php foreach ($query as $item) : ?>
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Id Buku</span>
            <input type="text" name="id_buku" class="form-control" placeholder="id buku" aria-label="id_buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
            </div>
          <?php endforeach; ?>
        <!-- Ambil data NISN user yang login-->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nisn</span>
            <input type="number" name="nisn" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["member"]["nisn"]); ?>" readonly>
        </div>
    <!--Ambil data id admin-->
    <select name="id" id="id" class="form-select" aria-label="Default select example">
                  <option selected>Pilih admin</option>
                  <?php foreach ($admin as $item) : ?>
                    <?php if ($item["role"] == "petugas") :?>
                  <option value="<?= $item['id']; ?>"><?= $item["nama_admin"]; ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
   </select>
   <div class="input-group mb-3 mt-3">
  <span class="input-group-text" id="basic-addon1">Telpon admin</span>
  <input type="number" name="no_petgas" id="no_tlp" class="form-control" placeholder="No. Telepon" aria-label="No. Telepon" aria-describedby="basic-addon1" readonly>
</div>

<script>
  document.getElementById('id').addEventListener('change', function() {
    var id = this.value; 
    var adminData = <?= json_encode($admin); ?>; 

    for (var i = 0; i < adminData.length; i++) {
      if (adminData[i].id === id) {
        document.getElementById('no_tlp').value = adminData[i].no_tlp;
        break; 
      }
    }
  });
</script>

<div class="input-group mb-3 mt-1">
<select class="form-select" aria-label="Default select example" name="paket" id="paket" onchange="setReturnDate(this)">
  <option disabled selected>-- pilih paketan --</option>
  <option value="1">Paket 1</option>
  <option value="2">Paket 2</option>
  <option value="3">Paket 3</option>
  <option value="">Non Paket</option>
</select>
    </div>

<div class="input-group mb-3 mt-1">
    <span class="input-group-text" id="basic-addon1">Tanggal pinjam</span>
    <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control" placeholder="id buku" aria-label="tgl_peminjaman" aria-describedby="basic-addon1" required>
</div>

    <div class="input-group mb-3 mt-1">
    <span class="input-group-text" id="basic-addon1">Tenggat Pengembalian</span>
    <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control" placeholder="tgl_pengembalian" aria-label="tgl_pengembalian" aria-describedby="basic-addon1" required>
      </div>
      <div class="input-group mb-3 mt-1">
      <span class="input-group-text" id="basic-addon1">Harga</span>
  <input type="text" name="harga" onchange="setPrice()" value="setPrice()" class="form-control" placeholder="harga" aria-label="harga" aria-describedby="basic-addon1" readonly>
    </div>
      
    <a class="btn btn-danger" href="../buku/daftarBuku.php"> Batal</a>
    <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
    </form>
    </div>
    </div>
  
    <div class="alert alert-danger mt-4" role="alert"><span class="fw-bold">Catatan :</span> Setiap keterlambatan pada pengembalian buku akan dikenakan sanksi berupa denda.</div>
    
    </div>
    
    <!--JAVASCRIPT -->
    <script src="../../style/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
function setReturnDate() {
    const currentDate = new Date();
    let returnDate = new Date();

    const selectedPackage = document.getElementById('paket').value;
    let daysToAdd = 1; // Default return date if no package is selected

    // Adjust days to add based on the selected package
    switch (selectedPackage) {
        case "1":
            daysToAdd = 5; // Change to the duration of Paket 1
            break;
        case "2":
            daysToAdd = 7; // Change to the duration of Paket 2
            break;
        case "3":
            daysToAdd = 10; // Change to the duration of Paket 3
            break;
        default:
            daysToAdd = 1; // Default return date if no package is selected
    }

    returnDate.setDate(currentDate.getDate() + daysToAdd);

    // Format tanggal untuk input HTML
    const formattedReturnDate = returnDate.toISOString().split('T')[0];
    document.getElementById('tgl_pengembalian').value = formattedReturnDate; // Mengubah value langsung ke input tgl_pengembalian

    setPrice(); // Call setPrice() after setting return date

    // Enable or disable tgl_pengembalian input based on whether a package is selecte
}
        function setPrice() {
            const priceInput = document.getElementsByName('harga')[0];
            const isPackageSelected = document.getElementById('paket').value !== ""; // Check if a package is selected

            // Get the selected dates
            const tglPinjam = new Date(document.getElementById('tgl_peminjaman').value);
            const tgl = new Date(document.getElementById('tgl_pengembalian').value);

            // Get the difference in days between tgl_peminjaman and tgl_pengembalian
            const diffTime = Math.abs(tgl - tglPinjam);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            let pricePerDay;

            if (isPackageSelected) {
                // Adjust price calculation based on package selection
                const selectedPackage = parseInt(document.getElementById('paket').value);
                // Assuming different packages have different prices
                // You can set prices based on the selected package
                // Here, we are just setting some arbitrary values
                switch (selectedPackage) {
                    case 1:
                        pricePerDay = 1000; // Price for Paket 1
                        break;
                    case 2:
                        pricePerDay = 900; // Price for Paket 2
                        break;
                    case 3:
                        pricePerDay = 800; // Price for Paket 3
                        break;
                    default:
                        pricePerDay = 1250; // Default price if no package selected
                }
            } else {
                // If no package is selected, set default price per day
                pricePerDay = 1250; // Default price per day for non-package
            }

            // Calculate total price
            const totalPrice = diffDays * pricePerDay;
            priceInput.value = totalPrice;
        }

        // Fungsi untuk mengatur tanggal pinjam dengan hari ini
        function setTodayDate() {
            const todayDateInput = document.getElementById('tgl_peminjaman');
            const currentDate = new Date();

            // Format tanggal untuk input HTML
            const formattedTodayDate = currentDate.toISOString().split('T')[0];
            todayDateInput.value = formattedTodayDate;

            setReturnDate(); // Call setReturnDate() after setting today's date
        }

        // Panggil fungsi setTodayDate saat halaman dimuat
        window.onload = function() {
            setTodayDate();
        };

        // Panggil setPrice() saat tgl_peminjaman atau tgl_pengembalian berubah
        document.getElementById('tgl_peminjaman').addEventListener('change', setPrice);
        document.getElementById('tgl_pengembalian').addEventListener('change', setPrice);

        // Validasi tanggal tenggat pengembalian
        document.getElementById('tgl_pengembalian').addEventListener('change', function() {
            var tglPinjam = document.getElementById('tgl_peminjaman').value;
            var tglPengembalian = this.value;

            // Bandingkan tanggal tenggat pengembalian dengan tanggal pinjam
            if (tglPengembalian <= tglPinjam) {
                alert('Tanggal tenggat pengembalian tidak boleh sebelum atau sama dengan tanggal pinjam');
                this.value = '';
            }
        });
</script>
<script>
  document.getElementById('nama_admin').addEventListener('change', function() {
    var nama_admin = this.value; 
    var adminData = <?= json_encode($admin); ?>; 

    for (var i = 0; i < adminData.length; i++) {
      if (adminData[i].nama_admin === nama_admin) {
        document.getElementById('no_tlp').value = adminData[i].no_tlp;
        break; 
      }
    }
  });
</script>
    <script>
  function showDropdownMenu() {
    document.getElementById('dropdownMenu').style.display = 'block';
  }

  function hideDropdownMenu() {
    document.getElementById('dropdownMenu').style.display = 'none';
  }
</script>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
