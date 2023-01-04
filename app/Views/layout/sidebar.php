  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-main1 sidebar-no-expand" >
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->  
  
    <!-- Brand Logo -->
    <div class="">
      <div class="d-flex justify-content-around p-3">
        <img src="<?php echo base_url().'/image/logo.png';?>" class="img-circle" style="max-width : -webkit-fill-available">
      </div>
      <div class="d-flex justify-content-center px-3">
        <h5 class="brand-text text-center">GKB Management App Keuangan</h5> 
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <!-- Check level pengguna -->
        <?php switch ($session['level']) {
          case 1:
            // Jika level pengguna pegawai, tampilkan sidebar_pegawai
            echo $this->include('layout/sidebar_pegawai');
            break;
          
            case 2:
              // Jika level pengguna direktur, tampilkan sidebar_direktur
            echo $this->include('layout/sidebar_direktur');
            break;

          default:
            // Untuk keperluan debugging 
            // Jika levelnya tidak ditemukan, otomatis jadi root
            echo $this->include('layout/sidebar_direktur');
            echo $this->include('layout/sidebar_pegawai');
            break;
        }?>

        <li class="nav-item my-2">
            <a href="<?= base_url()?>/login/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                Logout
                </p>
            </a>
        </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
