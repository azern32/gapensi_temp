<div class="container">
    <div class="m-3">
        <h3>Rekening</h3>
        <div class="row">
            <div class="card card-konas m-3">
                <div class="card-header px-5 d-flex justify-content-between">
                    <h4>List Akun Rekening</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_tambah">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="card-body" >
                    <div class="p-3">
                        <table class="table table-responsive table-striped " id="list_akun">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <!-- <th>Bisa Kirim</th> -->
                                    <!-- <th>Bisa Terima</th> -->
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

            <div class="card card-konas m-3">
                <div class="card-header px-5 d-flex justify-content-between">
                    <h4>List Akun Hutang</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_tambah_hutang">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="card-body" >
                    <div class="p-3">
                        <table class="table table-responsive table-striped " id="list_akun_hutang">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Jumlah Debit</th>
                                    <th>Jumlah Kredit</th>
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
                            <input class="form-control" type="text" name="kode_akun" id="kode_akun">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_akun" class="col-sm-4 col-form-label">Nama Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_akun" id="nama_akun">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="bisa_kirim" class="col-sm-4 col-form-label">Bisa Kirim</label>
                        <div class="col-sm">
                            <label for="bisa_kirim" class="switch">
                                <input class="form-control" type="checkbox" name="bisa_kirim" id="bisa_kirim">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="bisa_terima" class="col-sm-4 col-form-label">Bisa Terima</label>
                        <div class="col-sm">
                            <label for="bisa_terima" class="switch">
                                <input class="form-control" type="checkbox" name="bisa_terima" id="bisa_terima">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div> -->



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
                            <input class="form-control" type="text" name="kode_akun_edit" id="kode_akun_edit" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_akun_edit" class="col-sm-4 col-form-label">Nama Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_akun_edit" id="nama_akun_edit">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="bisa_kirim_edit" class="col-sm-4 col-form-label">Bisa kirim</label>
                        <div class="col-sm">
                            <label for="bisa_kirim_edit" class="switch">
                                <input class="form-control" type="checkbox" name="bisa_kirim_edit" id="bisa_kirim_edit">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="bisa_terima_edit" class="col-sm-4 col-form-label">Bisa Terima</label>
                        <div class="col-sm">
                            <label for="bisa_terima_edit" class="switch">
                                <input class="form-control" type="checkbox" name="bisa_terima_edit" id="bisa_terima_edit">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div> -->
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button id="kirim_edit" type="button" class="btn btn-primary" onclick="editAkun()">Edit akun</button>
            </div>
        </div>
    </div>    
</div>

<!-- Modal Tambah akun hutang -->
<div class="modal fade" id="modal_tambah_hutang">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

            </div>

            <div class="modal-body">
                <form id="tambah_akun_hutang" class="">
                    <div class="form-group row">
                        <label for="kode_akun_hutang" class="col-sm-4 col-form-label">Kode Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="kode_akun_hutang" id="kode_akun_hutang">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_akun_hutang" class="col-sm-4 col-form-label">Nama Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_akun_hutang" id="nama_akun_hutang">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addAkunHutang()">Tambah akun</button>
            </div>
        </div>
    </div>    
</div>

<!-- Modal Edit akun hutang -->
<div class="modal fade" id="modal_edit_hutang">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

            </div>

            <div class="modal-body">
                <form id="edit_akun_hutang" class="">
                    <div class="form-group row">
                        <label for="kode_akun_edit_hutang" class="col-sm-4 col-form-label">Kode Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="kode_akun_edit_hutang" id="kode_akun_edit_hutang" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_akun_edit_hutang" class="col-sm-4 col-form-label">Nama Akun</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_akun_edit_hutang" id="nama_akun_edit_hutang">
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button id="kirim_edit_hutang" type="button" class="btn btn-primary" onclick="editAkunHutang()">Edit akun</button>
            </div>
        </div>
    </div>    
</div>


<?php 
    foreach ($dependencies as $key => $value) {
        echo "<!--". $key ."-->"."\n"."    <script src='".$value."'></script>";
    }
?>

