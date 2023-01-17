

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
                    <button class="btn btn-sm btn-outline-info m-2" onclick="editJurnal('<?= $value->uuid?>')"><i class="fas fa-edit"></i></button>
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
                        <label for="bukti_transaksi_edit">Bukti Transaksi</label>
                        <div class="input-group" style="max-width:400px;" >
                            <div class="custom-file">
                                <label for="bukti_transaksi_edit" class="custom-file-label">File berupa *.png, *.jpeg, atau *.jpg, </label>
                                <input class="custom-file-input" multiple type="file" id="bukti_transaksi_edit" name="bukti_transaksi_edit[]" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>

                    <div class="m-2">
                        <div id="file-view_edit" class="row d-flex justify-content-start"
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
        form.append('tahun', new Date($('#tanggal').val()).getFullYear())

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
    /*
    Tarik nama file dari database
    Gunakan nama file untuk lengkapi path gambar dari server
    Gambar diubah kedalam Blob
    Blob diubah kedalam File, masukkan ke dalam Datatransfer
    Datatransfer.files masukkan ke dalam input_type_file.files
    input_type_file.files dibaca dengan Filereader
    Filereader.result digunakan sebagai src untuk tampilkan gambar

    ketika menekan input_type_file, hanya menambahkan daftar Datatransfer
    */
    let dt_edit = new DataTransfer()

    async function editJurnal(uuid) {
        dt_edit.clearData()
        let dataJurnal = await getJurnal(uuid)
        let arrayGambar = JSON.parse(dataJurnal.bukti_transaksi)

        $('#modal_edit_kegiatan').modal('show')

        $('#tanggal_edit').val(dataJurnal.tanggal);
        $('#keterangan_edit').val(dataJurnal.keterangan);
        $('#akun_debet_edit').val(dataJurnal.akun_debet);
        $('#akun_kredit_edit').val(dataJurnal.akun_kredit);
        $('#nilai_edit').val(dataJurnal.nilai);
        $('#submit_button_edit').attr('onclick', `updateJurnal('${dataJurnal.uuid}')`);

        for (let i = 0; i < arrayGambar.length; i++) {
            dt_edit.items.add(await getImageFile(path_transaksi(uuid)+arrayGambar[i], arrayGambar[i]))
        }

        updatelistgambar()
    }

    async function updateJurnal(uuid) {
        let form = new FormData($('#edit_jurnal')[0])

        form.set('timestamp', Date.now())
        form.set('tanggal', $('#tanggal_edit').val())
        form.set('keterangan', $('#keterangan_edit').val())
        form.set('akun_debet', $('#akun_debet_edit').val())
        form.set('akun_kredit', $('#akun_kredit_edit').val())
        form.set('nilai', $('#nilai_edit').val())
        form.append('tahun', new Date($('#tanggal_edit').val()).getFullYear())
        form.delete('uuid')

        await fetch(`<?= base_url('dashboard/edit')?>/${uuid}`,{
            method:'post',
            body:form,
        }).then(x=>{
            // return x.json()
            console.log(x.json());
            $('#modal_edit_kegiatan').modal('hide')
            $('#edit_jurnal')[0].reset()
        })

    }

    $('#bukti_transaksi_edit').change(()=>{
        let addedDT = $('#bukti_transaksi_edit')[0].files;

        for (let i = 0; i < addedDT.length; i++) {
            dt_edit.items.add(addedDT[i])
        }

        updatelistgambar()
    })

    function path_transaksi(uuid) {
        return `<?= base_url()."/uploads/bukti_transaksi/"?>${uuid}/`
    }

    async function getJurnal(uuid) {
        let res = await fetch(`<?= base_url();?>/dashboard/getjurnal/${uuid}`)
        return res.json()
    }    

    async function getImageFile(url, name) {
        let hasil = await fetch(url)
                    .then(res=>{return res.blob()})
                    .then(res=>{return new File([res], name, {type:res.type})})
        return hasil
    }

    function showImage(file, id) {
        let reader = new FileReader()
        if (/\.(jpe?g|png)$/i.test(file.name)) {
            reader.addEventListener('load', ()=>{
                $(`#file-view_edit`).append(
                    `<div style="">
                        <img style="position:relative;z-index:5; max-height:150px" title="${file.name}" src="${reader.result}" class="m-2" id="img_preview_edit_${id}" onclick="removeFileFromFileList_edit(${id}, 'bukti_transaksi_edit')">
                        <span style="position:relative;text-align: center;right: 50%; color:red;"><i class="fas fa-trash-alt"></i> Delete ?</span>
                    </div>`
                )
            },false)

            return reader.readAsDataURL(file);
        }
    }


    function removeFileFromFileList_edit(index, tagID) {
        let dt = new DataTransfer
        let input = $(`#${tagID}`)[0]
        let { files } = input

        // console.log(files[index]);

        for (let i = 0; i < files.length; i++) {
            let file = files[i]
            if (index !== i) {
                dt.items.add(file) // here you exclude the file. thus removing it.
            }
        }

        dt_edit = dt
        updatelistgambar()
    }

    function updatelistgambar() {
        // console.log('updatelistgambar');
        $(`#file-view_edit`).empty();
        for (let i = 0; i < dt_edit.files.length; i++) {
            showImage(dt_edit.files[i], i)
        }
        $('#bukti_transaksi_edit')[0].files = dt_edit.files
        console.log(dt_edit);
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
                $(`#file-view`).append(
                    `<div style="">
                        <img style="position:relative;z-index:5; max-height:150px" title="${file.name}" src="${reader.result}" class="m-2" id="img_preview_${imgID}" onclick="removeFileFromFileList(${imgID}, 'bukti_transaksi')">
                        <span style="position:relative;text-align: center;right: 50%; color:red;"><i class="fas fa-trash-alt"></i> Delete ?</span>
                    </div>`
                )
            }, false);
            reader.readAsDataURL(file);
        }
    }

    function removeFileFromFileList(index, tagID) {
        let dt = new DataTransfer()
        let input = $(`#${tagID}`)[0]
        let { files } = input
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



