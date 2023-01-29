<div class="card p-3 m-2">
    <div class="card-header px-5 d-flex justify-content-between">
        <h4>Daftar Tipe Akun</h4>
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
                        <label for="nama_tipe" class="col-sm-4 col-form-label">Nama Tipe</label>
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

<script>
    $(document).ready( function(){
        $('#list_tipe').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": true,
        });
        
        updateTipe();
    })
</script>



<script>
        let listtipe = [];

    function updateListTipe(item) {
        $('#list_tipe').DataTable().clear().draw()

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

            <button class='btn btn-sm btn-danger m-2' onclick="removetipe('${uuid}')">
                <i class="fas fa-trash-alt"></i> 
            </button>
            `
    }

    async function updateTipe() {
        let res = await fetch(`<?= base_url();?>/akun/list/tipe`)
        let item = await res.json()

        listtipe = item

        $('#list_tipe').DataTable().clear().draw()

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
        let result = await fetch(`<?= base_url();?>/akun/list/tipe/${uuid}`)
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

        await fetch("<?= base_url();?>/akun/add/tipe", {
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
        let data = await fetch(`<?= base_url();?>/akun/tipe/${uuid}`).then(res=>{return res.json()})

        $('#nama_tipe_edit').val(data.nama_tipe)
        $('#kategori_edit').val(data.kategori)
        $('#kirim_edit_tipe').attr('onclick', `editTipe('${data.uuid}')`)
        console.log(data.uuid);
        
        $('#modal_edit_tipe').modal('toggle')
    }

    async function editTipe(uuid) {
        let form = new FormData();
        form.append('kategori', $('#kategori_edit').val());
        form.append('nama_tipe', $('#nama_tipe_edit').val());

        await fetch(`<?= base_url().'/akun/edit/tipe/';?>${uuid}`, {
            method:'post',
            body: form,
        }).then(res => {
            updateTipe();
        }).catch(err => {
            console.log(err);
        })
        
        $('#modal_edit_tipe').modal('toggle')
    }

    async function removetipe(uuid) {
        await fetch(`<?= base_url().'/akun/remove/tipe/';?>${uuid}`)
        .then(res=>{
            updateTipe()
            return res.json()
        }).then(res=>{
            return res.msg
        })
    }

</script>
