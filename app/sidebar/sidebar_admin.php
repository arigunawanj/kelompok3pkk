<div class="sidebar close">
    <div class="logo-details">
        <i class='bx bx-library'></i>
        <span class="logo_name">Perpustakaan</span>
    </div>
        <!-- MENU DATA -->
        <ul class="nav-links">
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-cabinet' ></i>
                <span class="link_name">Data</span>
              </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>

            <ul class="sub-menu">
              <li><a class="link_name" href="#">Data</a></li>
              <li><a href="#">Data Siswa</a></li>
              <li><a href="#">Data Buku</a></li>
            </ul>
            </li>
          
          <!-- MENU TRANSAKSI -->
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-bookmark-plus'></i>
                <span class="link_name">Transaksi</span>
              </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>

              <ul class="sub-menu">
                  <li><a class="link_name" href="#">Transaksi</a></li>
                  <li><a href="#">Data Pengembalian</a></li>
                  <li><a href="#">Data Peminjaman</a></li>
              </ul>
          </li>

          <!-- MENU LAPORAN -->
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-line-chart-down'></i>
                <span class="link_name">Laporan</span>
              </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
              <ul class="sub-menu">
                <li><a class="link_name" href="#">Laporan</a></li>
                <li><a href="#">Laporan Pengembalian</a></li>
                <li><a href="#">Laporan Peminjaman</a></li>
              </ul>
            </li>
          
          <!-- ISI PROFILE -->
          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!-- <img src="../asset/images/profile.png" alt="profileImg"> -->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['name']?></div>
                <div class="job"><?= $_SESSION['addres']?></div>
              </div>
              <a href="logout.php">
                <i class='bx bx-log-out'></i>
              </a>
            </div>
          </li>
        </ul>
  </div>