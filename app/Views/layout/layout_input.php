<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
                <h5>RENCANA KERJA DAN ANGGARAN</h5>
                <div class="d-flex">
                    <?php 
                        echo view_cell('\App\Libraries\Widget::cardRKA', ['RKA_type'=>'RKA Tahunan','document'=>!empty($rka_tahunan) ? $rka_tahunan : '0' ,'table_name'=>'tahunan','modal_id'=>'rka_tahunan'] /* dalam sini array sebagai variabel*/)
                    ?>
                    <?php 
                        echo view_cell('\App\Libraries\Widget::cardRKA', ['RKA_type'=>'RKA Jangka Panjang','document'=>!empty($rka_jangka_panjang) ? $rka_jangka_panjang : '0','table_name'=>'jangka_panjang','modal_id'=>'rka_jangka_panjang']/* dalam sini array sebagai variabel*/)
                    ?>
                </div>

            </div>
            
            <div class="card p-3">
                <?= view_cell('\App\Libraries\Widget::cardArusKas',['document_uuid'=>'null'])?>
            </div>
        </div>
    </div>




    <script>
        console.log(<?php echo json_encode($rka_jangka_panjang)?>);
        
        async function getList() {
            let list;
            let result = await fetch('<?= base_url();?>/rekening/list/akun')
            list = await result.json();
            list.forEach(el => {
                $('#akun_debet').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
                $('#akun_kredit').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
                $('#akun_debet_edit').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
                $('#akun_kredit_edit').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
            });
            return
        }


    </script>

    

    <script>        
        $(function () {
            bsCustomFileInput.init();
            getList()
        });
    </script>
</body>
</html>