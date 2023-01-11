

<table id="tabel_arus_kas" class="table table-striped">
    <thead>
        <tr>
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
        <?php }?>
    </tbody>
</table>

<script>
    $(document).ready( function(){
        $('#tabel_arus_kas').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "searching": true,                
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




