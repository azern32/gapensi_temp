<!-- Tabelnya -->
<div class="card p-3 m-2">
    <div class="card-header px-5 d-flex justify-content-between">
        <h4>Daftar Kategori Balance Sheet</h4>
        <button type="button" class="btn btn-main1" data-toggle="modal" data-target="#modal_tambah_bs">
            <i class="fas fa-plus"></i> Tambah Kategori Balance Sheet
        </button>
    </div> 

    <div class="card-body">
        <div class="p-3">
            <table class="table table-responsive table-striped " id="list_bs">
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
<div class="modal fade" id="modal_tambah_bs">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-body">
                <form id="tambah_bs" class="">
                    <div class="form-group row">
                        <label for="nama_bs" class="col-sm-4 col-form-label">Nama Kategori Balance Sheet</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_bs" id="nama_bs">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addbs()">Tambah kategori</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit BS -->
<div class="modal fade" id="modal_edit_bs">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>

            </div>

            <div class="modal-body">
                <form id="edit_bs" class="">


                    <div class="form-group row">
                        <label for="nama_bs_edit" class="col-sm-4 col-form-label">Nama Kategori Balance Sheet</label>
                        <div class="col-sm">
                            <input class="form-control" type="text" name="nama_bs_edit" id="nama_bs_edit">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button id="kirim_edit_bs" type="button" class="btn btn-primary" onclick="editbs()">Edit kategori</button>
            </div>
        </div>
    </div>    
</div>

<script>
    $(document).ready( function(){
        $('#list_bs').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": true,
        });
        
        updateBS()
    })

</script>

<script>
    function updateListBS(item) {
        $('#list_bs').DataTable().clear().draw()

        for (let i = 0; i < item.length; i++) {
            $('#list_bs').DataTable().row.add([
                [item[i]['nama_bs']],
                [tombolAksiBS(item[i]['uuid'])]
            ]).draw().node().id = item[i]['uuid']

            $('#tipe_bs').append(`<option value="${item[i]['uuid']}">${item[i]['nama_bs']}</option>`)
            $('#tipe_bs_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_bs']}</option>`)
            console.log(item[i]);
        }
    }

    function tombolAksiBS(uuid) {
        return `
            <button class='btn btn-sm btn-outline-info m-2' onclick="toggleEditBS('${uuid}')">
                <i class="fas fa-edit"></i>
            </button>

            <button class='btn btn-sm btn-danger m-2' onclick="removebs('${uuid}')">
                <i class="fas fa-trash-alt"></i> 
            </button>
            `
    }

    async function updateBS() {
        let res = await fetch(`<?= base_url();?>/akun/list/bs`)
        let item = await res.json()

        $('#list_bs').DataTable().clear().draw()
        for (let i = 0; i < item.length; i++) {
            $('#list_bs').DataTable().row.add([
                [item[i]['nama_bs']],
                [tombolAksiBS(item[i]['uuid'])]
            ]).draw().node().id = item[i]['uuid']

            $('#tipe_bs').append(`<option value="${item[i]['uuid']}">${item[i]['nama_bs']}</option>`)
            $('#tipe_bs_edit').append(`<option value="${item[i]['uuid']}">${item[i]['nama_bs']}</option>`)
            console.log(item[i]);
        }
    }

    async function updateBSLatest(uuid) {
        let result = await fetch(`<?= base_url();?>/akun/list/bs/${uuid}`)
        let x = await result.json()
        updateListBS(x)
        return 
    }

    async function addbs() {
        $('#modal_tambah_bs').modal('toggle')
        let form = new FormData();
        form.append('uuid', crypto.randomUUID());
        form.append('nama_bs', $('#nama_bs').val());

        await fetch("<?= base_url();?>/akun/add/bs", {
            method:'post',
            body: form,
        }).then(res => {
            updateBSLatest(form.get('uuid'));
        }).catch(err => {
            console.log(err);
        })
    }

    async function toggleEditBS(uuid){
        let data = await fetch(`<?= base_url();?>/akun/bs/${uuid}`).then(res=>{return res.json()})

        $('#nama_bs_edit').val(data.nama_bs)
        $('#kirim_edit_bs').attr('onclick', `editbs('${data.uuid}')`)
        console.log(data.uuid);
        
        $('#modal_edit_bs').modal('toggle')
    }

    async function editbs(uuid) {
        let form = new FormData();
        form.append('nama_bs', $('#nama_bs_edit').val());

        await fetch(`<?= base_url().'/akun/edit/bs/';?>${uuid}`, {
            method:'post',
            body: form,
        }).then(res => {
            updateBS();
        }).catch(err => {
            console.log(err);
        })
        
        $('#modal_edit_bs').modal('toggle')
    }

    async function removebs(uuid) {
        await fetch(`<?= base_url().'/akun/remove/bs/';?>${uuid}`)
        .then(res=>{
            updateBS()
            return res.json()
        }).then(res=>{
            return res.msg
        })
    }

</script>
