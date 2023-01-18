<table id="tabel_arus_kas" class="table table-striped">
    <thead>
        <tr>
            <th>Nomor Referensi</th>
            <th>Tanggal</th>
            <th>Akun</th>
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>D/C</th>
            <th>Nominal Debet</th>
            <th>Nominal Kredit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $key => $value) {?>
            <tr id="<?= $key?>">
                <td class="text-center"> <?= $value->timestamp?> </td>
                <td class="text-center"> <?= $value->tanggal?> </td>
                <td class="text-center"> <?= getAccountName($value->akun)?> </td>
                <td class="text-center"> <?= $value->keterangan?> </td>
                <td class="text-center"> <?= $value->nominal?> </td>
                <td class="text-center"> <?= $value->tipe?> </td>
                <td class="text-center"> <?= $value->nominal_debet?> </td>
                <td class="text-center"> <?= $value->nominal_kredit?> </td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-outline-info m-2" onclick="showImage('<?=$value->uuid?>')"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>

<!-- Modal tampilkan gambar -->
<div class="modal fade" id="modal_gambar">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" id="file-view" style="overflow:scroll;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-main1" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function fetchData(uuid) {
        let result = await fetch(`<?= base_url('dashboard/getjurnal')?>/${uuid}`)
        return result.json()
    }

    async function showImage(uuid){
        let data = await fetchData(uuid)
        let arr = JSON.parse(data.bukti_transaksi)

        $('#file-view').empty()

        arr.forEach(el => {
            $('#file-view').append(
                `<div style="">
                    <img style="position:relative; max-width:450px; overflow:scroll;" title="${el}" src="<?= base_url()?>/uploads/bukti_transaksi/${uuid}/${el}" class="m-2" >
                </div>`
            )
        });

        $('#modal_gambar').modal('show')
    }

</script>

<script>
    let tableArusKas = $('#tabel_arus_kas').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "searching": true,
        dom: 'Bfrtip',
        buttons: ['excel',]
    })

    // tableArusKas.container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))

    $('document').ready(()=>{
        $("#tabel_arus_kas_wrapper .dt-button").attr('style', 'background-color: #193463; color: white; border-radius: 5px;')
    })
    

</script>