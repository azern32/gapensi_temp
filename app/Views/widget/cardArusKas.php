

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
            <tr id="<?= $value->uuid?>">
                <td class="text-center"><?= $value->timestamp?></td>
                <td class="text-center"><?= $value->tanggal?></td>
                <td class="text-center"><?= $value->keterangan?></td>
                <td class="text-center"><?= getAccountName($value->akun_debet)?></td>
                <td class="text-center"><?= getAccountName($value->akun_kredit)?></td>
                <td class="text-center"><?= $value->nilai?></td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-outline-info m-2" onclick="getJurnal('<?= $value->uuid?>')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-outline-danger m-2" onclick="deleteJurnal('<?= $value->uuid?>')"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php  }?>
    </tbody>
</table>

<!-- Modal tambah jurnal -->
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
                                <label for="bukti_transaksi" class="custom-file-label">File berupa *.png, *.jpeg, atau *.jpg, </label>
                                <input class="custom-file-input" multiple type="file" id="bukti_transaksi" name="bukti_transaksi[]" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>

                    <div class="m-2">
                        <div id="file-view" class="row d-flex justify-content-start"
                            style="border: 1px solid #ced4da;border-radius: 0.5rem;height:20rem;overflow-y:scroll">
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

<!-- Modal edit jurnal -->
<div class="modal fade" id="modal_edit_kegiatan">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Jurnal</h5>
            </div>

            <form id="edit_jurnal" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal_edit">Tanggal Kegiatan</label>
                        <input class="form-control"  type="date" id="tanggal_edit" name="tanggal_edit" style="max-width:200px;">
                    </div>

                    <div class="form-group">
                        <label for="keterangan_edit">Keterangan</label>
                        <textarea class="form-control" name="keterangan_edit" id="keterangan_edit"></textarea>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label for="akun_debet_edit">Akun Debet</label>
                            <select class="form-control" name="akun_debet_edit" id="akun_debet_edit">
                                <option value="no-account">--- Pilih ---</option>
                                
                            </select>
                        </div>

                        <div class="col form-group">
                            <label for="akun_kredit_edit">Akun Kredit</label>
                            <select class="form-control" name="akun_kredit_edit" id="akun_kredit_edit">
                                <option value="no-account">--- Pilih ---</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input class="form-control" type="number" style="max-width:400px;" id="nilai_edit" name="nilai_edit">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="bukti_transaksi">Bukti Transaksi</label>
                        <div class="input-group" style="max-width:400px;" >
                            <div class="custom-file">
                                <label for="bukti_transaksi" class="custom-file-label">File berupa *.png, *.jpeg, atau *.jpg, </label>
                                <input class="custom-file-input" multiple type="file" id="bukti_transaksi_edit" name="bukti_transaksi_edit[]" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>

                    <div class="m-2">
                        <div id="file-view" class="row d-flex justify-content-start"
                            style="border: 1px solid #ced4da;border-radius: 0.5rem;height:20rem;overflow-y:scroll">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-main1" data-dismiss="modal">Batal</button>
                    <button type="button" id="submit_button_edit" class="btn btn-main1" name="button_edit" onclick="editJurnal()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let data4Jurnal = [];
    // console.log(<?php //echo json_encode($list)?>);

    $(document).ready( function(){
        listingJurnal()
        $('#tabel_arus_kas').DataTable({
            order: [[0, 'desc']],
            rowId: 'wah',
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "searching": true,
            "pageLength": 50,
            "columnDefs":[
                {target:0, visible:false},
                {target:6, className: "d-flex justify-content-center"},
                {target:[1,2,3,4,5], className: "text-center"}
            ]
        });
    });
</script>

<script>
    async function listingJurnal() {
        await fetch('<?= base_url('dashboard/list')?>').then(x =>{
            return x.json()
        }).then(x=>{
            data4Jurnal = x;
        }).catch(err => {
            console.log('Error: ', err.message);
        })
    }

    async function editJurnal(uuid) {
        console.log('mengedit '+uuid);
    }


    async function deleteJurnal(uuid) {
        await fetch(`<?= base_url();?>/dashboard/remove/${uuid}`)
        .then(res => {
            return res.json();
        }).then(x=>{
            $(`#${uuid}`).remove();
        })
    }
</script>


<!-- Script untuk tambah jurnal-->
<script>
    async function addJurnal(){
        // $('#modal_tambah_tipe').modal('toggle')
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
            ]).draw().node().id = data.uuid;
        })
    }
</script>

<!-- Script untuk edit jurnal -->
<script>
    async function editJurnal(uuid) {
        let form = new FormData();
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

    async function getJurnal(uuid) {
        await fetch(`<?= base_url();?>/dashboard/getjurnal/${uuid}`)
        .then(res => {
            // console.log(res.json());
            $('#modal_edit_kegiatan').modal('toggle')
            return res.json()
        }).then(res =>{
            $('#tanggal_edit').val(res.tanggal)
            $('#keterangan_edit').val(res.keterangan)
            $('#akun_debet_edit').val(res.akun_debet)
            $('#akun_kredit_edit').val(res.akun_kredit)
            $('#nilai_edit').val(res.nilai)
            $('#submit_button_edit').attr('onclick', `editJurnal(${res.uuid})`)
            console.log(res.bukti_transaksi);

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


<!-- Script untuk tampilkan gambar yang diupload -->
<!-- JANGAN DIGANGGU -->
<script>
    $('#bukti_transaksi').change(()=>{
        showFileList($('#bukti_transaksi')[0].files, readAndPreview)
    })

    function showFileList(fileList, callback) {
        if (fileList) {
            console.log(fileList.length);
            for (var i = 0; i < fileList.length; i++) {
                callback(fileList[i], i);
            }
        }
    }
    
    async function readAndPreview(file, imgID) {
        // Make sure `file.name` matches our extensions criteria
        if (/\.(jpe?g|png)$/i.test(file.name)) {
            let reader = new FileReader();
            reader.addEventListener("load", ()=>{
                console.log(reader);
                $(`#file-view`).append(
                    `<div style="">
                        <img style="position:relative;z-index:5; max-height:150px" title="${file.name}" src="${reader.result}" class="m-2" id="img_preview_${imgID}" onclick="removeFileFromFileList(${imgID})">
                        <span style="position:relative;text-align: center;right: 50%; color:red;"><i class="fas fa-trash-alt"></i> Delete ?</span>
                    </div>`
                )
            }, false);
            reader.readAsDataURL(file);
        }
    }

    function removeFileFromFileList(index) {
        let dt = new DataTransfer()
        let input = $('#bukti_transaksi')[0]
        let { files } = input
        console.log(files[index]);
        for (let i = 0; i < files.length; i++) {
            let file = files[i]
            if (index !== i) {
                dt.items.add(file) // here you exclude the file. thus removing it.
            }
        }
        input.files = dt.files // Assign the updates list
        console.log(dt.files);
        if (files) {
            $('#file-view').empty();
            [].forEach.call(dt.files, readAndPreview);
        }
    }

</script>



