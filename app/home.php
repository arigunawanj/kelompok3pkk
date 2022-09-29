<?php 

include('../config.php'); 

session_start();
if(!$_SESSION['nip']){
    header('Location:../index.php?session=expired');
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="asset/404.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- icon title -->
    <link rel="icon" type="image/png" href="../asset/images/icons/library.png"/>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <?php include('sidebar/sidebar_admin.php') ?>
  

  <!-- ISI KONTEN -->
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
    </div>
    
    <div class="container text-center">
        <div class="row justify-content-start">
            <div class="col">
            <?php 
            if (isset($_GET['page'])){
                if ($_GET['page']=='data-siswa'){
                    include('kadmin/data_siswa.php'); 
                }
                else if ($_GET['page']=='data-buku'){
                    include('kadmin/data_buku.php');
                }
                else if ($_GET['page']=='data-petugas'){
                include('kadmin/data_petugas.php');
                }  
                else if ($_GET['page']=='data-pengembalian'){
                include('kadmin/data_pengembalian.php');
                }  
                else if ($_GET['page']=='data-peminjaman'){
                include('kadmin/data_peminjaman.php');
                }  
                else if ($_GET['page']=='lap-peminjaman'){
                include('kadmin/lap_peminjaman.php');
                }  
                else if ($_GET['page']=='lap-pengembalian'){
                include('kadmin/lap_pengembalian.php');
                }  
                else {
                    include('404.php');
                }
            }
        ?>
            </div>
        </div>
    </div>
  </section>

  

  
  <script src="asset/script.js"></script>
  <!-- Script bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
