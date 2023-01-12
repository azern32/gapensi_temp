

<table id="tabel_arus_kas" class="table table-striped">
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Akun Debet</th>
            <th>Akun Kredit</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $key => $value) {?>
            <tr>
                <td class="text-center"><?= $value->timestamp?></td>
                <td class="text-center"><?= $value->tanggal?></td>
                <td class="text-center"><?= $value->keterangan?></td>
                <td class="text-center"><?= getAccountName($value->akun_debet)?></td>
                <td class="text-center"><?= getAccountName($value->akun_kredit)?></td>
                <td class="text-center"><?= $value->nilai?></td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-outline-info m-2" onclick="editJurnal('<?= $value->uuid?>')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-outline-danger m-2" onclick="deleteJurnal('<?= $value->uuid?>')"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php  }?>
    </tbody>
</table>


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
    // console.log(<?php //echo json_encode($list)?>);

    $(document).ready( function(){
        $('#tabel_arus_kas').DataTable({
            order: [[0, 'desc']],
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "searching": true,
            "pageLength": 100,
            "columnDefs":[
                // {target:0, visible:false},
                {target:6, className: "d-flex justify-content-center"},
                {target:[1,2,3,4,5], className: "text-center"}
            ]
            // order : [[0, 'dsc']]
        });
    });
</script>

<script>
    function editJurnal(uuid) {
        console.log('mengedit '+uuid);
    }

    function deleteJurnal(uuid) {
        console.log('menghapus '+uuid);
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
            // console.log(res.json());
            return res.json()
        }).then(x => {
            latestJurnal(x.post.timestamp)
            $('#tambah_jurnal')[0].reset()
            $('#modal_input_kegiatan').modal('hide')
        }).catch(err => {
            console.error(err.message)
        })
    }


    async function latestJurnal(timestamp) {
        await fetch(`<?= base_url();?>/dashboard/listlatest/${timestamp}`)
        .then((res) => {
            return res.json()
        }).then((data) => {
            console.log(data);
            $('#tabel_arus_kas').DataTable().row.add([
                [data.timestamp],
                [data.tanggal],
                [data.keterangan],
                [namaAkun(data.akun_debet)],
                [namaAkun(data.akun_kredit)],
                [data.nilai],
                [tombolAksi(data.uuid)]
            ]).draw().node()
        })
    }
</script>

<script>
    function tombolAksi(uuid) {
        return `
                <button class="btn btn-sm btn-outline-info m-2" onclick="editJurnal('${uuid}')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger m-2" onclick="deleteJurnal('${uuid}')"><i class="far fa-trash-alt"></i></button>
                `
    }
</script>






