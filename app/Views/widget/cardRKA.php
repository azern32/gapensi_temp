

<div class="card mx-2" style="min-width: 24rem;">
    <div class="card-body">
        <div class="mx-auto d-flex flex-column align-items-center" <?php if (isset($document_uuid)){ echo 'data-toggle="modal" data-target="#preview-'.$document_uuid.'"'; }?>>
            <i class="fas fa-file-pdf" style="font-size: 6rem;"></i>
            <strong class="my-2" style="text-decoration: underline; font-size:4ren"><?= $RKA_type?></strong>
            <small>Update - 21/22/2022</small>
        </div>
        <div class="d-flex my-3" style="justify-content: space-evenly;">
            <button class="btn btn-bg btn-main1">
                <i class="fas fa-download"></i>
                Download 
            </button>
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


<?php if (isset($document_uuid)) { ?>
    <!-- Modal preview -->
    <div class="modal fade" id='preview-<?= $document_uuid?>'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Modal preview pdf
                </div>
            </div>
        </div>
    </div>
<?php }?>

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
                            <?php //foreach ($list as $key => $value) {?>
                                <tr>
                                    <td class="text-center">tanggal</td>
                                    <td class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-outline-info m-2"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger m-2"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php //}?>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Upload <?= $RKA_type?> Terbaru</p>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="updateFile" >
                            <label class="custom-file-label" for="updateFile"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Ukuran File</small> 
                        </div>
                        <div class="col">
                            <small>:  <span id="upload_ukuran">sekian MB</span></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Tanggal Upload</small> 
                        </div>
                        <div class="col">
                            <small>: <span id="upload_tanggal">Sekarang</span></small> 
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex">
                    <button class="btn btn-outline-main1" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button class="btn btn-main1">
                        <i class="fas fa-file-upload"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }?>


<!-- Script only for this file -->
<script>
    $(document).ready( function(){
        $('#history-tabel-<?= $table_name?>').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "searching": true,
            // order : [[0, 'dsc']]
        });
    });

</script>