<script>
    let list = [];
    function updateListAkun(item) {
        $('#list_akun tbody').empty();
        for (let i = 0; i < item.length; i++) {            
            $(`<tr>
                <td class="text">${item[i]['kode_akun']}</td>
                <td class="text">${item[i]['nama_akun']}</td>`+
                // <td class="symbol">${Number(item[i]['bisa_kirim']) ? "✔":"❌" }</td>
                // <td class="symbol">${Number(item[i]['bisa_terima']) ? "✔":"❌"}</td>
                `<td class="number">Rp. ${toIDCurrency(item[i]['debit'])}</td>
                <td class="number">Rp. ${toIDCurrency(item[i]['kredit'])}</td>
                <td class="number">Rp. ${toIDCurrency(item[i]['saldo'])}</td>
                <td class="symbol">
                    <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditAkun('${item[i]['kode_akun']}')">
                        <i class="fas fa-edit"></i>
                    </button>
                
                    <button class='btn btn-sm btn-danger m-2' hidden>
                        <i class="fas fa-trash-alt"></i> 
                    </button>
                </td>
            </tr>`).appendTo('#list_akun tbody')
            console.log(item[i]);
        }
    }

    async function updateList() {
        let result = await fetch('<?= base_url().'/rekening/list/akunrekening';?>')
        // list = await result.json();
        list = await result.json();
        updateListAkun(list)
        return 
    }

    async function addAkun() {
        $('#modal_tambah').modal('toggle')
        let form = new FormData();
        form.append('kode_akun', $('#kode_akun').val());
        form.append('nama_akun', $('#nama_akun').val());
        // form.append('bisa_kirim', Number($('#bisa_kirim').prop('checked')));
        // form.append('bisa_terima', Number($('#bisa_terima').prop('checked')));

        await fetch('<?= base_url().'/rekening/add/akunrekening';?>', {
            method:'post',
            body: form,
        }).then(res => {
            // console.log(res);
            updateList();
        }).catch(err => {
            console.log(err);
        })
    }

    function toggleEditAkun(kode_akun){
        list.forEach(el => {
            if (el.kode_akun == kode_akun) {
                $('#modal_edit').modal('toggle')
                $('#kode_akun_edit').val(el.kode_akun)
                $('#nama_akun_edit').val(el.nama_akun)
                // $('#bisa_kirim_edit').prop('checked', Number(el.bisa_kirim))
                // $('#bisa_terima_edit').prop('checked', Number(el.bisa_terima))
                $('#kirim_edit').attr('onclick', `editAkun('${el.kode_akun}')`)
            }
        });        
    }

    async function editAkun(kode_akun) {
        let form = new FormData();
        form.append('kode_akun', $('#kode_akun_edit').val());
        form.append('nama_akun', $('#nama_akun_edit').val());
        // form.append('bisa_kirim', Number($('#bisa_kirim_edit').prop('checked')));
        // form.append('bisa_terima', Number($('#bisa_terima_edit').prop('checked')));

        await fetch(`<?= base_url().'/rekening/edit/';?>${kode_akun}`, {
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


    let listHutang = [];
    function updateListAkunHutang(item) {
        $('#list_akun_hutang tbody').empty();
        for (let i = 0; i < item.length; i++) {            
            $(`<tr>
                <td class="text">${item[i]['kode_akun']}</td>
                <td class="text">${item[i]['nama_akun']}</td>
                <td class="number">Rp. ${toIDCurrency(item[i]['debit'])}</td>
                <td class="number">Rp. ${toIDCurrency(item[i]['kredit'])}</td>
                <td class="symbol">
                    <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditAkunHutang('${item[i]['kode_akun']}')">
                        <i class="fas fa-edit"></i>
                    </button>
                
                    <button class='btn btn-sm btn-danger m-2' hidden>
                        <i class="fas fa-trash-alt"></i> 
                    </button>
                </td>
            </tr>`).appendTo('#list_akun_hutang tbody')
            console.log(item[i]);
        }
    }

    async function updateListHutang() {
        let result = await fetch('<?= base_url().'/rekening/list/akunhutang';?>')
        // list = await result.json();
        listHutang = await result.json();
        updateListAkunHutang(listHutang)
        // console.log(await result.json());
        return 
    }

    async function addAkunHutang() {
        $('#modal_tambah_hutang').modal('toggle')
        let form = new FormData();
        form.append('kode_akun', $('#kode_akun_hutang').val());
        form.append('nama_akun', $('#nama_akun_hutang').val());

        await fetch('<?= base_url().'/rekening/add/akunhutang';?>', {
            method:'post',
            body: form,
        }).then(res => {
            updateListHutang();
        }).catch(err => {
            console.log(err);
        })
    }

    function toggleEditAkunHutang(kode_akun){
        listHutang.forEach(el => {
            if (el.kode_akun == kode_akun) {
                $('#modal_edit_hutang').modal('toggle')
                $('#kode_akun_edit_hutang_hidden').val(el.kode_akun)
                $('#kode_akun_edit_hutang').val(el.kode_akun)
                $('#nama_akun_edit_hutang').val(el.nama_akun)
                $('#kirim_edit_hutang').attr('onclick', `editAkunHutang('${el.kode_akun}')`)
            }
        });
    }

    async function editAkunHutang(kode_akun) {
        let form = new FormData();
        form.append('kode_akun', $('#kode_akun_edit_hutang').val());
        form.append('nama_akun', $('#nama_akun_edit_hutang').val());

        await fetch(`<?= base_url().'/rekening/edithutang/';?>${kode_akun}`, {
            method:'post',
            body: form,
        }).then(res => {
            console.log(res.json());
            updateListHutang();
        }).catch(err => {
            console.log(err);
        })
        
        $('#modal_edit_hutang').modal('toggle')
    }
</script>






<!-- First update of the page -->
<script>
    updateList()
    updateListHutang()
</script>