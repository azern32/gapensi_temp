<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening</title>

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
            <div class="card p-3 m-2">
                <div class="card-header px-5 d-flex justify-content-between">
                    <h4>List Akun Rekening</h4>
                    <button type="button" class="btn btn-main1" data-toggle="modal" data-target="#modal_tambah">
                        <i class="fas fa-plus"></i> Tambah Akun
                    </button>
                </div> 

                <div class="card-body">
                    <div class="p-3">
                        <table class="table table-responsive table-striped " id="list_akun">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Tipe Akun</th>
                                    <th>Jumlah Debit</th>
                                    <th>Jumlah Kredit</th>
                                    <th>Total Saldo</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Di sini diisi pake script list.foreach() -->
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

            <!-- Modal Tambah akun -->
            <div class="modal fade" id="modal_tambah">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>

                        </div>

                        <div class="modal-body">
                            <form id="tambah_akun" class="">
                                <div class="form-group row">
                                    <label for="kode_akun" class="col-sm-4 col-form-label">Kode Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="kode_akun" id="kode_akun" maxlength="6">
                                        <small class="text-red">Maksimum 6 karakter</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_akun" class="col-sm-4 col-form-label">Tipe Akun</label>
                                    <div class="col-sm">
                                        <select class="custom-select" name="tipe_akun" id="tipe_akun">
                                            <option value="no-account">--- Pilih ---</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_akun" class="col-sm-4 col-form-label">Nama Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="nama_akun" id="nama_akun">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="addAkun()">Tambah akun</button>
                        </div>
                    </div>
                </div>    
            </div>

            <!-- Modal Edit akun -->
            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>

                        </div>

                        <div class="modal-body">
                            <form id="edit_akun" class="">
                                <div class="form-group row">
                                    <label for="kode_akun_edit" class="col-sm-4 col-form-label">Kode Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="kode_akun_edit" id="kode_akun_edit" maxlength="6">
                                        <small class="text-red">Maksimum 6 karakter</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_akun" class="col-sm-4 col-form-label">Tipe Akun</label>
                                    <div class="col-sm">
                                        <select class="custom-select" name="tipe_akun_edit" id="tipe_akun_edit">
                                            <option value="no-account">--- Pilih ---</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_akun_edit" class="col-sm-4 col-form-label">Nama Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="nama_akun_edit" id="nama_akun_edit">
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button id="kirim_edit" type="button" class="btn btn-primary" onclick="editAkun()">Edit akun</button>
                        </div>
                    </div>
                </div>    
            </div>

