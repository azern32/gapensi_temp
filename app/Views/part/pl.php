<!-- Tabelnya -->
<div class="card p-3 m-2">
    <div class="card-header px-5 d-flex justify-content-between">
        <h4>Daftar Kategori Profit/Loss</h4>
        <button type="button" class="btn btn-main1" data-toggle="modal" data-target="#modal_tambah_pl">
            <i class="fas fa-plus"></i> Tambah Kategori Profit/Loss
        </button>
    </div> 

    <div class="card-body">
        <div class="p-3">
            <table class="table table-responsive table-striped " id="list_pl">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
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


<!-- Modal Tambah BS -->
<div class="modal fade" id="modal_tambah_pl">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-body">
                <form id="tambah_pl" class="">
                    <div class="form-group row">
                        <label for="nama_pl" class="col-sm-4 col-form-label">Nama Kategori Profit/Loss</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_pl" id="nama_pl">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addpl()">Tambah kategori</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit BS -->
<div class="modal fade" id="modal_edit_pl">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

            </div>

            <div class="modal-body">
                <form id="edit_pl" class="">
                    <div class="form-group row">
                        <label for="nama_pl_edit" class="col-sm-4 col-form-label">Nama Kategori Profit/Loss</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_pl_edit" id="nama_pl_edit">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button id="kirim_edit_pl" type="button" class="btn btn-primary" onclick="editpl()">Edit kategori</button>
            </div>
        </div>
    </div>    
</div>

<script>
    $(document).ready( function(){
        $('#list_pl').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": true,
        });
        
        updatePL()
    })

</script>

<script>
    function updateListPL(item) {
        $('#list_pl').DataTable().clear().draw()

        for (let i = 0; i < item.length; i++) {
            $('#list_pl').DataTable().row.add([
                [item[i]['nama_pl']],
                [tombolAksiPL(item[i]['uuid'])]
            ]).draw().node().id = item[i]['uuid']

            $('#tipe_pl').append(`<option value="${item[i]['uuid']}">${item[i]['nama_pl']}</option>`)
            $('#tipe_pl_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_pl']}</option>`)
            console.log(item[i]);
        }
    }

    function tombolAksiPL(uuid) {
        return `
            <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditPL('${uuid}')">
                <i class="fas fa-edit"></i>
            </button>

            <button class='btn btn-sm btn-danger m-2' onclick="removepl('${uuid}')">
                <i class="fas fa-trash-alt"></i> 
            </button>
            `
    }

    async function updatePL() {
        let res = await fetch(`<?= base_url();?>/akun/list/pl`)
        let item = await res.json()

        $('#list_pl').DataTable().clear().draw()
        for (let i = 0; i < item.length; i++) {
            $('#list_pl').DataTable().row.add([
                [item[i]['nama_pl']],
                [tombolAksiPL(item[i]['uuid'])]
            ]).draw().node().id = item[i]['uuid']

            $('#tipe_pl').append(`<option value="${item[i]['uuid']}">${item[i]['nama_pl']}</option>`)
            $('#tipe_pl_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_pl']}</option>`)
            console.log(item[i]);
        }
    }

    async function updatePLLatest(uuid) {
        let result = await fetch(`<?= base_url();?>/akun/list/pl/${uuid}`)
        let x = await result.json()
        updateListPL(x)
        return 
    }

    async function addpl() {
        $('#modal_tambah_pl').modal('toggle')
        let form = new FormData();
        form.append('uuid', crypto.randomUUID());
        form.append('nama_pl', $('#nama_pl').val());

        await fetch("<?= base_url();?>/akun/add/pl", {
            method:'post',
            body: form,
        }).then(res => {
            updatePLLatest(form.get('uuid'));
        }).catch(err => {
            console.log(err);
        })
    }

    async function toggleEditPL(uuid){
        let data = await fetch(`<?= base_url();?>/akun/pl/${uuid}`).then(res=>{return res.json()})

        $('#nama_pl_edit').val(data.nama_pl)
        $('#kirim_edit_pl').attr('onclick', `editpl('${data.uuid}')`)
        console.log(data.uuid);
        
        $('#modal_edit_pl').modal('toggle')
    }

    async function editpl(uuid) {
        let form = new FormData();
        form.append('nama_pl', $('#nama_pl_edit').val());

        await fetch(`<?= base_url().'/akun/edit/pl/';?>${uuid}`, {
            method:'post',
            body: form,
        }).then(res => {
            updatePL();
        }).catch(err => {
            console.log(err);
        })
        
        $('#modal_edit_pl').modal('toggle')
    }

    async function removepl(uuid) {
        await fetch(`<?= base_url().'/akun/remove/pl/';?>${uuid}`)
        .then(res=>{
            updatePL()
            return res.json()
        }).then(res=>{
            return res.msg
        })
    }

</script>
