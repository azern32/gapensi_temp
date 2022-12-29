  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-main1 sidebar-no-expand" >
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

        <?= $this->include('layout/sidebar_pegawai') ?>
        <?= $this->include('layout/sidebar_direktur') ?>
          

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