<!-- =========================================================================== -->
<!-- =========================================================================== -->

            <div class="card p-3 m-2">
                <div class="card-header px-5 d-flex justify-content-between">
                    <h4>List Tipe Rekening</h4>
                    <button type="button" class="btn btn-main1" data-toggle="modal" data-target="#modal_tambah_tipe">
                        <i class="fas fa-plus"></i> Tambah Tipe
                    </button>
                </div> 
                    
                <div class="card-body" >
                    <div class="p-3">
                        <table class="table table-responsive table-striped " id="list_tipe">
                            <thead>
                                <tr>
                                    <th>Kode Tipe</th>
                                    <th>Nama Tipe</th>
                                    <th>Kategori</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Di sini diisi pake script list.foreach() -->
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            

            <!-- Modal Tambah tipe -->
            <div class="modal fade" id="modal_tambah_tipe">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>

                        </div>

                        <div class="modal-body">
                            <form id="tambah_akun_tipe" class="">
                                <div class="form-group row">
                                    <label for="kode_tipe" class="col-sm-4 col-form-label">Kode Tipe</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" maxlength="6">
                                        <small class="text-red">Maksimum 6 karakter</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-4 col-form-label">Tipe Akun</label>
                                    <div class="col-sm">
                                        <select class="custom-select" name="kategori" id="kategori">
                                            <option value="no-account">--- Pilih ---</option>
                                            <option value="Current Assets">Current Assets</option>
                                            <option value="Fixed Assets">Fixed Assets</option>
                                            <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                            <option value="Liabilities">Liabilities</option>
                                            <option value="Long-term Liabilities">Long-term Liabilities</option>
                                            <option value="Balance of Profit">Balance of Profit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_tipe" class="col-sm-4 col-form-label">Nama Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="nama_tipe" id="nama_tipe">
                                    </div>
                                </div>



                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="addTipe()">Tambah akun</button>
                        </div>
                    </div>
                </div>    
            </div>

            <!-- Modal Edit tipe -->
            <div class="modal fade" id="modal_edit_tipe">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>

                        </div>

                        <div class="modal-body">
                            <form id="edit_akun" class="">
                                <div class="form-group row">
                                    <label for="kode_tipe_edit" class="col-sm-4 col-form-label">Kode Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="kode_tipe_edit" id="kode_tipe_edit" maxlength="6">
                                        <small class="text-red">Maksimum 6 karakter</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_tipe_edit" class="col-sm-4 col-form-label">Nama Akun</label>
                                    <div class="col-sm">
                                        <input class="form-control" type="text" name="nama_tipe_edit" id="nama_tipe_edit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kategori_edit" class="col-sm-4 col-form-label">Tipe Akun</label>
                                    <div class="col-sm">
                                        <select class="custom-select" name="kategori_edit" id="kategori_edit">
                                            <option value="no-account">--- Pilih ---</option>
                                            <option value="Current Assets">Current Assets</option>
                                            <option value="Fixed Assets">Fixed Assets</option>
                                            <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                            <option value="Liabilities">Liabilities</option>
                                            <option value="Long-term Liabilities">Long-term Liabilities</option>
                                            <option value="Balance of Profit">Balance of Profit</option>
                                        </select>
                                    </div>
                                </div>


                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button id="kirim_edit" type="button" class="btn btn-primary" onclick="editTipe()">Edit akun</button>
                        </div>
                    </div>
                </div>    
            </div>

        </div>
    </div>


    


    <script>
        let list = [];
        function updateListAkun(item) {
            $('#list_akun tbody').empty();
            for (let i = 0; i < item.length; i++) {            
                $(`<tr>
                    <td class="text">${item[i]['kode_akun']}</td>
                    <td class="text">${item[i]['nama_akun']}</td>
                    <td class="text">${namaTipe(item[i]['tipe_akun'])}</td>
                    <td class="number">Rp. ${toIDCurrency(item[i]['debit'])}</td>
                    <td class="number">Rp. ${toIDCurrency(item[i]['kredit'])}</td>
                    <td class="number">Rp. ${toIDCurrency(item[i]['saldo'])}</td>
                    <td class="symbol">
                        <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditAkun('${item[i]['uuid']}')">
                            <i class="fas fa-edit"></i>
                        </button>
                    
                        <button class='btn btn-sm btn-danger m-2' hidden>
                            <i class="fas fa-trash-alt"></i> 
                        </button>
                    </td>
                </tr>`).appendTo('#list_akun tbody')
                // console.log(item[i]);
            }
        }

        async function updateList() {
            let result = await fetch('<?= base_url();?>/rekening/list/akun')
            list = await result.json();
            updateListAkun(list)
            return
        }

        async function addAkun() {
            $('#modal_tambah').modal('toggle')
            let form = new FormData($('#tambah_akun')[0]);
            form.append('uuid', crypto.randomUUID());

            await fetch('<?= base_url();?>/rekening/add/akun', {
                method:'post',
                body: form,
            }).then(res => {
                // console.log(res);
                updateList();
            }).catch(err => {
                console.log(err);
            })
        }

        function toggleEditAkun(uuid){
            list.forEach(el => {
                if (el.uuid == uuid) {
                    $('#modal_edit').modal('toggle')
                    $('#kode_akun_edit').val(el.kode_akun)
                    $('#tipe_akun_edit').val(el.tipe_akun)
                    $('#nama_akun_edit').val(el.nama_akun)
                    $('#kirim_edit').attr('onclick', `editAkun('${el.uuid}')`)
                }
            });        
        }

        async function editAkun(uuid) {
            let form = new FormData();
            form.append('kode_akun', $('#kode_akun_edit').val())
            form.append('nama_akun', $('#nama_akun_edit').val())
            form.append('tipe_akun', $('#tipe_akun_edit').val())

            await fetch(`<?= base_url().'/rekening/edit/akun/';?>${uuid}`, {
                method:'post',
                body: form,
            }).then(res => {
                console.log(res.json());
                updateList();
            }).catch(err => {
                console.log(err);
            })
            
            $('#modal_edit').modal('toggle')
        }

    </script>

    

    <script>
        let listtipe = [];
        function updateListTipe(item) {
            $('#list_tipe tbody').empty();
            for (let i = 0; i < item.length; i++) {            
                $(`<tr>
                    <td class="text">${item[i]['kode_tipe']}</td>
                    <td class="text">${item[i]['nama_tipe']}</td>
                    <td class="text">${item[i]['kategori']}</td>
                    <td class="symbol">
                        <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditTipe('${item[i]['uuid']}')">
                            <i class="fas fa-edit"></i>
                        </button>
                    
                        <button class='btn btn-sm btn-danger m-2' hidden>
                            <i class="fas fa-trash-alt"></i> 
                        </button>
                    </td>
                </tr>`).appendTo('#list_tipe tbody')

                $('#tipe_akun').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                $('#tipe_akun_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                console.log(item[i]);
            }
        }

        async function updateTipe() {
            let result = await fetch('<?= base_url();?>/rekening/list/tipe')
            listtipe = await result.json();
            updateListTipe(listtipe)
            return
        }

        async function addTipe() {
            $('#modal_tambah_tipe').modal('toggle')
            let form = new FormData();
            form.append('uuid', crypto.randomUUID());
            form.append('kode_tipe', $('#kode_tipe').val());
            form.append('nama_tipe', $('#nama_tipe').val());
            form.append('kategori', $('#kategori').val());

            await fetch("<?= base_url();?>/rekening/add/tipe", {
                method:'post',
                body: form,
            }).then(res => {
                // console.log(res);
                updateTipe();
            }).catch(err => {
                console.log(err);
            })
        }

        function toggleEditTipe(uuid){
            listtipe.forEach(el => {
                if (el.uuid == uuid) {
                    $('#modal_edit_tipe').modal('toggle')
                    $('#kode_tipe_edit').val(el.kode_tipe)
                    $('#nama_tipe_edit').val(el.nama_tipe)
                    $('#kategori_edit').val(el.kategori)
                    $('#kirim_edit').attr('onclick', `editTipe('${el.uuid}')`)
                }
            });        
        }

        async function editTipe(uuid) {
            let form = new FormData();
            form.append('kode_akun', $('#kode_akun_edit').val());
            form.append('nama_akun', $('#nama_akun_edit').val());

            await fetch(`<?= base_url().'/rekening/edit/';?>${uuid}`, {
                method:'post',
                body: form,
            }).then(res => {
                console.log(res.json());
                updateList();
            }).catch(err => {
                console.log(err);
            })
            
            $('#modal_edit_tipe').modal('toggle')
        }

    </script>

    <script>
        updateList()
        updateTipe()
    </script>

    <script>
        $(document).ready( function(){
            $('#list_akun').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                // order : [[0, 'dsc']]
            });
        });

        $(document).ready( function(){
            $('#list_tipe').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                // order : [[0, 'dsc']]
            });
        });

        function namaTipe(uuid) {
            for (let i = 0; i < listtipe.length; i++) {
                if (uuid == listtipe[i].uuid) {
                    return listtipe[i].nama_tipe
                }
            }
        }
    </script>
</body>
</html>