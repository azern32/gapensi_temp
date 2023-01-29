<div class="card p-3 m-2">
    <div class="card-header px-5 d-flex justify-content-between">
        <h4>Daftar Akun</h4>
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

<script>
    $(document).ready( function(){

        $('#list_akun').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
        })

        updateList()
    })

</script>


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
        let res = await fetch(`<?= base_url();?>/akun/list/akun`)
        let item = await res.json()

        for (let i = 0; i < item.length; i++) {
            let {nama_tipe} = await fetch(`<?= base_url();?>/akun/tipe/${item[i].tipe_akun}`).then(res=>{return res.json()});

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
        let result = await fetch(`<?= base_url();?>/akun/listlatest/akun/${uuid}`)
        updateListAkun([await result.json()])
        return
    }

    async function addAkun() {
        $('#modal_tambah').modal('toggle')
        let form = new FormData($('#tambah_akun')[0]);
        form.append('uuid', crypto.randomUUID());

        let data = await fetch('<?= base_url();?>/akun/add/akun', {
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

        await fetch(`<?= base_url().'/akun/edit/akun/';?>${uuid}`, {
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

    