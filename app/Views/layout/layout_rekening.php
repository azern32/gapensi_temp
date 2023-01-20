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
                                        <input class="form-control" type="text" name="kode_akun" id="kode_akun" maxlength="10">
                                        <small class="text-red">Maksimum 10 karakter</small>
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
                                        <input class="form-control" type="text" name="kode_akun_edit" id="kode_akun_edit" maxlength="10">
                                        <small class="text-red">Maksimum 10 karakter</small>
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
                            <button id="kirim_edit_akun" type="button" class="btn btn-primary" onclick="editAkun()">Edit akun</button>
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
                                            <option value="Other Assets">Other Assets</option>
                                            <option value="Deposit">Deposit</option>
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
                            <button id="kirim_edit_tipe" type="button" class="btn btn-primary" onclick="editTipe()">Edit akun</button>
                        </div>
                    </div>
                </div>    
            </div>

        </div>
    </div>


    


    <script>
        let list = [];





        function updateListAkun(item) {
            for (let i = 0; i < item.length; i++) {
                $('#list_akun').DataTable().row.add([
                    [item[i]['kode_akun']],
                    [item[i]['nama_akun']],
                    [namaTipe(item[i]['tipe_akun'])],
                    [`Rp. ${toIDCurrency(item[i]['debit'])}`],
                    [`Rp. ${toIDCurrency(item[i]['kredit'])}`],
                    [`Rp. ${toIDCurrency(item[i]['saldo'])}`],
                    [tombolAksiAkun(item[i]['uuid'])]
                ]).draw().node().id = item[i]['uuid']
            }
        }

        function tombolAksiAkun(uuid) {
            return `
                    <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditAkun('${uuid}')">
                        <i class="fas fa-edit"></i>
                    </button>
                
                    <button class='btn btn-sm btn-danger m-2' hidden>
                        <i class="fas fa-trash-alt"></i> 
                            <i class="fas fa-trash-alt"></i> 
                        <i class="fas fa-trash-alt"></i> 
                    </button>
            `
        }

        async function updateList() {
            let res = await fetch(`<?= base_url();?>/rekening/list/akun`)
            let item = await res.json()

            for (let i = 0; i < item.length; i++) {
                let {nama_tipe} = await fetch(`<?= base_url();?>/rekening/tipe/${item[i].tipe_akun}`).then(res=>{return res.json()});

                $('#list_akun').DataTable().row.add([
                    [item[i].kode_akun],
                    [item[i].nama_akun],
                    [nama_tipe],
                    [`Rp. ${toIDCurrency(item[i].debit)}`],
                    [`Rp. ${toIDCurrency(item[i].kredit)}`],
                    [`Rp. ${toIDCurrency(item[i].saldo)}`],
                    [tombolAksiAkun(item[i].uuid)]
                ]).draw().node().id = item[i].uuid

            }
        }

        function tulisListAkun(arr) {
            arr.forEach(el => {
                let wah = namaTipe(el.tipe_akun)

                $('#list_akun').DataTable().row.add([
                    [el.kode_akun],
                    [el.nama_akun],
                    [wah],
                    [`Rp. ${toIDCurrency(el.debit)}`],
                    [`Rp. ${toIDCurrency(el.kredit)}`],
                    [`Rp. ${toIDCurrency(el.saldo)}`],
                    [tombolAksiAkun(el.uuid)]
                ]).draw().node().id = el.uuid
            });
        }

        async function updateListLatest(uuid) {
            let result = await fetch(`<?= base_url();?>/rekening/listlatest/akun/${uuid}`)
            updateListAkun([await result.json()])
            return
        }

        async function addAkun() {
            $('#modal_tambah').modal('toggle')
            let form = new FormData($('#tambah_akun')[0]);
            form.append('uuid', crypto.randomUUID());

            let data = await fetch('<?= base_url();?>/rekening/add/akun', {
                method:'post',
                body: form,
            })

            let res = await data.json()
            updateListLatest(res.body.uuid);
        }

        function toggleEditAkun(uuid){
            list.forEach(el => {
                if (el.uuid == uuid) {
                    $('#modal_edit').modal('toggle')
                    $('#kode_akun_edit').val(el.kode_akun)
                    $('#tipe_akun_edit').val(el.tipe_akun)
                    $('#nama_akun_edit').val(el.nama_akun)
                    $('#kirim_edit_akun').attr('onclick', `editAkun('${el.uuid}')`)
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
                updateList()
            }).catch(err => {
                console.log(err);
            })
            
            $('#modal_edit').modal('toggle')
        }

    </script>

    

    <script>


        function updateListTipe(item) {
            for (let i = 0; i < item.length; i++) {
                $('#list_tipe').DataTable().row.add([
                    [item[i]['nama_tipe']],
                    [item[i]['kategori']],
                    [tombolAksiTipe(item[i]['uuid'])]
                ]).draw().node().id = item[i]['uuid']

                $('#tipe_akun').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                $('#tipe_akun_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                console.log(item[i]);
            }
        }

        function tombolAksiTipe(uuid) {
            return `
                <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditTipe('${uuid}')">
                    <i class="fas fa-edit"></i>
                </button>
                `
        }

        async function updateTipe() {
            let res = await fetch(`<?= base_url();?>/rekening/list/tipe`)
            let item = await res.json()

            for (let i = 0; i < item.length; i++) {
                $('#list_tipe').DataTable().row.add([
                    [item[i]['nama_tipe']],
                    [item[i]['kategori']],
                    [tombolAksiTipe(item[i]['uuid'])]
                ]).draw().node().id = item[i]['uuid']

                $('#tipe_akun').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                $('#tipe_akun_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_tipe']}</option>`)
                console.log(item[i]);
            }
        }

        async function updateTipeLatest(uuid) {
            let result = await fetch(`<?= base_url();?>/rekening/list/tipe/${uuid}`)
            let x = await result.json()
            updateListTipe(x)
            return 
        }

        async function addTipe() {
            $('#modal_tambah_tipe').modal('toggle')
            let form = new FormData();
            form.append('uuid', crypto.randomUUID());
            form.append('nama_tipe', $('#nama_tipe').val());
            form.append('kategori', $('#kategori').val());

            await fetch("<?= base_url();?>/rekening/add/tipe", {
                method:'post',
                body: form,
            }).then(res => {
                // console.log(res);
                updateTipeLatest(form.get('uuid'));
            }).catch(err => {
                console.log(err);
            })
        }

        async function toggleEditTipe(uuid){
            let data = await fetch(`<?= base_url();?>/rekening/tipe/${uuid}`).then(res=>{return res.json()})

            $('#nama_tipe_edit').val(data.nama_tipe)
            $('#kategori_edit').val(data.kategori)
            $('#kirim_edit_tipe').attr('onclick', `editTipe('${data.uuid}')`)
            console.log(data.uuid);
            
            $('#modal_edit_tipe').modal('toggle')
        }

        async function editTipe(uuid) {
            let form = new FormData();
            form.append('kode_akun', $('#kode_akun_edit').val());
            form.append('nama_akun', $('#nama_akun_edit').val());

            await fetch(`<?= base_url().'/rekening/edit/';?>${uuid}`, {
                method:'post',
                body: form,
            }).then(res => {
                updateTipe();
            }).catch(err => {
                console.log(err);
            })
            
            $('#modal_edit_tipe').modal('toggle')
        }

    </script>


    <script>
        $(document).ready( function(){
            $('#list_akun').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
            });

            $('#list_tipe').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "searching": true,
            });

        });
        
        updateTipe()
        updateList()


    </script>
</body>
</html>