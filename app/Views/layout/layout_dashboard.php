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
                    <?= 
                        view_cell('\App\Libraries\Widget::cardRKA', ['document_uuid'=>'damn','table_name'=>'rka_tahunan','modal_id'=>'rka_tahunan'] /* dalam sini array sebagai variabel*/)
                        /*  isi array yang dibutuhkan adalah
                            ['table_name'],
                            ['document_uuid'],
                            ['modal_id'],
                        */
                    ?>
                    <?= 
                        view_cell('\App\Libraries\Widget::cardRKA', ['document_uuid'=>'damn2','table_name'=>'rka_jangka_panjang','modal_id'=>'rka_jangka_panjang'] /* dalam sini array sebagai variabel*/)
                        /*  isi array yang dibutuhkan adalah
                            ['table_name'],
                            ['document_uuid'],
                            ['modal_id'],
                        */
                    ?>
                </div>

            </div>
            
            <div class="card p-3">
                <div class="d-flex justify-content-between my-3">
                    <h5>ARUS KAS</h5>
                    <button class="btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </button>
                </div>
                <?= view_cell('\App\Libraries\Widget::cardArusKas',['document_uuid'=>'damn2'])?>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_input_kegiatan">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>TAMBAH ARUS KAS</h5>
                </div>

                <form id="tambah_jurnal" action="<?= base_url()?>/dashboard/add" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Kegiatan</label>
                            <input class="form-control"  type="date" id="tanggal" name="tanggal" style="max-width:200px;">
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="akun_debet">Akun Debet</label>
                                <select class="form-control" name="akun_debet" id="akun_debet">
                                    <option value="no-account">--- Pilih ---</option>
                                    
                                </select>
                            </div>

                            <div class="col form-group">
                                <label for="akun_kredit">Akun Kredit</label>
                                <select class="form-control" name="akun_kredit" id="akun_kredit">
                                    <option value="no-account">--- Pilih ---</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input class="form-control" type="number" style="max-width:400px;" id="nilai" name="nilai">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="bukti_transaksi">Bukti Transaksi</label>
                            <div class="input-group" style="max-width:400px;" >
                                <div class="custom-file">
                                    <label for="bukti_transaksi" class="custom-file-label">File berupa *.pdf</label>
                                    <input class="custom-file-input" multiple type="file" id="bukti_transaksi" name="bukti_transaksi[]" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-main1" data-dismiss="modal">Batal</button>
                        <button type="button" id="submit_button" class="btn btn-main1" name="button" onclick="addJurnal()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        console.log(<?php //echo json_encode($session)?>);
        
        async function getList() {
            let list;
            let result = await fetch('<?= base_url();?>/rekening/list/akun')
            list = await result.json();
            list.forEach(el => {
                $('#akun_debet').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
                $('#akun_kredit').append(`<option value="${el.uuid}">${el.nama_akun}</option>`)
            });
            return
        }


    </script>

    <!-- Script untuk tambah jurnal-->
    <script>
        async function addJurnal(){
            $('#modal_tambah_tipe').modal('toggle')
            let form = new FormData($('#tambah_jurnal')[0]);
            form.append('uuid', crypto.randomUUID());
            form.append('timestamp', Date.now());

            await fetch("<?= base_url();?>/dashboard/add",{
                method:"post",
                body: form,
            }).then(res => {
                console.log(res.json());
                $('#tambah_jurnal')[0].reset()
                $('#modal_input_kegiatan').modal('hide')
            }).catch(err => {
                console.log(err.message);
            })
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