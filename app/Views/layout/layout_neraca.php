<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <!-- Fungsi ini untuk pasang dependency yang sudah ditetapkan di Controllers/Dashboard -->
    <?php 
        // Bila dependensi ada, tuliskan dependensi CSS
        // Diterima dari Controllers/Dashboard::dependency
        if (isset($dependencies)) {
            foreach ($dependencies['css'] as $key => $val) {
                echo "\n    <!--".$key."-->\n    <link rel='stylesheet' href='".$val."'>";
            }
        }

        // Bila dependensi ada, tuliskan dependensi JS
        // Diterima dari Controllers/Dashboard::dependency
        if (isset($dependencies)) {
            foreach ($dependencies['js'] as $key => $val) {
                echo "\n    <!--".$key."-->\n    <script src='".$val."'></script>";
            }
        }
    ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url().'/image/logo.png';?>" width="160">
        </div>
        <!-- /Preloader -->

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

        <!-- Tampilkan layout sidebar dari Views/sidebar.php -->
        <?= $this->include('layout/sidebar') ?>

        <div class="content-wrapper p-2">
            <div class="card p-3">
                <?= view_cell('\App\Libraries\Widget::cardNeracaSaldo',['document_uuid'=>'null']);?>
            </div>            
        </div>
    </div>

    <script>
        console.log(<?php //echo json_encode($session)?>);
    </script>
</body>
</html>