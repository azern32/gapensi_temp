

<div class="card mx-2" style="min-width: 24rem;">
    <div class="card-body">
        <div class="mx-auto d-flex flex-column align-items-center" onclick="openpdf<?= $table_name?>('<?php if(!empty($document)){echo $document['uuid'];}?>')">
            <?php 
                if (isset($document['uuid'])) {
                    echo '<i class="fas fa-file-pdf" style="font-size: 6rem;"></i>';
                } else {
                    echo '<i class="fas fa-search-minus" style="font-size: 6rem;"></i>';
                }
            ?>
            <strong class="my-2" style="text-decoration: underline; font-size:4ren"><?= $RKA_type?></strong>
            <small>Update - <span id="update_<?= $table_name?>"></span></small>
        </div>
        <div class="d-flex my-3" style="justify-content: space-evenly;">
            <a class="btn btn-bg btn-main1" href="<?php if(!empty($document)){echo base_url()."/uploads/$table_name/".$document['uuid'].'/'.$document['nama_file'];} ?>" download >
                <i class="fas fa-download"></i>
                Download 
            </a>
            <button class="btn btn-bg btn-outline-main1" <?php if (isset($table_name)){ echo 'data-toggle="modal" data-target="#history-'.$table_name.'"'; }?>>
                <i class="fas fa-history"></i>
                History 
            </button>
            <?php if ($session['level'] != 2) { ?>
                <button class="btn btn-bg btn-main2" <?php if (isset($modal_id)){ echo 'data-toggle="modal" data-target="#update-'.$modal_id.'"'; }?>>
                    <i class="fas fa-sync"></i>
                    Update
                </button>
            <?php }?>
        </div>
    </div>
</div>




<?php if (isset($table_name)) { ?>
    <!-- Modal history -->
    <div class="modal fade" id='history-<?= $table_name?>'>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <table id="history-tabel-<?= $table_name?>" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal Upload</th>
                                <th>Nama File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php if (isset($modal_id)) { ?>
    <!-- Modal update -->
    <div class="modal fade" id='update-<?= $modal_id?>'>
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Upload <?= $RKA_type?> Terbaru</h5>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="updateFile_<?=$modal_id?>" name="updateFile_<?=$modal_id?>" accept="application/pdf">

                            <label class="custom-file-label" for="updateFile_<?=$modal_id?>"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Judul RKA</label>
                        <input class="form-control" type="text" id="judul_file_<?=$modal_id?>" name="judul_file_<?=$modal_id?>">
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Ukuran File</small> 
                        </div>
                        <div class="col">
                            <small>:  <span id="upload_ukuran_<?=$modal_id?>">0</span> MB</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Tanggal Upload</small> 
                        </div>
                        <div class="col">
                            <small>: <span id="upload_tanggal_<?=$modal_id?>"></span></small> 
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex">
                    <button class="btn btn-outline-main1" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button class="btn btn-main1" onclick="submit<?= $table_name?>()">
                        <i class="fas fa-file-upload"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }?>





<script>
    async function rka_list<?= $table_name?>() {
        await fetch(`<?= base_url()?>/rka/list/<?= $table_name?>`)
        .then(res => {
            return res.json()
        }).then(data=>{
            // console.log(data);
            data.forEach(el => {
                $(`#history-tabel-<?= $table_name?> tbody`).append(`
                    <tr>
                        <td class="text-center">${tanggal(Number(el.timestamp))}</td>
                        <td class="text-center">${el.judul_file}</td>
                        <td class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-outline-info m-2" onclick="openpdf<?= $table_name?>('${el.uuid}')"><i class="far fa-eye"></i></button>
                        </td>
                    </tr>
                `)
            });
        }).then(x=>{
            (function(){
                $('#history-tabel-<?= $table_name?>').DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": true,
                    "searching": true,
                    // order : [[0, 'dsc']]
                });
            })()
        })
    }

    rka_list<?= $table_name?>()
</script>



<script>
    // var uploadField = $('#updateFile_<?=$modal_id?>')[0];

    if ($('#updateFile_<?=$modal_id?>')[0] != undefined) {
        $('#updateFile_<?=$modal_id?>')[0].onchange = function() {
            if(this.files[0].size > (3 * 1048576)){
                alert("File terlalu besar! Maximum 3MB");
                this.value = "";
            };

            if(this.files[0].name.length > 255){
                alert("Jumlah karakter nama file terlalu panjang");
                this.value = "";
            };

            $('#upload_ukuran_<?=$modal_id?>').text(`${(this.files[0].size / 1048576).toFixed(2)}`)
            $('#upload_tanggal_<?=$modal_id?>').text(tanggal(Date.now()))
        };
    }

    function submit<?=$table_name?>() {
        let form = new FormData();
        form.append('uuid', crypto.randomUUID())
        form.append('timestamp', Date.now())
        form.append('tahun', new Date().getFullYear())
        form.append('nama_file', $('#updateFile_<?=$modal_id?>')[0].files[0].name)
        form.append('judul_file', $('#judul_file_<?=$modal_id?>').val())
        form.append('file', $('#updateFile_<?=$modal_id?>')[0].files[0])

        fetch(`<?= base_url()?>/rka/add/<?=$table_name?>`, {
            method:'post',
            body:form
        }).then(x=>{
            console.log(x.json())
            $('#update-<?= $modal_id?>').modal('hide')
        })
    }

    function openpdf<?= $table_name?>(uuid) {
        window.open(`<?php if(!empty($document)){echo base_url()."/uploads/$table_name/"?>${uuid}/<?= $document['judul_file'];} ?>.pdf`)
    }

</script>


<!-- Script only for this file -->
<script>
    console.log('<?php if(!empty($document)){echo $document['timestamp'];} ?>');
    $('#update_<?= $table_name?>').text(`
        <?php if (empty($document)) {
                echo 'Belum ada dokumen';
            } else {
                echo '${tanggal('.$document['timestamp'].')}';
            }
        ?>
    `)
        
</script>